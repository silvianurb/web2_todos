@extends('layouts.admin.app')

@section('title', 'Show Todo Category')

@section('content')
    <h1>Show Todo Category</h1>
    <div>
        <strong>ID:</strong> {{ $category->id }}
    </div>
    <div>
        <strong>User ID:</strong> {{ $category->user_id }}
    </div>
    <div>
        <strong>Category:</strong> {{ $category->category }}
    </div>
    <a href="{{ route('todo_categories.index') }}">Back to list</a>
@endsection
