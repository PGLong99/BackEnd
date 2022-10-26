<?php

namespace App\Http\Services;

use App\Models\Courses;

class CoursesServices
{
    public function MyAssignmentsHandler($assign_id, $limit)
    {
        return Courses::where("assignments_id", "=", $assign_id)->limit($limit)->get();
    }
    public function MyCoursesHandler($owner_id, $limit)
    {
        return Courses::where("owner_id", "=", $owner_id)->limit($limit)->get();
    }
    public function PopularCoursesHandler($limit)
    {
        return Courses::orderBy("rate_number")->limit($limit)->get();
    }
}
