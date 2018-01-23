<!-- UPDATE TASK MODAL START -->
<div id="update_task_modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Edit Task</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" id="UpdateTask" action="{{ route('edit.task') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Title</label>
                        <input type="hidden" name="id_update" id="id_update" value="$(this).parent().attr('id');">
                        <input name="title_update" type="text" class="form-control" placeholder="Title" id="title_update">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description_update" id="description_update" class="form-control" placeholder="Description"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="input-append date form_datetime">
                            <input id="time_update" name="time_update" size="16" type="text" value="" readonly>
                            <span class="add-on"><i class="icon-th"></i></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="UpdateTask" class="btn btn-primary">
                    Save changes
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- UPDATE TASK MODAL END -->