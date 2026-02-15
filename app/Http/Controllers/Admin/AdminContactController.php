<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::orderBy('created_at', 'desc');

        // Search
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status') && $request->input('status') !== 'all') {
            $query->where('status', $request->input('status'));
        }

        $messages = $query->paginate(10)->withQueryString();

        // Stats
        $totalCount = ContactMessage::count();
        $unreadCount = ContactMessage::where('status', 'new')->count();
        $repliedCount = ContactMessage::where('status', 'replied')->count();

        return view('admin.contact.index', compact('messages', 'totalCount', 'unreadCount', 'repliedCount'));
    }

    public function show(ContactMessage $contact)
    {
        if ($contact->status === 'new') {
            $contact->update(['status' => 'replied', 'is_read' => true]);
        }

        return view('admin.contact.show', compact('contact'));
    }

    public function destroy(ContactMessage $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contact.index')
            ->with('success', 'Message deleted successfully.');
    }

    public function markAllRead()
    {
        ContactMessage::where('status', 'new')->update(['status' => 'replied', 'is_read' => true]);

        return redirect()->route('admin.contact.index')
            ->with('success', 'All messages marked as read.');
    }

    public function archive(ContactMessage $contact)
    {
        $contact->update(['status' => 'archived']);

        return redirect()->route('admin.contact.index')
            ->with('success', 'Message archived.');
    }

    public function unarchive(ContactMessage $contact)
    {
        $contact->update(['status' => 'replied']);

        return redirect()->route('admin.contact.index')
            ->with('success', 'Message unarchived.');
    }
}
