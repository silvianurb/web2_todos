@extends('layouts.admin.app')

@section('title', 'Edit Todo List')

@section('content')
    <div class="mt-4">
        <h1 class="mb-4">Edit Todo List</h1>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('todolist.update', $todolist->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="todo_id">Todo:</label>
                <select name="todo_id" id="todo_id" class="form-control">
                    @foreach($todos as $todo)
                        <option value="{{ $todo->id }}" {{ $todolist->todo_id == $todo->id ? 'selected' : '' }}>
                            {{ $todo->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="day">Day:</label>
                <input type="text" id="day" name="day" class="form-control" value="{{ $todolist->day }}" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" id="status" name="status" class="form-control" value="{{ $todolist->status }}" required>
            </div>
            <div class="form-group">
                <label for="todo_date">Todo Date:</label>
                <input type="date" id="todo_date" name="todo_date" class="form-control" value="{{ $todolist->todo_date }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
