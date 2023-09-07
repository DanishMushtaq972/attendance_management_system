@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Update Grading Thresholds</h2>

        <form action="{{ route('admin.updateGrades') }}" method="POST">
            @csrf

            <label for="a_grade_threshold">A Grade Threshold:</label>
            <input type="number" name="a_grade_threshold" value="{{ $aGradeThreshold }}" required>
            <br>

            <label for="b_grade_threshold">B Grade Threshold:</label>
            <input type="number" name="b_grade_threshold" value="{{ $bGradeThreshold }}" required>
            <br>

            <label for="c_grade_threshold">C Grade Threshold:</label>
            <input type="number" name="c_grade_threshold" value="{{ $cGradeThreshold }}" required>
            <br>

            <label for="d_grade_threshold">D Grade Threshold:</label>
            <input type="number" name="d_grade_threshold" value="{{ $dGradeThreshold }}" required>
            <br>

            <button type="submit">Update Grading</button>
        </form>
    </div>
@endsection
