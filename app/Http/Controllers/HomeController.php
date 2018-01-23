<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fillings\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Mail\EndtimeNotice;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*echo route('readAll');
        echo route('view.task');
        echo route('edit.task');
        echo route('delete.task');*/
        if(Auth::check()) {
            $user = Auth::id();
            $data = Task::where('user', $user)
                ->get()->toArray();
            return view('home', ['data' => $data]);
        }
        return "Error, you are not login";
    }

    public function saveTask(Request $request)
    {
        $input = $request->only([
            'title',
            'description',
            'time'
        ]);
        //dd($input);
        $task = new Task;
        $task->user = Auth::id();
        $task->title = $input['title'];
        $task->description = $input['description'];
        $task->time = $input['time'];
        $task->done = false;
        $task->save();
        return redirect()->back();
    }
    
    public function deleteTask(Request $request)
    {
        if($request->isMethod('post')) {
            $idDelete = $request->input('id');
            //var_dump($idDelete);
            DB::table('task')->where('id', '=', $idDelete)->delete();
            return redirect()->to(route('home')); 
        }
        return response('Error deleting');
    }

    public function viewTask(Request $request)
    {
        if($request->isMethod('post')) {
            $idDelete = $request->input('id');
            $task = DB::table('task')->where('id', '=', $idDelete)->first();
            $user = DB::table('users')
                    ->where('id', '=', $task->user)
                    ->first();
            return response()->json($task);
        }
        return response('Error');
    }

    public function editTask(Request $request)
    {
        if($request->isMethod('post')) {
            $data_update = $request->all();
            //dd($data_update);
            DB::table('task')
                ->where('id', $data_update['id_update'])
                ->update([
                    'title' => $data_update['title_update'],
                    'description' => $data_update['description_update'],
                    'time' => $data_update['time_update']
                ]);
            return redirect()->back();
        }
        return response('Error');
    }
    
    public function checkTask(Request $request)
    {
        if($request->isMethod('post')) {
            $idCheck = $request->input('id');
            $check = $request->input('check');
            var_dump($idCheck);
            var_dump($check);
            if($check == 'true') {
                DB::table('task')
                    ->where('id', $idCheck)
                    ->update(['done' => true]);
            }
            elseif($check == 'false') {
                DB::table('task')
                    ->where('id', $idCheck)
                    ->update(['done' => false]);
            }
            return redirect()->back();
        }
        return response('Error');
    }

    public function showAllTasks()
    {
        if(Auth::check()) {
            $user = Auth::id();
            $data = Task::all()->toArray();
            $users = User::all()->toArray();
            return view('all', ['data' => $data, 'users' => $users]);
        }
        return "Error";
    }
}