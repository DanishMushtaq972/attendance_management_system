@extends('layouts.app')

@section('content')
    <h2>Edit Profile Picture</h2>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="post" action="/edit-profile-picture" enctype="multipart/form-data">
        @csrf
        <label for="profile_picture">Profile Picture:</label>
        <input type="file" name="profile_picture" id="profile_picture" required>
        <input type="submit" value="Update">
    </form>
@endsection
