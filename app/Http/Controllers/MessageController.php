<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FonnteService;

class MessageController extends Controller
{
    protected $fonnteService;

    public function __construct(FonnteService $fonnteService)
    {
        $this->fonnteService = $fonnteService;
    }

    public function send(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'message' => 'required|string',
        ]);

        $to = $request->input('phone');
        $message = $request->input('message');

        $response = $this->fonnteService->sendMessage($to, $message);

        return response()->json($response);
    }
}
