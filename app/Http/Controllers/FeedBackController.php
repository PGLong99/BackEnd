<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedBackRequest;
use App\Http\Services\FeedBackServices;

class FeedBackController extends Controller
{
    protected $FeedbackServices;
    public function __construct(FeedBackServices $FeedbackServices)
    {
        $this->FeedbackServices = $FeedbackServices;
    }
    public function FeedBack(FeedBackRequest $request)
    {
        $result = $this->FeedbackServices->CreateFeedBackHandler($request->email, $request->subject, $request->content);
        if ($result == true) {
            return response()->json([
                'message' => 'Feedback Success',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Feedback Failed!'
            ], 500);
        }
        // try {
        //     FeedBack::create([
        //         'email' => $request->email,
        //         'subject' => $request->subject,
        //         'content' => $request->content,
        //     ]);

        //     //DB::commit();
        //     return response()->json([
        //         'message' => 'Feedback Success',
        //     ], 200);
        // } catch (\Throwable $th) {
        //     Log::error($th->getMessage());

        //     return response()->json([
        //         'message' => 'Feedback Failed!'
        //     ], 500);
        // }
    }
}
