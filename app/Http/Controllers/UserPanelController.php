<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Attendance;
use App\Models\LeaveApplication;

class UserPanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function markAttendance()
    {
        return view('user.mark_attendance');
    }

    public function storeAttendance(Request $request)
    {
        $request->validate([
            'attendance_date' => 'required|date',
            'attendance_status' => 'required|in:Present,Absent',
        ]);

        $user = Auth::user();

        // Check if attendance already exists for the user on the given date
        $existingAttendance = Attendance::where('user_id', $user->id)
                                    ->where('attendance_date', $request->attendance_date)
                                    ->first();

        if ($existingAttendance) {
            return redirect('/mark-attendance')->with('error', 'Attendance already marked for this date.');
        }

        Attendance::create([
            'user_id' => $user->id,
            'attendance_date' => $request->attendance_date,
            'attendance_status' => $request->attendance_status,
        ]);

        return redirect('/mark-attendance')->with('success', 'Attendance marked successfully.');
    }

    public function viewAttendance()
    {
        $user = Auth::user();
        $attendances = $user->attendances;
        $leave_applications = $user->leave_applications;
        return view('user.view_attendance', compact('attendances','leave_applications'));
    }
   
    public function viewLeave()
    {
        $user = LeaveApplication::all();
        
        return view('user.view_leave', compact('user'));
       // $userr = Auth::user();
        //$leave = $leave_applications->status;
        //dd($leave);
    }

    public function editProfilePicture()
    {
        $user = Auth::user();
        return view('user.edit_profile_picture',compact('user'));
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        $imageName = time().'.'.$request->profile_picture->extension();
        $request->profile_picture->move(public_path('profile_pictures'), $imageName);

        $user->profile_picture = $imageName;
        $user->save();

        return redirect('/edit-profile-picture')->with('success', 'Profile picture updated successfully.');
    }

    public function markLeave()
    {
        return view('user.mark_leave');
    }

    public function storeLeave(Request $request)
    {
        $request->validate([
            'leave_date' => 'required|date',
            'reason' => 'required',
        ]);

        $user = Auth::user();

        LeaveApplication::create([
            'user_id' => $user->id,
            'leave_date' => $request->leave_date,
            'reason' => $request->reason,
            'status' => 'Pending', // Assuming status will be set to Pending by default
        ]);

        return redirect('/mark-leave')->with('success', 'Leave application submitted successfully.');
    }
}
