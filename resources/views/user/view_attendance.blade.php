@extends('layouts.app')

@section('content')
    <h2>View Attendance</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->attendance_date }}</td>
                    <td>{{ $attendance->attendance_status }}</td>
                </tr>
            @endforeach
            @foreach($leave_applications ?? []  as $l)
            <tr>
                <td>
                    {{$l->status}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
