<?php

namespace App\Http\Controllers;

use App\Models\CourseHub;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Http\Request;

class AdminAnalyticsController extends Controller
{
    public function index()
    {
        return response()->json([
            'total_users' => User::count(),
            'total_resources' => Resource::count(),
            'total_active_course_hubs' => CourseHub::count(),
        ]);
    }
}
