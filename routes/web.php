<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Task;

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



Route::get('/tasks', function () {

    return view('index', ['tasks' => Task::all()]);
})->name('tasks.index');

Route::view('tasks/create', 'create')->name('tasks.create');
//Edit
Route::get('/task/{task}/edit', function (Task $task) {

    //Fetch one record.findOrFail method return 404 if not exist.
    return view('edit', ['task' => $task]);
})->name('tasks.edit');

Route::get('/task/{task}', function (Task $task) {
    return view('task', ['task' => $task]); //Fetch one record.findOrFail method return 404 if not exist.
})->name('tasks.task');
Route::get('/', function () {
    return redirect()->route("tasks.index");
});

Route::post('/tasks', function (TaskRequest $request) {
    // $data=$request->validated();
    //     $task = new Task;
    //     $task->title = $data['title'];
    //     $task->description = $data['description'];
    //     $task->long_description = $data['long_description'];
    //     $task->save();
    $task = Task::create($request->validated());
    return redirect()->route('tasks.task', ['task' => $task->id])->with('success', 'Zadatak je uspješno kreiran');
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {

    // $data=$request->validated();
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();
    $task->update($request->validated());
    return redirect()->route('tasks.task', ['task' => $task->id])->with('success', 'Zadatak je uspješno Izmijenjen');
})->name('tasks.update');

    //#Ponoviti 35-u lekciju
    //# 36 lekcija Delete
