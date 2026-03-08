<?php

namespace App\Http\Controllers;

use App\Models\TalkHealsDiscoveryResponse;
use App\Models\TalkHealsPsychlabResponse;
use Illuminate\Http\Request;

class TalkHealsController extends Controller
{
    public function storeDiscovery(Request $request)
    {
        $request->validate([
            'name'    => 'nullable|string|max:255',
            'answers' => 'required|array',
        ]);

        TalkHealsDiscoveryResponse::create([
            'name'    => $request->name,
            'answers' => $request->answers,
        ]);

        return response()->json(['success' => true]);
    }

    public function storePsychlab(Request $request)
    {
        $request->validate([
            'name'            => 'nullable|string|max:255',
            'scores'          => 'required|array',
            'completed_games' => 'required|array',
            'note'            => 'nullable|string|max:2000',
        ]);

        TalkHealsPsychlabResponse::create([
            'name'            => $request->name,
            'scores'          => $request->scores,
            'completed_games' => $request->completed_games,
            'note'            => $request->note,
        ]);

        return response()->json(['success' => true]);
    }
}
