@extends('layouts.app')

@section('content')
    <h2>View Leave</h2>
    <table>
        <thead>
            <tr>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $attendance)
            <tr>
                <td>{{ $attendance->status }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
