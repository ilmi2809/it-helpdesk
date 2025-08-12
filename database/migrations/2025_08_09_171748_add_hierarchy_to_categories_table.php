<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration {
    public function up(): void
    {
        // 1) Tambahkan kolom baru (tanpa unique dulu)
        Schema::table('categories', function (Blueprint $table) {
            // parent_id untuk sub-category (self relation)
            $table->foreignId('parent_id')
                  ->nullable()
                  ->after('id')
                  ->constrained('categories')
                  ->nullOnDelete();

            // slug untuk identifier unik
            $table->string('slug')->nullable()->after('name');

            // urutan tampilan (opsional)
            $table->unsignedSmallInteger('order')->default(0)->after('slug');

            // description boleh tetap mandatory sesuai skema awal; jika ingin nullable,
            // gunakan migration terpisah (perlu doctrine/dbal untuk ->change()).
        });

        // 2) Backfill slug dari name (pastikan unik)
        $existing = DB::table('categories')->select('id','name','slug')->orderBy('id')->get();
        $used = DB::table('categories')->whereNotNull('slug')->pluck('slug')->all();
        $used = array_fill_keys($used, true);

        foreach ($existing as $row) {
            if (!empty($row->slug)) continue;

            $base = Str::slug($row->name ?? 'category');
            $candidate = $base ?: 'category';
            $i = 2;
            while (isset($used[$candidate])) {
                $candidate = $base . '-' . $i;
                $i++;
            }
            DB::table('categories')->where('id', $row->id)->update(['slug' => $candidate]);
            $used[$candidate] = true;
        }

        // 3) Pasang index & constraint setelah data siap
        Schema::table('categories', function (Blueprint $table) {
            $table->unique('slug', 'categories_slug_unique');
            $table->unique(['parent_id','name'], 'categories_parent_id_name_unique');
            $table->index('parent_id', 'categories_parent_id_index');
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique('categories_slug_unique');
            $table->dropUnique('categories_parent_id_name_unique');
            $table->dropIndex('categories_parent_id_index');
            $table->dropForeign(['parent_id']);
            $table->dropColumn(['parent_id','slug','order']);
        });
    }
};
