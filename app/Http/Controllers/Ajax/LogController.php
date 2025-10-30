<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\LogEntry;

class LogController extends Controller
{
   

    public function index(){
        $logs = LogEntry::with('user:id,username,name')
            ->orderBy('id','desc')
            ->get()
            ->map(fn($l)=>[
                'id'=>$l->id,
                'user'=>$l->user?->username ?? 'N/A',
                'action'=>$l->action,
                'details'=>$l->details,
                'created_at'=>$l->created_at->toDateTimeString(),
            ]);
        return response()->json($logs);
    }
}
