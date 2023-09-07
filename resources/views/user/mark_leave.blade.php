@extends('layouts.app')

@section('content')
    <h2>Mark Leave</h2>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="post" action="/mark-leave">
        @csrf
        <label for="leave_date">Leave Date:</label>
        <input type="date" name="leave_date" id="leave_date" required>
        <label for="reason">Reason:</label>
        <textarea name="reason" id="reason" rows="4" required></textarea>
        <input type="submit" value="Apply">
    </form>
@endsection
