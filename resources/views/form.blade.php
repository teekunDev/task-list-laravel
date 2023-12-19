@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Add Task')


@section('content')
    <form method="POST" action="{{ isset($task) ? route('tasks.update', ['task' => $task]) : route('tasks.store') }}">
        @csrf
        @isset($task)
            @method('PUT')
        @endisset

        <div class="">
            <label for="title" class="align-text-top">
                Title
            </label>
            <input text="text" name="title" id="title" value="{{ $task->title ?? old('title') }}"/>
        </div>
        @error('title')
            <p class="error"> {{ $message }}</p>
        @enderror

        <div class="align-text-top">
            <label for="description">
                Description
            </label>
            <textarea name="description" id="description" rows="5">{{ $task->description ?? old('description') }}</textarea>
        </div>

        @error('description')
            <p class="error"> {{ $message }}</p>
        @enderror

        <div>
            <label for="long_description">
                Long Description
            </label>
            <textarea name="long_description" id="long_description" rows="5">{{ $task->long_description ?? old('long_description') }}</textarea>
        </div>

        @error('long_description')
            <p class="error"> {{ $message }}</p>
        @enderror

        <button class="btn" type="submit">
            @isset($task)
                Edit Task
            @else
                Add Task
            @endisset
        </button>
    </form>
@endsection