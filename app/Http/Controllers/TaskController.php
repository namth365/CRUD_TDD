<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $tasks = Task::select('*');
        if ($search) {
            $tasks = $tasks->where('name','like','%'.$search.'%');
        }
        $tasks = $tasks->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $task = new Task();
        $task->name = $request->input('name');
        $task->price = $request->input('price');
        $task->image = $request->input('image');

        if ($request->hasFile('image'))
        {
            $get_image          = $request->image;
            $path               ='storage/app/public/images/';
            $get_name_image     = $get_image->getClientOriginalName();
            $name_image         = current(explode('.', $get_name_image));
            $new_image          = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $task->image       = $new_image;
        }

        $task->save();
        return redirect()->route('tasks.index')->with('status','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        return view('tasks.detail',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskUpdateRequest $request, $id)
    {
        $task = Task::find($id);
        $task->name = $request->input('name');
        $task->price = $request->input('price');
        $task->image = $request->input('image');

        $get_image = $request->image;
        if ($request->hasFile('image')) {
            $path ='storage/app/public/images/'.$task->image;
            $path ='storage/app/public/images/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $task->image = $new_image;
            $data['task_image'] =$new_image;
        }
        $task->save();


        return redirect()->route('tasks.index')->with('status','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('status','Success');
    }
}
