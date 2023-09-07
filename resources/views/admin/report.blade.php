@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Attendance Report</h2>

        <form action="{{ route('admin.generateReport') }}" method="GET">
            <label for="from_date">From Date:</label>
            <input type="date" name="from_date" id="from_date">
            <label for="to_date">To Date:</label>
            <input type="date" name="to_date" id="to_date">
            <button type="submit">Generate Report</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Attendance Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->attendances->whereBetween('date', [$fromDate, $toDate])->count() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
