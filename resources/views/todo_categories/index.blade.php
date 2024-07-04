@extends('layouts.admin.app')

@section('title', 'Todo Categories')

@section('content')
    <div class="mt-4">
        <h1 class="mb-4">Todo Categories</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <a href="{{ route('todo_categories.create') }}" class="btn btn-primary mb-3">Create New Category</a>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->user_id }}</td>
                            <td>{{ $category->category }}</td>
                            <td>
                                <a href="{{ route('todo_categories.show', $category->id) }}" class="btn btn-info btn-sm">Show</a>
                                <a href="{{ route('todo_categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('todo_categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
