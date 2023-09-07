@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Document</title>

    <style>
        .mark{
            width: 350px;
            height: 350px;
            margin-left: 500px;
            margin-top: 100px;
            border-radius: 5px white;
            background-color: rgb(166, 175, 182);

        }
        h2{
            text-align: center;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            background-color: aliceblue;
        }
        label{
            margin-top: 40px;
            margin-left: 10px;
        }
        #bt{
            margin-left: 90px;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="mark">
    <h2>Mark Attendance</h2>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form method="post" action="/mark-attendance">
        @csrf
        <label for="attendance_date">Attendance Date:</label>
        <input type="date" name="attendance_date" id="attendance_date" required>
        <label for="attendance_status">Attendance Status:</label>
        <select name="attendance_status" id="attendance_status" required>
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
        </select>
        <input id="bt" class="btn btn-primary" type="submit" value="Mark Attendance">
    </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
       
</body>
</html>
@endsection
