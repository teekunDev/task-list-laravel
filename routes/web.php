<?php

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
use App\Http\Requests\TaskRequest;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




#Index Route
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

#Main Index Route
Route::get('/tasks', function () {
    return view('index', [
      'tasks' => Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

#Create Form
Route::view('/tasks/create', 'create')
    ->name('tasks.create');

#Edit Form
Route::get('/tasks/{task}/edit', function (Task $task) {
      return view('edit', ['task' => $task]);
})->name('tasks.edit');

#Show Page
Route::get('/tasks/{task}', function (Task $task) {
  if (!$task) {
    abort(Response::HTTP_NOT_FOUND);
  }

  return view('show', ['task' => $task]);

})->name('tasks.show');


#Create Route
Route::post('/tasks', function (TaskRequest $request) {
    // $data = $request->validated();

    // $task = new Task();

    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];

    // $task -> save();

    $task = Task::create($request->validated());
    return redirect()->route('tasks.show', ['task' => $task]) -> with('success','Task created successfully!');

})->name('tasks.store');

#Edit Route
Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
  // $data = $request->validated();

  // $task->title = $data['title'];
  // $task->description = $data['description'];
  // $task->long_description = $data['long_description'];

  // $task -> save();

  $task->update($request->validated());

  return redirect()->route('tasks.show', ['task' => $task]) -> with('success','Task updated successfully!');

})->name('tasks.update');


Route::delete('/tasks/{task}', function (Task $task) {
  $task->delete();
  return redirect()->route('tasks.index') -> with('success', 'Task deleted successfully!');
})->name('task.destroy');


Route::fallback(function() {
  return 'Diese Seite existiert nicht!';
});

#Completion Toggle Route
Route::put('/tasks/{task}/toggle-complete', function (Task $task) {
  $task->toggleCompleted();

  return redirect()->back()->with('success','Task updated successfully');
})->name('tasks.toggle-complete');