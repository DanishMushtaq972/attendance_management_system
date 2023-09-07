<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Attendance;
use App\Models\LeaveApplication;
use App\Models\User;
use Carbon\carbon;

class AdminPanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewStudents()
    {
        $students = User::all();
        return view('admin.view_students', compact('students'));
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function viewStudentAttendance($id)
    {
        $student = User::findOrFail($id);
        $attendances = $student->attendances;
        return view('admin.view_student_attendance', compact('student', 'attendances'));
    }
    public function Student_Attendance()
    {
       
 $attendances = Attendance::with('user')->get();
    return view('admin.admin_view_attendance', compact('attendances'));
    }

    public function editAttendance(Request $request)
    {
        // Handle edit attendance logic here
        // ...
        $request->validate([
            'status' => 'required|in:Present,Absent,Leave',
        ]);

        $attendance = Attendance::findOrFail($id);

        // Update attendance status
        $attendance->status = $request->input('status');
        $attendance->save();

        return redirect('admin.edit_attendance')->with('success', 'Attendance updated successfully.');
    }
    public function updateAttendance(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Present,Absent,Leave',
        ]);

        $attendance = Attendance::find($id);

        if (!$attendance) {
            return redirect()->back()->with('error', 'Attendance not found.');
        }

        $attendance->status = $request->input('status');
        $attendance->save();

        return redirect()->route('admin.students')->with('success', 'Attendance updated successfully.');
    }


    public function deleteAttendance($id)
    {
        $attendance = Attendance::find($id);

        $attendance->delete();

        return redirect()->back()->with('success', 'Attendance deleted successfully.');
    }

    public function createReport(Request $request)
    {
        // Handle report generation logic here
        // ...
        
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        // Validate input dates
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
        ]);

        // Convert to Carbon instances
        $fromDate = Carbon::createFromFormat('Y-m-d', $fromDate)->startOfDay();
        $toDate = Carbon::createFromFormat('Y-m-d', $toDate)->endOfDay();

        // Get specific user attendance within date range
        $userAttendance = Attendance::whereBetween('attendance_date', [$fromDate, $toDate])->get();

        // Get total number of leaves, presents, absents, etc.
        $totalLeaves = $userAttendance->where('attendance_status', 'Leave')->count();
        $totalPresents = $userAttendance->where('attendance_status', 'Present')->count();
        $totalAbsents = $userAttendance->where('attendance_status', 'Absent')->count();

        return view('admin.system_report', compact('userAttendance', 'fromDate', 'toDate', 'totalLeaves', 'totalPresents', 'totalAbsents'));
    }
    

    public function leaveApprovals()
    {
        $leaveApplications = LeaveApplication::all();
        return view('admin.leave_approvals', compact('leaveApplications'));
    }

    public function approveLeave(Request $request, $id)
    {
        $leaveApplication = LeaveApplication::findOrFail($id);
        $leaveApplication->status = 'Approved';
        $leaveApplication->save();

        return redirect()->back()->with('success', 'Leave approved successfully.');
    }

    public function rejectLeave(Request $request, $id)
    {
        $leaveApplication = LeaveApplication::findOrFail($id);
        $leaveApplication->status = 'Rejected';
        $leaveApplication->save();

        return redirect()->back()->with('success', 'Leave rejected successfully.');
    }

    public function createSystemReport(Request $request)
    {
        $fromDate = $request->input('from_date');
    $toDate = $request->input('to_date');

    $users = User::with(['attendances' => function ($query) use ($fromDate, $toDate) {
        $query->whereBetween('attendance_date', [$fromDate, $toDate]);
    }])->get();
   
    return view('admin.report', compact('users', 'fromDate', 'toDate'));
}

    public function gradingSystem()
    {
       
        $users = User::all();

        foreach ($users as $user) {
            // Fetch attendance count for each user
            $attendanceCount = Attendance::where('user_id', $user->id)->count();
    
            if ($attendanceCount >= 26) {
                $user->grade = 'A';
            } elseif ($attendanceCount >= 20) {
                $user->grade = 'B';
            } elseif ($attendanceCount >= 15) {
                $user->grade = 'C';
            } elseif ($attendanceCount >= 10) {
                $user->grade = 'D';
            } else {
                $user->grade = 'F';
            }
    
            $user->save();
        }
    
        // Fetch the grading system data (attendance days and corresponding grades)
        $grades = Attendance::select('user_id')
            ->groupBy('user_id')
            ->get();
    
        return view('admin.grading_system', compact('users'))->with('success', 'Grades applied successfully!');
    }

    public function updateGradingSystem(Request $request)
    {
        $request->validate([
            'a_grade_threshold' => 'required|integer|min:0',
            'b_grade_threshold' => 'required|integer|min:0',
            'c_grade_threshold' => 'required|integer|min:0',
            'd_grade_threshold' => 'required|integer|min:0',
        ]);

        $aGradeThreshold = $request->input('a_grade_threshold');
        $bGradeThreshold = $request->input('b_grade_threshold');
        $cGradeThreshold = $request->input('c_grade_threshold');
        $dGradeThreshold = $request->input('d_grade_threshold');

        // Update the grading thresholds in the database settings table or configuration file
        // For example, you can use the settings table to store the thresholds and retrieve them later

        // After updating the grading thresholds, calculate and update grades for users
        $users = User::all();
        foreach ($users as $user) {
            $attendanceCount = Attendance::where('user_id', $user->id)->count();

            if ($attendanceCount >= $aGradeThreshold) {
                $user->grade = 'A';
            } elseif ($attendanceCount >= $bGradeThreshold) {
                $user->grade = 'B';
            } elseif ($attendanceCount >= $cGradeThreshold) {
                $user->grade = 'C';
            } elseif ($attendanceCount >= $dGradeThreshold) {
                $user->grade = 'D';
            } else {
                $user->grade = 'F';
            }

            $user->save();
        }

        return redirect()->back()->with('success', 'Grades updated successfully.');
    }

}
