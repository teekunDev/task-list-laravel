<?php

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

class Task
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public ?string $long_description,
        public bool $completed,
        public string $created_at,
        public string $updated_at
    ) {
    }
}



Route::get('/', function () {
    return redirect()->route('tasks.index');
});


Route::get('/tasks', function () {
    return view('index', [
      'tasks' => \App\Models\Task::latest()->where('completed',true)->get()
    ]);
})->name('tasks.index');


Route::view('/tasks/create', 'create')
    ->name('tasks.create');


Route::get('/tasks/{id}', function ($id) {
  $task = \App\Models\Task::findorFail($id);

  if (!$task) {
    abort(Response::HTTP_NOT_FOUND);
  }

  return view('show', ['task' => $task]);

})->name('tasks.show');

Route::post('/tasks', function (Request $request) {
    dd($request->all());
})->name('tasks.store');

Route::fallback(function() {
  return 'Diese Seite existiert nicht!';
});
