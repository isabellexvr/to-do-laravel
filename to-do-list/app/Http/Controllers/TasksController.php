<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TasksController extends Controller{

    public function listTasks(){
        $tasks = Task::with('user')->get();



        return view('home', [
            "todos" => $tasks
        ]);

    }

    // Method to store a new task
    public function store(Request $request){

        //dd(auth()->user()->id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'endsAt' => 'date'
        ]);

        //id: auth()->user()->id

        if(Task::create([
            'userId' => auth()->user()->id,
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'endsAt' => $validatedData['endsAt'],
        ])){

            return redirect()->route('home')->with('success', 'Task created successfully!');
        }

        return redirect()->back()->withErrors([
            'newTask' => 'couldnt create the task',
        ]);


    }

    // Method to update an existing task
    public function update(Request $request, Task $task){
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'endsAt' => 'nullable|date' // Assuming 'endsAt' is a valid date format
        ]);

        // Update the task attributes
        $task->title = $validatedData['title'];
        $task->description = $validatedData['description'];
        $task->endsAt = $validatedData['endsAt'];

        // Save the updated task to the database
        $task->save();

        // Optionally, you can redirect the user to a different page after the update
        return redirect()->route('home')->with('success', 'Task updated successfully');

    }

    // Method to delete a task
    public function destroy(Task $task){
        

        if(Task::destroy($task->id)){
            return redirect()->route('home')->with('success', 'Task deleted successfully');

        }

        return redirect()->back()->withErrors([
            'delete' => 'couldnt delete the task',
        ]);
        // Your logic to delete the task
    }

    public function check(Task $task){
        // Toggle the check field
        $task->done = !$task->done;
        echo "o carai";
    
        if($task->save()){
            return redirect()->route('home')->with('success', 'Task check status updated successfully!');
        }

        return redirect()->back()->withErrors([
            'check' => 'couldnt check the task',
        ]);
        // Redirect back with a success message
    }
    
}
