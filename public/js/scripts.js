$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/*$(document).ready(function(){
    refreshAllTasks();
});*/

var update_task_temp = null;

$("#task_check").click(function(){
    alert("check");
});

$(".form_datetime").datetimepicker({
    format: "yyyy-mm-dd hh-ii-ss",
    autoclose: true,
    todayBtn: true,
    pickerPosition: "bottom-left"
});
  

/*function saveTask() {
    var formData = {
        'title': $("#title").val(),
        'description': $("#description").val()
    };
    $.ajax({
        url: "http://todo.loc/addtask",
        type: 'POST',
        data: formData,
        success: function (res) {
            refreshAllTasks();
        }
    });

    return false;
}*/

//refresh all
function refreshAllTasks(){
    /*$("#todo-list").empty();
    $.ajax({
        url: "http://todo.loc/readAll",
        type: 'POST',
        success: function (array) {
            //console.log(array);
            array.forEach(function(element){
                createsTasksByParams(element.id, element.title, element.check_field);
            });
        }
    });
    return false;*/
}

function createsTasksByParams(id, title, check) {
    var li = document.createElement('li');
    li.id = id;
    var input = document.createElement('input');
    input.type = 'checkbox';
    //input.value = "";
    input.id = 'task_check';
    if (check) {
        li.className = 'done';
        input.checked = true;
    }
    var span = document.createElement('span');
    span.className = 'text';
    span.innerText = title;
    li.appendChild(input);
    li.appendChild(span);
    var div = document.createElement('div');
    div.className = 'tools';
    var span1 = document.createElement('span');
    var span2 = document.createElement('span');
    var span3 = document.createElement('span');
    span1.className = 'glyphicon glyphicon-eye-open';
    span2.className = 'glyphicon glyphicon glyphicon-pencil';
    span3.className = 'glyphicon glyphicon-remove-circle';
    span1.setAttribute('data-toggle', 'modal');
    span1.setAttribute('data-target', '#view_task_modal');
    span1.setAttribute('onclick', 'viewTask(this);');
    span2.setAttribute('data-toggle', 'modal');
    span2.setAttribute('data-target', '#update_task_modal');
    span2.setAttribute('onclick', 'editTask(this);');
    span3.setAttribute('onclick', 'deleteTask(this);');
    div.appendChild(span1);
    div.appendChild(span2);
    div.appendChild(span3);
    li.appendChild(div);
    $('#todo-list').append(li);
}


function editTask(obj){
    var id = $(obj).parents().eq(1).attr('id');
    $('#id_update').val(id);
    $.ajax({
        url: "http://todo.loc/view.task",
        type: 'POST',
        data: {'id':id},
        success: function (object) {
            update_task_temp = object;
            $('#title_update').val(object.title);
            $('#description_update').val(object.description);
            $('time_update').val(object.time);
            console.log(update_task_temp);
        }
    });
}

function updateTask(){
    update_task_temp.title = $('#title_update').val();
    update_task_temp.description = $('#description_update').val();
    $.ajax({
        url: "http://todo.loc/edit.task",
        type: 'POST',
        data: {'updateTask':update_task_temp},
        success: function (object) {
            refreshAllTasks();
        }
    });
}

function viewTask(obj){
    var id = $(obj).parents().eq(1).attr('id');
    console.log(id);
    $.ajax({
        url: "http://todo.loc/view.task",
        type: 'POST',
        data: {'id':id},
        success: function (object) {
            //object = JSON.parse(object);
            console.log(object);
            $('#title_view').val(object.title);
            $('#description_view').val(object.description);
            $('#time_view').val(object.time);
        }
    });
}

function deleteTask(obj){
    var id = $(obj).parents().eq(1).attr('id');
    //console.log(id);
    $.ajax({
        url: "http://todo.loc/delete.task",
        type: 'POST',
        data: {'id':id},
        success: function () {
            //console.log(res);
            //refreshAllTasks();
            location.reload(); 
        }
    });
    return false;
}

function checkboxClick(obj) {
    var id = $(obj).parent().attr('id');
    var check = $(obj).is(':checked');
    console.log(id);
    console.log(check);
    $.ajax({
        url: "http://todo.loc/check.task",
        type: 'POST',
        data: {'id':id, 'check':check},
        success: function (res) {
            //console.log(res);
            //refreshAllTasks();
            location.reload();
        }
    });
    return false;
}