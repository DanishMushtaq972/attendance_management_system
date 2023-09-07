@extends('layouts.app')

@section('content')
    <h2>Grading System</h2>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Grades</title>
    </head>
    <body>
        <h1>Grades</h1>
    
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Attendance Date</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $grade)
                    <tr>
                        <td>{{$grade->name}}
                        <td>{{ $grade->attendance_date }}</td>
                        <td>{{ $grade->grade }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
    </html>
    
@endsection
