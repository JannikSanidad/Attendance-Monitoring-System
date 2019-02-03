<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Student;
use App\OnCampusLog;
use App\Log;
use Session;

class PostsController extends Controller
{
    // POST ROUTE FUNCTIONS

    public function checkUnlock(Request $req) {
        $admin_id = $req->admin_id;

        //ADMIN LOGIN
        if ($admin_id == "admin") {
            Session::put('admin', $admin_id);
            return redirect('/admin');
        }

        //NORMAL USER LOGIN
        $user = User::find($admin_id);
        
        if ($user) {
        	Session::put('current_UID', $admin_id);
        	return redirect('/login')->with('success', 'Welcome '.$user->first_name.' '.$user->last_name.'! Please log in');
        } else {
        	return redirect('/')->with('error', 'User not found!');
        }
    }

    public function checkLogin(Request $req) {
    	$current_UID = $req->current_user;
    	$username = $req->username;
    	$password = md5($req->password);

    	$user = User::find($current_UID);

        if ($user->login_status == 1) {
            return redirect('/')->with('error', 'User is logged in!');
        }
    	if ($user->username == $username && $user->password == $password) {
    		User::where('admin_ID', $current_UID)->update([
    			'login_status' => 1,
    			'location' => $req->location
    		]);

    		User::login($current_UID);
    		Session::put('location' , $req->location);
    		return redirect('/dashboard');
    	}

    	return redirect('/login')->with('success', 'Welcome '.$user->first_name.' '.$user->last_name.'! Please log in')->with('error', 'Incorrect Username or Password!');
    }

    public function scan(Request $req) {
    	date_default_timezone_set('Asia/Hong_Kong');
        $current_time = NOW();
    	$student_id = $req->studentID;
    	$system_status = $req->attendance_type; // TIME IN or TIME OUT
        if ($system_status == 1) {
            $attendance_type = 'TIME IN';
        } else {
            $attendance_type = 'TIME OUT';
        }

    	$location = Session::get('location');
    	Session::put('system_status', $system_status); // SET DEFAULT TIME IN OR TIME OUT

    	$student = Student::find($student_id);

    	if ($student) {

            //TRIM NUMBER TO 10 CHARACTERS
    		$phoneNumber = $student->parent_phone;
            $phoneNumber = substr($phoneNumber,1);

    		$oncampus = OnCampusLog::where('student_id', $student->student_id)->where('location', $location)->count();

    		if ($system_status == 1) { // IF SYSTEM IS SET TO "TIME IN"
    			if ($oncampus == 0) { // IF STUDENT IS NOT YET TIMED IN = ADD TO "OnCampus" DB, ELSE = DO NOTHING
    				
                    $message = 'MMSU - Attendance Monitoring System ';
                    $message.= 'Name: '.$student->first_name.' '.$student->last_name.' ';
                    $message.= 'Type: '.$attendance_type.' ';
                    $message.= 'Location: '.$location.' ';


                    /*
                            UNCOMMENT CODE BELOW TO TURN ON SMS
                    */
                    // $url = 'http://192.168.10.102:8080/v1/sms/send/?phone='.$phoneNumber.'&message='.urlencode($message);
                    // $ch = curl_init();
                    // curl_setopt($ch, CURLOPT_URL, $url);
                    // curl_setopt($ch, CURLOPT_ENCODING, '');
                    // curl_exec($ch);
                    // curl_close($ch);

    				$log = new Log;  // INSERT LOG ON DATABASE
    				$log->student_id = $student->student_id;
    				$log->attendance_status = $system_status;
    				$log->location = $location;
    				$log->name = $student->first_name.' '.$student->last_name;
    				$log->created_at = $current_time;
					$log->save();

					$oncampus_object = new OnCampusLog;  // INSERT STUDENT IN "OnCampus" TABLE
					$oncampus_object->student_id = $student->student_id;
    				$oncampus_object->location = $location;
                    $oncampus_object->name = $student->first_name.' '.$student->last_name;
    				$oncampus_object->created_at = $current_time;
    				$oncampus_object->save();

    				Session::put('student_id', $student_id);	// Used for showing the student info on the screen for 3 seconds
                    return redirect('/dashboard');
    			} else {
                    return redirect('/dashboard')->with('error', 'Student is already timed in');
                }
    		} else { // IF SYSTEM IS SET TO "TIME OUT"
    			if ($oncampus != 0) { // IF STUDENT IS TIMED IN = REMOVE TO "OnCampus" DB, ELSE = DO NOTHING
    				
                    $message = 'MMSU - Attendance Monitoring System ';
                    $message.= 'Name: '.$student->first_name.' '.$student->last_name.' ';
                    $message.= 'Type: '.$attendance_type.' ';
                    $message.= 'Location: '.$location.' ';

                    /*
                            UNCOMMENT CODE BELOW TO TURN ON SMS
                    */
                    
                    // $url = 'http://192.168.10.102:8080/v1/sms/send/?phone='.$phoneNumber.'&message='.urlencode($message);
                    // $ch = curl_init();
                    // curl_setopt($ch, CURLOPT_URL, $url);
                    // curl_setopt($ch, CURLOPT_ENCODING, '');
                    // curl_exec($ch);
                    // curl_close($ch);

    				$log = new Log;  // INSERT LOG ON DATABASE
    				$log->student_id = $student->student_id;
    				$log->attendance_status = $system_status;
    				$log->location = $location;
                    $log->name = $student->first_name.' '.$student->last_name;
    				$log->created_at = $current_time;
					$log->save();

    				OnCampusLog::where('student_id', $student->student_id)->where('location',$location)->delete();

    				Session::put('student_id', $student_id);	// Used for showing the student info on the screen for 3 seconds
                    return redirect('/dashboard');
    			} else {
                    return redirect('/dashboard')->with('error', 'Student is not timed in');
                }
    		}
    	} else {
            return redirect('/dashboard')->with('error', 'Student not found');
        }
    }

}
