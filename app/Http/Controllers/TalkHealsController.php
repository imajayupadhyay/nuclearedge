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
            'answers' => 'required|array',
        ]);

        TalkHealsDiscoveryResponse::create([
            'answers' => $request->answers,
        ]);

        return response()->json(['success' => true]);
    }

    public function storePsychlab(Request $request)
    {
        $request->validate([
            'scores'          => 'required|array',
            'completed_games' => 'required|array',
        ]);

        TalkHealsPsychlabResponse::create([
            'scores'          => $request->scores,
            'completed_games' => $request->completed_games,
        ]);

        return response()->json(['success' => true]);
    }
}
