@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')
<div>
    
    <a href="{{ route('tasks.create')}}"><b>Add Task</b></a>
    

    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['task' => $task]) }}"> {{ $task->title }} </a>
        </div>
    @empty
        <div>There are no Tasks!</div>
    @endforelse

    {{ $tasks->links() }}
</div>
@endsection