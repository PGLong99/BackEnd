<?php

namespace App\Http\Services;

use App\Models\FeedBack;
use Illuminate\Support\Facades\Log;

class FeedBackServices
{
    public function CreateFeedBackHandler($email, $subject, $content)
    {
        try {
            FeedBack::create([
                'email' => $email,
                'subject' => $subject,
                'content' => $content,
            ]);

            //DB::commit();
            return true;
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }
}
