<?php

namespace App\Http\Controllers;

use App\Models\TalkHealsDiscoveryResponse;
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
}
