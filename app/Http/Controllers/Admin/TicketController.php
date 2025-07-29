<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Category;
use App\Models\TicketLog;

class TicketController extends Controller
{
    /**
     * Menampilkan daftar tiket (admin/helpdesk).
     */
    public function index(Request $request)
    {
        $query = Ticket::with('user');

        // Filter berdasarkan status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan prioritas
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'ILIKE', '%' . $request->search . '%')
                  ->orWhere('ticket_number', 'ILIKE', '%' . $request->search . '%');
            });
        }

        // Filter minggu ini
        if ($request->time === 'this_week') {
            $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        }

        $tickets = $query->latest()->paginate(10);

        return view('admin.tickets.index', compact('tickets'));
    }

    /**
     * Formulir untuk user membuat tiket.
     */
    public function create()
    {
        $categories = Category::all();
        return view('user.tickets.create', compact('categories'));
    }

    /**
     * Menyimpan tiket baru dari user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'priority'    => 'required|in:high,medium,low',
            'description' => 'required|string',
            'location'    => 'nullable|string',
            'attachment.*'=> 'nullable|file|max:10240'
        ]);

        $ticket = Ticket::create([
            'ticket_number' => 'TCK-' . now()->format('YmdHis'),
            'user_id'       => auth()->id(),
            'category_id'   => $request->category_id,
            'title'         => $request->title,
            'description'   => $request->description,
            'location'      => $request->location,
            'priority'      => strtolower($request->priority),
            'status'        => 'new',
        ]);

        // Upload lampiran jika ada
        if ($request->hasFile('attachment')) {
            foreach ($request->file('attachment') as $file) {
                $path = $file->store('attachments');
                $ticket->attachments()->create(['file_path' => $path]);
            }
        }

        return redirect()->route('user.tickets.index')->with('success', 'Ticket berhasil dibuat.');
    }

    /**
     * Menampilkan detail tiket.
     */
    public function show(Ticket $ticket)
    {
        $ticket->load([
            'user',
            'category',
            'department.directorate',
            'logs.user',
            'attachments',
        ]);

        return view('admin.tickets.show', compact('ticket'));
    }

    /**
     * Menyimpan balasan tiket dari admin/support.
     */
    public function reply(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:new,on_going,resolved',
            'note'   => 'required|string',
        ]);

        $ticket->update([
            'status' => $request->status,
        ]);

        TicketLog::create([
            'ticket_id' => $ticket->id,
            'user_id'   => auth()->id(),
            'status'    => $request->status,
            'note'      => $request->note,
        ]);

        return redirect()->route('admin.tickets.show', $ticket->id)
                         ->with('success', 'Reply submitted!');
    }
}
