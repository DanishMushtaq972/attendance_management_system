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
          img{
            border-radius:50%;
            margin-left: 90px;
            margin-top: -80px;
            width: auto !important; /*Keep the aspect ratio of the image*/
            height: 140px !important;
            margin: 0 auto 1em auto;
          }
          </style>
    </head>
    <body>
        <div class="card mt-4" style="width: 18rem;margin-left:600px;margin-top:300px;background-color:rgb(236, 218, 194);shadow:2px 1px 2px 1px solid-gray">
                   <div class="card-body" >
                    <!-- Assuming $user is the user object retrieved from the database -->
                    <img src="{{ asset('profile_pictures/' . Auth::user()->profile_picture) }}" alt="Profile Picture">
                    <button class="btn btn-primary" style="color: rgb(19, 20, 21);margin-left:80px;margin-top:-80px;" ><a href='edit-profile-picture'><span style="color: rgb(19, 20, 21);">+</span></a></button>

              <h5 class="card-title">Student</h5>
              <p class="card-text">Future,Pride and Grace of country is our students.  </p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Name: {{ Auth::user()->name }} </li>
              <li class="list-group-item">E-mail: {{ Auth::user()->email }} </li>
            </ul>
            <div class="card-body">
             <button class="btn btn-primary" ><a href="{{ route('user.markAttendance') }}"><span style="color:black">Mark-Attendance</span></a> </button>
             <button class="btn btn-primary mt-2" ><a href='view-attendance'><span style="color: black">View-Attendance</span></a> </button>

             <button class="btn btn-primary mt-2"  ><a href='mark-leave'><span style="color: black">Mark-Leave<span></a></button>

             </button>

            </div>
          </div>


        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
    </html>
    <div class="dashboard-buttons">
        
       
        <br>
        <br>
        

        <br>
        
        <br>



        
    </div>
@endsection
