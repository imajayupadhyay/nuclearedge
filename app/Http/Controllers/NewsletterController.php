<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterWelcomeMail;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        $newsletter = Newsletter::create($validated);

        // Send welcome email to subscriber
        Mail::to($newsletter->email)->send(new NewsletterWelcomeMail($newsletter));

        return back()->with('newsletter_success', 'Thank you for subscribing to our newsletter!');
    }
}
