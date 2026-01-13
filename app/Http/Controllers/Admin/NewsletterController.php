<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $newsletters = Newsletter::query()
            ->when($request->search, function ($query, $search) {
                $query->where('email', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Newsletters/Index', [
            'newsletters' => $newsletters,
            'filters' => $request->only(['search']),
            'stats' => [
                'total' => Newsletter::count(),
            ],
        ]);
    }

    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();

        return redirect()->route('admin.newsletters.index')
            ->with('success', 'Newsletter subscription deleted successfully.');
    }
}
