<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function index(): View
    {
        $messages = ContactMessage::with('user')
            ->latest()
            ->get();

        return view('admin.messages.index', compact('messages'));
    }

    public function show(ContactMessage $message): View
    {
        $message->load('user');

        if (! $message->is_read) {
            $message->update([
                'is_read' => true,
            ]);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function reply(
        Request $request,
        ContactMessage $message
    ): RedirectResponse {
        $validated = $request->validate([
            'reply' => [
                'required',
                'string',
                'min:2',
                'max:2000',
            ],
        ]);

        $message->update([
            'reply' => $validated['reply'],
            'replied_at' => now(),
            'is_read' => true,
        ]);

        return redirect()
            ->route('admin.messages.show', $message)
            ->with('success', 'Balasan berhasil dikirim.');
    }

    public function destroy(ContactMessage $message): RedirectResponse
    {
        $message->delete();

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}