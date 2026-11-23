<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Store a message submitted through the portfolio contact form.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:10000'],
        ]);

        Message::create($validated);

        return redirect()
            ->to(route('home') . '#contact')
            ->with('contact_success', 'Your message has been sent successfully. Thank you for contacting me!');
    }
}