<div class="modal-header border-bottom-0">
    <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="UpdateEmployee" action="{{route('employee.update')}}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{$emp->id}}">
    <div class="modal-body">
        <div class="form-group">
            <label class="floating-label" for="Email">Emp Code</label>
            <input type="text" name="emp_code" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Emp Code" value="{{$emp->emp_code}}">
        </div>
        <div class="form-group">
            <label class="floating-label" for="Email">Name</label>
            <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Your Name" value="{{$emp->name}}">
        </div>
        <div class="form-group">
            <label class="floating-label" for="Email">Email address</label>
            <input type="email" name="emp_email" class="form-control" id="Email" aria-describedby="emailHelp" placeholder="Enter Your Email" value="{{$emp->emp_email}}">
        </div>
        <div class="form-group">
            <label class="floating-label" for="Text">Mobile No</label>
            <input type="text" name="emp_mobile" class="form-control" id="Text" placeholder="Enter Your Mobile No" value="{{$emp->emp_mobile}}">
        </div>
    </div>
    <div class="modal-footer border-top-0 d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
<script>
    $("#UpdateEmployee").validate({
        rules: {
            name: {
                required: true,
            },
            emp_code: {
                required: true,
            },
            emp_email: {
                required: true,
            },
            emp_mobile: {
                required: true,
            },
        },
        messages: {
            emp_code: {
                required: "Please enter Emp Code",
            },
            name: {
                required: "Please enter Name",
            },
            emp_email: {
                required: "Please enter Email",
            },
            emp_mobile: {
                required: "Please enter Mobile",
            },
        },
        errorElement: "p",
        errorPlacement: function(error, element) {
            if (element.prop("tagName").toLowerCase() === "select") {
                error.insertAfter(element.closest(".form-group").find(".select2"));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function() {
            var form = $('#UpdateEmployee');
            $(form).ajaxSubmit({
                dataType: 'json',

                success: function(data) {
                    if (data.status == "success") {
                        form.closest('.modal').modal('hide');
                        notify("Employee Updated Successfully", 'success');
                        $('#employeetable').dataTable().api().ajax.reload();
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