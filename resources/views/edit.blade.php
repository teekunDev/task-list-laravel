@extends('layouts.app')

@section('title', 'Add Task')

@section('styles')
    <style>
        .error-msg{
            color: red;
            font-size: 0.8rem;
        }
    </style>
@endsection

@section('content')
    <form method="POST" action="{{ route('tasks.update', ['id' => $task->id]) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="title">
                Title
            </label>
            <input text="text" name="title" id="title" value="{{ $task->title }}"/>
        </div>
        @error('title')
            <p class="error-msg"> {{ $message }}</p>
        @enderror

        <div>
            <label for="description">
                Description
            </label>
            <textarea name="description" id="description" rows="5">{{ $task->description }}</textarea>
        </div>

        @error('description')
            <p class="error-msg"> {{ $message }}</p>
        @enderror

        <div>
            <label for="long_description">
                Long Description
            </label>
            <textarea name="long_description" id="long_description" rows="5">{{ $task->long_description }}</textarea>
        </div>

        @error('long_description')
            <p class="error-msg"> {{ $message }}</p>
        @enderror

        <button type="submit">Edit Task</button>
    </form>
@endsection