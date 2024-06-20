@extends('layout')

@section('content')
    <h1>Employee Details</h1>
    <p>Name: {{ $employee->name }}</p>
    <p>Email: {{ $employee->email }}</p>
    <p>Age: {{ $employee->age }}</p>
    <p>Position: {{ $employee->position }}</p>
    @if ($employee->cv)
        <p>CV: <a href="{{ Storage::url($employee->cv) }}" target="_blank">View CV</a></p>
    @endif
    <a href="{{ route('employees.edit', $employee->id) }}">Edit</a>
    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection
