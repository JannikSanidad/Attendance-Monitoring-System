<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Student;
use Session;

class PagesController extends Controller
{

    public function user_login() {
        if (User::check()) {
            return redirect('dashboard');
        } 
  
        return view('login');
    }

    public function user_logout() {
        if (User::check()) {
            $current_UID = User::user();
            User::where('admin_ID', $current_UID)->update([
                'login_status' => 0,
                'location' => NULL
            ]);
        }
        
        User::logout();
        return redirect('/');
    }

    public function user_dashboard() {
        if (User::check()) {
            $user_id = User::user();
            $user = User::where('admin_id', $user_id)->first();
            if (Session::has('student_id')) {
                $student_id = Session::get('student_id');
                $student = Student::where('student_id', $student_id)->first();

                return view('user_dashboard')->with('user', $user)->with('student', $student);
            }
            return view('user_dashboard')->with('user', $user);
        } else {
            return redirect('/');
        }

    	
    }

    public function admin_dashboard() {
        if (Session::has('admin')) {
            return view('admin_dashboard');
        }
    	if (User::check()) {
            return redirect('/dashboard');
        } else {
            return redirect('/');
        }
    }

    public function admin_logs() {
        if (Session::has('admin')) {
            return view('admin_logs');
        }
        if (User::check()) {
            return redirect('/dashboard');
        } else {
            return redirect('/');
        }
    }
}
