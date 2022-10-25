<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function Courses()
    {
        $courses = Courses::all(['*']);
        return response()->json($courses, 200);
    }
    public function MyAssignments(Request $request)
    {
        $courses = Courses::where("my_assignments", "=", $request->assign_id)->limit($request->limit);
        return response()->json($courses, 200);
    }
    public function MyCourses(Request $request)
    {
        $courses = Courses::where("owner", "=", $request->owner_id)->limit($request->limit);
        return response()->json($courses, 200);
    }
    public function PopularCourses(Request $request)
    {
        $courses = Courses::orderBy("rate_number")->limit($request->limit);
        return response()->json($courses, 200);
    }
}
