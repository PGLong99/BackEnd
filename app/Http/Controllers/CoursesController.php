<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Http\Requests\MyAssignmentsRequest;
use App\Http\Requests\MyCoursesRequest;
use App\Http\Requests\PopularCoursesRequest;
use App\Http\Services\CoursesServices;

class CoursesController extends Controller
{
    protected $coursesservice;
    public function __construct(CoursesServices $coursesservice)
    {
        $this->coursesservice = $coursesservice;
    }
    public function MyAssignments(MyAssignmentsRequest $request)
    {
        //$courses = Courses::where("assignments_id", "=", $request->owner_id)->limit($request->limit)->get();
        $courses = $this->coursesservice->MyAssignmentsHandler($request->assignments_id, $request->limit);
        return response()->json($courses, 200);
    }
    public function MyCourses(MyCoursesRequest $request)
    {
        //$courses = Courses::where("owner_id", "=", $request->owner_id)->limit($request->limit)->get();
        $courses = $this->coursesservice->MyAssignmentsHandler($request->owner_id, $request->limit);
        return response()->json($courses, 200);
    }
    public function PopularCourses(PopularCoursesRequest $request)
    {
        $courses = $this->coursesservice->PopularCoursesHandler($request->limit);
        return response()->json($courses, 200);
    }
}
