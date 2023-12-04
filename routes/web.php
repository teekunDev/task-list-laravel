<?php

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\task;


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
      'tasks' => task::latest()->get()
    ]);
})->name('tasks.index');

#Create Form
Route::view('/tasks/create', 'create')
    ->name('tasks.create');

#Edit Form
Route::get('/tasks/{id}/edit', function ($id) {
      return view('edit', ['task' => task::findorfail($id)]);
})->name('tasks.edit');

#Show Page
Route::get('/tasks/{id}', function ($id) {
  $task = task::findorFail($id);

  if (!$task) {
    abort(Response::HTTP_NOT_FOUND);
  }

  return view('show', ['task' => $task]);

})->name('tasks.show');


#Create POST Rpute
Route::post('/tasks', function (Request $request) {
    $data = $request->validate([
      'title'=> 'required|max:255',
      'description'=> 'required',
      'long_description'=> 'required'
      ]);

      $task = new Task();

      $task->title = $data['title'];
      $task->description = $data['description'];
      $task->long_description = $data['long_description'];

      $task -> save();

      return redirect()->route('tasks.show', ['id' => $task->id]) -> with('success','Task created successfully!');

})->name('tasks.store');

#Edit PUT Route
Route::put('/tasks/{id}', function ($id, Request $request) {
  $data = $request->validate([
    'title'=> 'required|max:255',
    'description'=> 'required',
    'long_description'=> 'required'
    ]);

    $task = task::findorFail($id);

    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    $task -> save();

    return redirect()->route('tasks.show', ['id' => $task->id]) -> with('success','Task updated successfully!');

})->name('tasks.update');

Route::fallback(function() {
  return 'Diese Seite existiert nicht!';
});
