<?php

namespace App\Http\Controllers\Account;

use App\Events\ChangeStatusTaskEvent;
use App\Events\CreateTaskEvent;

use App\Events\RemoveTaskEvent;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function todoList() {

        $tasks = Task::all();
        return view('todo-list', compact('tasks'));
    }

    public function createTask(Request $request) {

        $task = new Task();

        $task->name = $request->name;
        $task->status = 0;
        $task->save();

        $html = view('blocks.task', compact('task'))->render();

        event(new CreateTaskEvent($html));

    }

    public function changeStatusTask(Request $request) {
        $taskId = $request->id;
        $task = Task::findOrFail($taskId);


        $task->status = 1;
        $task->save();

        event(new ChangeStatusTaskEvent($taskId));


        // возможно docker и позволял бы это сделать, но я не сталкивался с ним....

//        \Mail::send([], [], function ($message) use($task) {
//            $message->to('test@test.com')
//                ->subject('Change status task')
//                ->from('test@test.com')
//                ->setBody('Статус задачи #'.$task->id.' изменен', 'text/html');
//        });

    }

    public function removeTask(Request $request) {

        $taskId = $request->id;
        $task = Task::findOrFail($taskId);


        $task->delete();

        event(new RemoveTaskEvent($taskId));

//        \Mail::send([], [], function ($message) use($task) {
//            $message->to('test@test.com')
//                ->subject('Change status task')
//                ->from('test@test.com')
//                ->setBody('Задача #'.$task->id.' удалена', 'text/html');
//        });

    }
}
