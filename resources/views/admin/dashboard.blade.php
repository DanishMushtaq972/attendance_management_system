@extends('layouts.app')

@section('content')
    <h2>Welcome, Admin</h2>
    <a href="{{ route('admin.viewStudents') }}">View-Students</a>
    <a href='/admin/system-report'>Report</a>
    <a href='/admin/grading-system'>Grading</a>


    <br><br><br>
   

@endsection