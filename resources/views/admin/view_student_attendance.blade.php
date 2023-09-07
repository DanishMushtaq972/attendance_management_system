@extends('layouts.app')

@section('content')
    <h2>Attendance Records</h2>
    <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->user->name }}</td>
                    <td>{{ $attendance->attendance_date }}</td>
                    <td>{{ $attendance->attendance_status }}</td>
                    <td>
                        <a href="{{ route('admin.editAttendance', ['id' => $attendance->id]) }}">Edit</a>
                        <form action="{{ route('admin.deleteAttendance', ['id' => $attendance->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
