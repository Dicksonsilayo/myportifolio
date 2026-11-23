<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display all messages.
     */
    public function index(Request $request)
    {
        $query = Message::query();

        // Search messages.
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // Filter messages by read status.
        if ($request->status === 'read') {
            $query->where('is_read', true);
        } elseif ($request->status === 'unread') {
            $query->where('is_read', false);
        }

        $messages = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $statistics = [
            'total' => Message::count(),
            'unread' => Message::where('is_read', false)->count(),
            'read' => Message::where('is_read', true)->count(),
        ];

        return view('admin.messages.index', compact(
            'messages',
            'statistics'
        ));
    }

    /**
     * Display one message and automatically mark it as read.
     */
    public function show(Message $message)
    {
        if (!$message->is_read) {
            $message->update([
                'is_read' => true,
            ]);
        }

        return view('admin.messages.show', compact('message'));
    }

    /**
     * Mark a message as read or unread.
     */
    public function toggleRead(Message $message)
    {
        $message->update([
            'is_read' => !$message->is_read,
        ]);

        $status = $message->is_read ? 'read' : 'unread';

        return redirect()
            ->route('admin.messages.index')
            ->with('success', "Message marked as {$status}.");
    }

    /**
     * Delete a message.
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}