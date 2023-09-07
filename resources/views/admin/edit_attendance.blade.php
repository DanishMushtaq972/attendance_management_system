@extends('layouts.app')

@section('content')
    <h2>Edit Attendance</h2>

    <form action="{{ route('admin.updateAttendance', ['id' => $attendance->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <!-- Add your attendance fields here -->
        <label for="attendance_date">Attendance Date:</label>
        <input type="date" name="attendance_date" value="{{ $attendance->attendance_date }}" required>
        
        <label for="status">Status:</label>
        <select name="status" required>
            <option value="Present" {{ $attendance->status == 'Present' ? 'selected' : '' }}>Present</option>
            <option value="Absent" {{ $attendance->status == 'Absent' ? 'selected' : '' }}>Absent</option>
            <option value="Leave" {{ $attendance->status == 'Leave' ? 'selected' : '' }}>Leave</option>
        </select>

        <button type="submit">Update</button>
    </form>
@endsection
