<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\UserRequest;
use App\Http\Requests\SupportRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CoursesController extends Controller
{
    public function Courses()
    {
        DB::beginTransaction();
        $courses = Courses::all(['*']);
        return response()->json($courses, 200);
    }
    public function UserRequest(SupportRequest $request)
    {
        DB::beginTransaction();

        try {
            echo ($request->content);
            UserRequest::create([
                'email' => $request->email,
                'subject' => $request->subject,
                'content' => $request->content,
            ]);

            DB::commit();
            return response()->json([
                'message' => 'Request Support Success',
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            DB::rollback();

            return response()->json([
                'message' => 'Request Support Failed!'
            ], 500);
        }
    }
}
