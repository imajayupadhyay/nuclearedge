<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::query()
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            })
            ->when($request->filter === 'unread', function ($query) {
                $query->where('is_read', false);
            })
            ->when($request->filter === 'read', function ($query) {
                $query->where('is_read', true);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Contacts/Index', [
            'contacts' => $contacts,
            'filters' => $request->only(['search', 'filter']),
            'stats' => [
                'total' => Contact::count(),
                'unread' => Contact::where('is_read', false)->count(),
                'read' => Contact::where('is_read', true)->count(),
            ],
        ]);
    }

    public function show(Contact $contact)
    {
        $contact->update(['is_read' => true]);

        return Inertia::render('Admin/Contacts/Show', [
            'contact' => $contact,
        ]);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact deleted successfully.');
    }

    public function markAsRead(Contact $contact)
    {
        $contact->update(['is_read' => true]);

        return back()->with('success', 'Contact marked as read.');
    }

    public function markAsUnread(Contact $contact)
    {
        $contact->update(['is_read' => false]);

        return back()->with('success', 'Contact marked as unread.');
    }
}
