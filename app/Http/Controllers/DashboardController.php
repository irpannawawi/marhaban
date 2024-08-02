<?php

namespace App\Http\Controllers;

use App\Models\HistoryAi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // create file if not exits in root directory named gpt-response.txt
        
        $data['gpt_responses'] = HistoryAi::latest()->limit(3)->get();
        return view('dashboard', $data);
    }

    public function ai_history(Request $request){
        $data = [];
        $history = HistoryAi::orderBy('created_at', 'desc');
        
        if($request->startDate && $request->endDate){
            $history = $history->whereBetween('created_at', [
                Carbon::parse($request->startDate)->startOfDay(),
                Carbon::parse($request->endDate)->endOfDay(),
            ]);
        }

        $data['gpt_responses'] = $history->get();
        return view('ai_history', $data);
    }
}
