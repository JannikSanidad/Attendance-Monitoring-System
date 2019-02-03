<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;
use App\User;
use App\Student;
use App\OnCampusLog;
use Session;
use DB;

class AjaxController extends Controller
{
    // AJAX ROUTE FUNCTIONS

    public function sendLogsToView() {
        $now = date("Y-m-d"); 
        $now = $now.'%';
        $location = Session::get('location');
        $logs = Log::where('location', $location)->where('created_at', 'like', $now)->orderBy('id','desc')->get();
        return view('ajax.user_scan_logs')->with('logs', $logs);
    }

    public function sendUsersToView() {
    	$users = User::all();

 		return view('ajax.user_accounts')->with('users', $users);
 	}

 	public function sendLogsToAdminView() {

 		$attendance_logs = Log::orderBy('id','desc')->get();
 		return view('ajax.admin_scan_logs')->with('attendance_logs', $attendance_logs);
 	}

    public function countStudents() {
        $now = date("Y-m-d"); 
        $now = $now.'%';
        $location = Session::get('location');
        $count = OnCampusLog::where('location', $location)->where('created_at', 'like', $now)->orderBy('id','desc')->count();
        return $count;
    }

    public function deleteUser(Request $req) {
        $admin_id = $req->all();
        $admin_id = $admin_id['adminID'];
        $user = User::find($admin_id);
        $user->delete();
    }

    public function search(Request $req) {
        $search = $req->all();
        $startDate = $search['startDate'];
        $endDate = $search['endDate'];
        $search_with = $search['search_with'];
        $search_item = $search['search_item'];


        if ($startDate != null && $endDate != null) {       /* IF BOTH DATES ARE SUPPLIED */
            $from = date($startDate);
            $to = date('Y-m-d', strtotime($endDate. ' + 1 day'));

            if ($search_item != null) {
                $search_item = '%'.$search_item.'%';
                if ($search_with == 'student_id') {
                    $attendance_logs = Log::whereBetween('created_at', [$from, $to])->where('student_id','like', $search_item)->orderBy('id','desc')->get();
                } else if ($search_with == 'name') {
                    $attendance_logs = Log::whereBetween('created_at', [$from, $to])->where('name','like', $search_item)->orderBy('id','desc')->get();
                } else if ($search_with == 'location') {
                    $attendance_logs = Log::whereBetween('created_at', [$from, $to])->where('location','like', $search_item)->orderBy('id','desc')->get();
                }
            } else {
                $attendance_logs = Log::whereBetween('created_at', [$from, $to])->orderBy('id','desc')->get();
            }

        } else if($startDate != null && $endDate == null) {     /* IF ONLY START DATE IS SUPPLIED */
            $startDate.='%';

            if ($search_item != null) {
                $search_item = '%'.$search_item.'%';
                if ($search_with == 'student_id') {
                    $attendance_logs = Log::where('created_at','like', $startDate)->where('student_id','like', $search_item)->orderBy('id','desc')->get();
                } else if ($search_with == 'name') {
                    $attendance_logs = Log::where('created_at','like', $startDate)->where('name','like', $search_item)->orderBy('id','desc')->get();
                } else if ($search_with == 'location') {
                    $attendance_logs = Log::where('created_at','like', $startDate)->where('location','like', $search_item)->orderBy('id','desc')->get();
                }
            } else {
                $attendance_logs = Log::where('created_at','like', $startDate)->orderBy('id','desc')->get();
            }

        } else if($startDate == null && $endDate != null){      /* IF ONLY END DATE IS SUPPLIED */
            $endDate.='%';

            if ($search_item != null) {
                $search_item = '%'.$search_item.'%';
                if ($search_with == 'student_id') {
                    $attendance_logs = Log::where('created_at','like', $endDate)->where('student_id','like', $search_item)->orderBy('id','desc')->get();
                } else if ($search_with == 'name') {
                    $attendance_logs = Log::where('created_at','like', $endDate)->where('name','like', $search_item)->orderBy('id','desc')->get();
                } else if ($search_with == 'location') {
                    $attendance_logs = Log::where('created_at','like', $endDate)->where('location','like', $search_item)->orderBy('id','desc')->get();
                }
            } else {
                $attendance_logs = Log::where('created_at','like', $endDate)->orderBy('id','desc')->get();
            }

        } else {
            if ($search_item != null) {             /* IF NO DATE IS SUPPLIED */
                $search_item = '%'.$search_item.'%';
                if ($search_with == 'student_id') {
                    $attendance_logs = Log::where('student_id','like', $search_item)->orderBy('id','desc')->get();
                } else if ($search_with == 'name') {
                    $attendance_logs = Log::where('name','like', $search_item)->orderBy('id','desc')->get();
                } else if ($search_with == 'location') {
                    $attendance_logs = Log::where('location','like', $search_item)->orderBy('id','desc')->get();
                }
            } else {
                $attendance_logs = Log::orderBy('id','desc')->get();
            }
        }

        return view('ajax.admin_scan_logs')->with('attendance_logs', $attendance_logs);
        
    }

    public function sendOnCampusLogs(Request $req) {
        $data = $req->all();
        $location = $data['location'];
        $search_item = $data['search_item'];

        if ($search_item != null) {
            $search_item= '%'.$search_item.'%';
            $students = OnCampusLog::where('name', 'like', $search_item)->orWhere('student_id','like',$search_item)->get();
        } else {
            $students = OnCampusLog::where('location', $location)->get();
        }

        return view('ajax.oncampus_logs')->with('students', $students);
    }

    public function getCampusCount() {

        $overall_count = OnCampusLog::all()->count();
        $adminbldg = OnCampusLog::where('location','ADMIN BLDG')->count();
        $library = OnCampusLog::where('location','LIBRARY')->count();
        $itc = OnCampusLog::where('location','ITC')->count();
        $cbea = OnCampusLog::where('location','CBEA')->count();
        $coe = OnCampusLog::where('location','COE')->count();
        $cas = OnCampusLog::where('location','CAS')->count();
        $casat = OnCampusLog::where('location','CASAT')->count();
        $cafsd = OnCampusLog::where('location','CAFSD')->count();
        $chs = OnCampusLog::where('location','CHS')->count();
        $cte = OnCampusLog::where('location','CTE')->count();
        $cit = OnCampusLog::where('location','CIT')->count();

        $loc = array(
            'overall_count' => $overall_count, 
            'adminbldg' => $adminbldg, 
            'library' => $library, 
            'itc' => $itc, 
            'cbea' => $cbea, 
            'coe' => $coe, 
            'cas' => $cas, 
            'casat' => $casat,
            'cafsd' => $cafsd, 
            'chs' => $chs, 
            'cte' => $cte,
            'cit' => $cit
        );
        return view('ajax.campus_counters')->with('location', $loc);
    }
}