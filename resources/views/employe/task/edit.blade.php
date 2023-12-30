<div class="modal-header border-bottom-0">
    <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="EditTask" action="{{ route('employee.task.update') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{$emptask->id}}">
    <div class="modal-body">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Project</label>

            <select class="form-control" id="project" name="project">
                <option value="">Select Project</option>
                @foreach ($projects as $project)
                <option value="{{ $project->id }}" {{ ($emptask->project == $project->id) ? 'selected' : ''}}>{{ $project->name }}</option>
                @endforeach
            </select>
            <p id="project-error" class="text-danger"></p>
        </div>
        <div class="form-group">
            <label class="exampleFormControlSelect1" for="hours">Hours</label>
            <select class="form-control" id="hours" name="hours">
                <option value="">Select Hours</option>
                <option value="1" {{ ($emptask->hours == '1') ? 'selected' : ''}}>1</option>
                <option value="1.5" {{ ($emptask->hours == '1.5') ? 'selected' : ''}}>1.5</option>
                <option value="2" {{ ($emptask->hours == '2') ? 'selected' : ''}}>2</option>
                <option value="2.5" {{ ($emptask->hours == '2.5') ? 'selected' : ''}}>2.5</option>
                <option value="3" {{ ($emptask->hours == '3') ? 'selected' : ''}}>3</option>
                <option value="3.5" {{ ($emptask->hours == '3.5') ? 'selected' : ''}}>3.5</option>
                <option value="4" {{ ($emptask->hours == '4') ? 'selected' : ''}}>4</option>
                <option value="4.5" {{ ($emptask->hours == '4.5') ? 'selected' : ''}}>4.5</option>
                <option value="5" {{ ($emptask->hours == '5') ? 'selected' : ''}}>5</option>
                <option value="5.5" {{ ($emptask->hours == '5.5') ? 'selected' : ''}}>5.5</option>
                <option value="6" {{ ($emptask->hours == '6') ? 'selected' : ''}}>6</option>
                <option value="6.5" {{ ($emptask->hours == '6.5') ? 'selected' : ''}}>6.5</option>
                <option value="7" {{ ($emptask->hours == '7') ? 'selected' : ''}}>7</option>
                <option value="7.5" {{ ($emptask->hours == '7.5') ? 'selected' : ''}}>7.5</option>
                <option value="8" {{ ($emptask->hours == '8') ? 'selected' : ''}}>8</option>
                <option value="8.5" {{ ($emptask->hours == '8.5') ? 'selected' : ''}}>8.5</option>
                <option value="9" {{ ($emptask->hours == '9') ? 'selected' : ''}}>9</option>
                <option value="9.5" {{ ($emptask->hours == '9.5') ? 'selected' : ''}}>9.5</option>
            </select>
        </div>
        <div class="form-group">
            <label class="floating-label" for="remarks">Remark</label>
            <input type="text" name="remarks" class="form-control" id="remarks" value="{{ $emptask->remarks}}" placeholder="Enter Task Remark">
        </div>
        <div class="form-group">
            <label class="floating-label" for="date">Start Date</label>

            <input type="date" name="date" class="form-control" value="{{ $emptask->date}}" id="datepickers" value="{{ date('Y/m/d') }}">
            {{-- <input type="text" id="startDate" name="startDate"> --}}

        </div>
    </div>
    <div class="modal-footer border-top-0 d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
<script>
    $("#EditTask").validate({
        rules: {
            project: {
                required: true,
            },
            hours: {
                required: true,
            },
            remarks: {
                required: true,
            },
            date: {
                required: true,
            },
        },
        messages: {
            project: {
                required: "Please Select Project",
            },
            hours: {
                required: "Please Select Task Complted Hours",
            },
            remarks: {
                required: "Please Enter Remark",
            },
            date: {
                required: "Please Enter Start Date",
            },
        },
        errorElement: "p",
        errorPlacement: function(error, element) {
            if (element.prop("tagName").toLowerCase() === "select") {
                error.insertAfter(element.closest(".form-group").find(".select2"));
            } else {
                error.insertAfter(element);
            }
            if (element.is("select")) {
                    error.insertAfter(element);
                } else {
                    error.insertAfter(element);
                }
        },
        submitHandler: function() {
            var form = $('#EditTask');
            $(form).ajaxSubmit({
                dataType: 'json',

                success: function(data) {
                    if (data.status == "success") {
                        form.closest('.modal').modal('hide');
                        notify("Task Updated Successfully", 'success');
                        $('#tasktable').dataTable().api().ajax.reload();
                    } else {
                        notify(data.status, 'warning');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    console.error(status);
                    console.error(error);
                }
            });
            return false;
        }
    });
</script>