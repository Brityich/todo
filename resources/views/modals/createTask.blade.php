<!-- CREATE TASK MODAL START -->
<div id="create_task_modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Create New Task</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" id="SaveTask" action="{{ route('save.task') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" class="form-control" placeholder="Title" id="title">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Description"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="input-append date form_datetime">
                            <input id="time" name="time" size="16" type="text" value="" readonly>
                            <span class="add-on"><i class="icon-th"></i></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="SaveTask" class="btn btn-primary">
                    Save changes
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- CREATE TASK MODAL END -->
