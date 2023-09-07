@extends('layouts.app')

@section('content')
    <h2>Leave Approvals</h2>
    <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Leave Date</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leaveApplications as $leaveApplication)
                <tr>
                    <td>{{ $leaveApplication->user->name }}</td>
                    <td>{{ $leaveApplication->leave_date }}</td>
                    <td>{{ $leaveApplication->reason }}</td>
                    <td>{{ $leaveApplication->status }}</td>
                    <td>
                        <a href="{{ route('admin.approveLeave', ['id' => $leaveApplication->id]) }}">Approve</a>
                        <a href="{{ route('admin.rejectLeave', ['id' => $leaveApplication->id]) }}">Reject</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
