@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-6 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading lead clearfix">
                    Tasks
                    <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#create_task_modal">
                        Create New Task
                    </button>
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
                                <input type="checkbox" @if($task["done"]) checked="checked" @endif value="" onclick='checkboxClick(this);'>
                                <span class="text">{{ $task['title'] }}</span>
                                <span class="text">{{ $task['time'] }}</span>
                                <div class="tools">
                                    <span class="glyphicon glyphicon-eye-open" onclick="viewTask(this);" data-toggle="modal" data-target="#view_task_modal" title="Переглянути таск"></span>
                                    <span class="glyphicon glyphicon-pencil" onclick="editTask(this);" data-toggle="modal" data-target="#update_task_modal" title="Змінити таск"></span>
                                    <span class="glyphicon glyphicon-remove-circle" onclick="deleteTask(this);" title="Видалити таск"></span>
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