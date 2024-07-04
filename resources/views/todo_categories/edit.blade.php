@extends('layouts.admin.app')

@section('title', 'Edit Todo Category')

@section('content')
    <h1>Edit Todo Category</h1>
    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('todo_categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="user_id">User ID:</label>
            <input type="number" id="user_id" name="user_id" value="{{ old('user_id', $category->user_id) }}" required>
        </div>
        <div>
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" value="{{ old('category', $category->category) }}" required>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
