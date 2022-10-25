<?php

namespace App\Http\Controllers;

use App\Models\FeedBack;
use App\Http\Requests\FeedBackRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FeedBackController extends Controller
{
    public function FeedBack(FeedBackRequest $request)
    {

        try {
            echo ($request->content);
            FeedBack::create([
                'email' => $request->email,
                'subject' => $request->subject,
                'content' => $request->content,
            ]);

            DB::commit();
            return response()->json([
                'message' => 'Feedback Success',
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json([
                'message' => 'Feedback Failed!'
            ], 500);
        }
    }
}
