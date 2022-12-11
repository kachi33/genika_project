<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $activeList = $user->courses()->where(['status' => 'accept','is_archive' => '0'])->get();
        $requestCourseList = $user->courses()->where(['status'=>'pending'])->get();
        $archiveCourseList = $user->courses()->where(['is_archive' => '1'])->get();

        return view('dashboard', compact('user', 'activeList', 'requestCourseList', 'archiveCourseList'));
    }

    public function courses()
    {
        # code...
    }
}
