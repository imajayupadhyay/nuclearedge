<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TalkHealsPsychlabResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TalkHealsPsychlabController extends Controller
{
    public function index(Request $request)
    {
        $responses = TalkHealsPsychlabResponse::query()
            ->when($request->filter === 'reviewed',   fn($q) => $q->where('is_reviewed', true))
            ->when($request->filter === 'unreviewed', fn($q) => $q->where('is_reviewed', false))
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        return Inertia::render('Admin/TalkHealsPsychlab/Index', [
            'responses' => $responses,
            'filters'   => $request->only(['filter']),
            'stats'     => [
                'total'      => TalkHealsPsychlabResponse::count(),
                'unreviewed' => TalkHealsPsychlabResponse::where('is_reviewed', false)->count(),
                'reviewed'   => TalkHealsPsychlabResponse::where('is_reviewed', true)->count(),
            ],
        ]);
    }

    public function show(TalkHealsPsychlabResponse $response)
    {
        if (! $response->is_reviewed) {
            $response->update(['is_reviewed' => true]);
        }

        return Inertia::render('Admin/TalkHealsPsychlab/Show', [
            'response' => $response,
        ]);
    }

    public function destroy(TalkHealsPsychlabResponse $response)
    {
        $response->delete();

        return redirect()->route('admin.talkheals-psychlab.index')
            ->with('success', 'Response deleted successfully.');
    }

    public function markReviewed(TalkHealsPsychlabResponse $response)
    {
        $response->update(['is_reviewed' => true]);
        return back()->with('success', 'Marked as reviewed.');
    }

    public function markUnreviewed(TalkHealsPsychlabResponse $response)
    {
        $response->update(['is_reviewed' => false]);
        return back()->with('success', 'Marked as unreviewed.');
    }
}
