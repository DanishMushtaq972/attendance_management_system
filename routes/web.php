<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\UserPanelController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/login', [AdminAuthController::class,'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class,'login']);
Route::post('/admin/logout', [AdminAuthController::class,'logout'])->name('admin.logout');
Route::middleware('auth')->group(function () {
    // User Panel Routes

    // Admin Panel Routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        });
        // Add other admin routes here
    });
});
Route::middleware('auth')->group(function () {
    // User Panel Routes
    Route::get('/mark-attendance',[UserPanelController::class,'markAttendance'])->name('user.markAttendance');
    Route::post('/mark-attendance', [UserPanelController::class,'storeAttendance'])->name('user.storeAttendance');

    Route::get('/view-attendance', [UserPanelController::class,'viewAttendance']);
    Route::get('/view-leave', [UserPanelController::class,'viewLeave']);


    Route::get('/edit-profile-picture', [UserPanelController::class,'editProfilePicture']);
    Route::post('/edit-profile-picture', [UserPanelController::class,'updateProfilePicture']);
    Route::get('/dashboard', [UserPanelController::class,'viewProfile'])->name('user.dashboard');


    Route::get('/mark-leave', [UserPanelController::class,'markLeave'])->name('markLeave');
    Route::post('/mark-leave', [UserPanelController::class,'storeLeave'])->name('storeLeave');
});
Route::middleware('auth:admin')->group(function () {
    // User Panel Routes
    // ...

    // Admin Panel Routes
    Route::middleware('auth:admin')->group(function () {
        // Admin Dashboard
        Route::get('/admin/dashboard',[ AdminPanelController::class,'dashboard'])->name('admin.dashboard');

        // View Students
        Route::get('/admin/students', [AdminPanelController::class,'viewStudents'])->name('admin.viewStudents');

        // View Student Attendance
        Route::get('/admin/view_student_attendance', [AdminPanelController::class,'viewStudentAttendance'])->name('admin.Student_Attendance');
        Route::get('/admin/admin_view_attendance', [AdminPanelController::class,'Student_Attendance'])->name('admin.viewAttendance');
        Route::get('/admin/user_attendance/{id}', [AdminPanelController::class,'viewUserAttendance'])->name('admin.viewUserAttendance');

        
        Route::get('/admin/students/{id}/attendance', [AdminPanelController::class,'viewStudentAttendance'])->name('admin.viewStudentAttendance');

        // Edit Attendance
        Route::get('/admin/attendance/{id}/edit', [AdminPanelController::class,'editAttendance'])->name('admin.editAttendance');
        Route::post('/admin/attendance/{id}/update', 'AdminPanelController@updateAttendance')->name('admin.updateAttendance');

        // Delete Attendance
        Route::delete('/admin/attendance/{id}/delete', [AdminPanelController::class,'deleteAttendance'])->name('admin.deleteAttendance');

        // Create Report
        Route::get('/admin/report', [AdminPanelController::class,'createReport'])->name('admin.createReport');
        Route::post('/admin/report', [AdminPanelController::class,'generateReport'])->name('admin.generateReport');

        // Leave Approvals
        Route::get('/admin/leave-approvals', [AdminPanelController::class,'leaveApprovals'])->name('admin.leaveApprovals');
        Route::post('/admin/leave-approvals/{id}/approve',[AdminPanelController::class,'approveLeave'])->name('admin.approveLeave');
        Route::post('/admin/leave-approvals/{id}/reject', [AdminPanelController::class,'rejectLeave'])->name('admin.rejectLeave');

        // System Report
        Route::get('/admin/system-report', [AdminPanelController::class,'createSystemReport'])->name('admin.createSystemReport');
        Route::post('/admin/system-report', [AdminPanelController::class,'generateSystemReport'])->name('admin.generateSystemReport');

        // Grading System
        Route::get('/admin/grading-system', [AdminPanelController::class,'gradingSystem'])->name('admin.gradingSystem');
        Route::post('/admin/grading-system', [AdminPanelController::class,'updateGradingSystem'])->name('admin.updateGradingSystem');

        Route::get('/edit_attendance', function () {
            return view('admin/edit_attendance');
        });
    });
});


Route::middleware('auth')->group(function () {
Route::get('/dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard');
});
Route::middleware('auth:admin')->group(function(){
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});