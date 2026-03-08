<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TalkHealsDiscoveryResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TalkHealsDiscoveryController extends Controller
{
    public function index(Request $request)
    {
        $responses = TalkHealsDiscoveryResponse::query()
            ->when($request->filter === 'reviewed',   fn($q) => $q->where('is_reviewed', true))
            ->when($request->filter === 'unreviewed', fn($q) => $q->where('is_reviewed', false))
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        return Inertia::render('Admin/TalkHealsDiscovery/Index', [
            'responses' => $responses,
            'filters'   => $request->only(['filter']),
            'stats'     => [
                'total'      => TalkHealsDiscoveryResponse::count(),
                'unreviewed' => TalkHealsDiscoveryResponse::where('is_reviewed', false)->count(),
                'reviewed'   => TalkHealsDiscoveryResponse::where('is_reviewed', true)->count(),
            ],
        ]);
    }

    public function show(TalkHealsDiscoveryResponse $response)
    {
        if (! $response->is_reviewed) {
            $response->update(['is_reviewed' => true]);
        }

        return Inertia::render('Admin/TalkHealsDiscovery/Show', [
            'response' => $response,
        ]);
    }

    public function destroy(TalkHealsDiscoveryResponse $response)
    {
        $response->delete();

        return redirect()->route('admin.talkheals-discovery.index')
            ->with('success', 'Response deleted successfully.');
    }

    public function markReviewed(TalkHealsDiscoveryResponse $response)
    {
        $response->update(['is_reviewed' => true]);
        return back()->with('success', 'Marked as reviewed.');
    }

    public function markUnreviewed(TalkHealsDiscoveryResponse $response)
    {
        $response->update(['is_reviewed' => false]);
        return back()->with('success', 'Marked as unreviewed.');
    }
}
