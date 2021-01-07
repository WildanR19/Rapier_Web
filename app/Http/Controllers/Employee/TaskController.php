<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $task = Task::all();
        $data = [
            'tasks'     => $task,
        ];
        return view('employee.goals.index')->with($data);
    }
}
