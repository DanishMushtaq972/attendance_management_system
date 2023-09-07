@extends('layouts.app')

@section('content')
    <h2>System Report</h2>
    <!-- Form to select FROM and TO dates and generate system report -->
    <table>
       
        <h3>Report Summary</h3>
        <p>From: {{ $fromDate->format('Y-m-d') }}</p>
        <p>To: {{ $toDate->format('Y-m-d') }}</p>
        <p>Total Leaves: {{ $totalLeaves }}</p>
        <p>Total Presents: {{ $totalPresents }}</p>
        <p>Total Absents: {{ $totalAbsents }}</p>

        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userAttendance as $attendance)
                    <tr>
                        <td>{{ $attendance->user->name }}</td>
                        <td>{{ $attendance->attendance_date }}</td>
                        <td>{{ $attendance->attendance_status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection



