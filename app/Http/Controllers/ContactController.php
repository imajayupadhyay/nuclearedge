<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'services' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        $contact = Contact::create($validated);

        // Send notification email to admin
        Mail::to('connect@nuclearedge.com')->send(new ContactFormMail($contact));

        return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
