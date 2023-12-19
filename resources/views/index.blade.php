@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')
<div>
    <nav class="mb-2">
        <a class="mb-2 border-auto border-solid border-gray background-black" href="{{ route('tasks.create')}}"><b>Add Task</b></a>
    </nav>

    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['task' => $task]) }}"
            @class(['line-through' => $task->completed, 'font-bold' => !$task->completed])> {{ $task->title }} </a>
        </div>
    @empty
        <div>There are no Tasks!</div>
    @endforelse

    @if ($task->count())
    <nav class="mt-4">
        {{ $tasks->onEachSide(0)->links() }}
    </nav>
    @endif

    
</div>
@endsection