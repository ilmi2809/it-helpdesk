@extends('layouts.app')

@section('content')
<div class="p-1">
  <h1 class="text-2xl font-bold text-gray-800 mb-4">Manage Category</h1>

  <div class="flex flex-col lg:flex-row gap-6">
    <div class="w-full lg:w-3/4 bg-white p-6 rounded shadow"
         x-data="{ opened: {} }">

      @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
          {{ session('success') }}
        </div>
      @endif
      @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
          {{ session('error') }}
        </div>
      @endif

      <div class="mb-3 flex gap-2">
        <button type="button" class="btn btn-sm btn-outline-secondary"
                @click="$root.querySelectorAll('[data-parent-row]').forEach(el=>opened[el.dataset.parentRow]=true)">
          Expand all
        </button>
        <button type="button" class="btn btn-sm btn-outline-secondary"
                @click="$root.querySelectorAll('[data-parent-row]').forEach(el=>opened[el.dataset.parentRow]=false)">
          Collapse all
        </button>
      </div>

      <table class="w-full border text-sm text-center">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-4 py-2 border">No</th>
            <th class="px-4 py-2 border text-left">Category</th>
            <th class="px-4 py-2 border text-left">Description</th>
            <th class="px-4 py-2 border">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($parents as $idx => $parent)
            @php $key = 'p-'.$parent->id; @endphp

            {{-- ROW PARENT --}}
            <tr data-parent-row="{{ $key }}">
              <td class="px-4 py-2">{{ $parents->firstItem() + $idx }}</td>
              <td class="px-4 py-2 text-left">
                <button type="button"
                        class="text-left w-full"
                        @click="opened['{{ $key }}'] = !opened['{{ $key }}']">
                  <span x-text="opened['{{ $key }}'] ? '▾' : '▸'"></span>
                  {{ $parent->name }}
                </button>
              </td>
              <td class="px-4 py-2 text-left">{{ $parent->description }}</td>
              <td class="px-4 py-2">
                <a href="{{ route('admin.categories.edit', $parent) }}"
                   class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
                <form method="POST" action="{{ route('admin.categories.destroy', $parent) }}" class="inline">
                  @csrf @method('DELETE')
                  <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded ml-1"
                          onclick="return confirm('Delete parent?')">Delete</button>
                </form>
              </td>
            </tr>

            {{-- ROW CHILDREN (collapse pakai Alpine) --}}
            <tr>
              <td></td>
              <td colspan="3" class="p-0 text-left">
                <div x-show="opened['{{ $key }}']" x-collapse>
                  <table class="table table-sm mb-0">
                    <thead>
                      <tr class="table-light">
                        <th style="width:60px"></th>
                        <th>Sub‑Category</th>
                        <th>Description</th>
                        <th style="width:220px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($parent->children as $j => $child)
                        <tr>
                          <td>{{ $j+1 }}</td>
                          <td>{{ $child->name }}</td>
                          <td>{{ $child->description }}</td>
                          <td>
                            <a href="{{ route('admin.categories.edit', $child) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $child) }}" class="d-inline">
                              @csrf @method('DELETE')
                              <button class="btn btn-danger btn-sm"
                                      onclick="return confirm('Delete sub‑category?')">Delete</button>
                            </form>
                          </td>
                        </tr>
                      @empty
                        <tr><td colspan="4" class="text-muted">Belum ada sub‑category.</td></tr>
                      @endforelse

                      {{-- QUICK CREATE SUB‑CATEGORY --}}
                      <tr class="table-light">
                        <td>#</td>
                        <td colspan="3">
                          <form method="POST" action="{{ route('admin.categories.store') }}" class="row g-2">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $parent->id }}">
                            <div class="col-md-4">
                              <input name="name" class="form-control" placeholder="Nama sub‑category" required>
                            </div>
                            <div class="col-md-6">
                              <input name="description" class="form-control" placeholder="Deskripsi (opsional)">
                            </div>
                            <div class="col-md-2">
                              <button class="btn btn-danger w-100">Tambah</button>
                            </div>
                          </form>
                        </td>
                      </tr>

                    </tbody>
                  </table>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <div class="mt-3">
        {{ $parents->links() }}
      </div>
    </div>

    {{-- Panel create parent --}}
    @include('admin.category.create')
  </div>
</div>
@endsection
