@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-6 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading lead clearfix">
                    All Tasks
                    <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#create_task_modal">
                        Create New Task
                    </button>
                    <a type="button" class="btn btn-secondary pull-right" href="{{ route('home') }}">
                        Return to my tasks
                    </a>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul id="todo-list" class="todo-list ui-sortable">
                        @foreach ($data as $task)
                            <li id="{{ $task["id"] }}" @if($task["done"]) class="done" @endif>
                                <input type="checkbox" @if($task["done"]) checked="checked" @endif value="" disabled>
                                <span class="text">{{ $task['title'] }}</span>
                                <div class="tools">
                                    <span class="glyphicon glyphicon-eye-open" onclick="viewTask(this);" data-toggle="modal" data-target="#view_task_modal"></span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modals.viewTask')
@include('modals.createTask')
@include('modals.updateTask')

@endsection