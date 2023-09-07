@extends('layouts.app')

@section('content')
    <h2>View Students</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>
                        <a href="{{ route('admin.editAttendance', ['id' => $student->id]) }}">Edit</a>
                        <form action="{{ route('admin.deleteAttendance', ['id' => $student->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>                    
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
