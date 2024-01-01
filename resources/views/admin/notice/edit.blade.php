<div class="modal-header border-bottom-0">
    <h5 class="modal-title" id="exampleModalLabel">Edit Project</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="EditProject" action="{{ route('project.update') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $pro->id }}">
    <div class="modal-body">
        <div class="form-group">
            <label class="floating-label" for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Your Name"
                value="{{ $pro->name }}">
        </div>
        <div class="form-group">
            <label class="floating-label" for="client_name">Client Name</label>
            <input type="text" name="client_name" class="form-control" id="client_name"
                placeholder="Enter Your Email" value="{{ $pro->client_name }}">
        </div>
        <div class="form-group">
            <label class="floating-label" for="date">Start Date</label>
            <input type="date" name="date" class="form-control" id="date" value="{{ $pro->date }}">
        </div>
    </div>
    <div class="modal-footer border-top-0 d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
<script>
    $("#EditProject").validate({
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
            var form = $('#EditProject');
            $(form).ajaxSubmit({
                dataType: 'json',

                success: function(data) {
                    if (data.status == "success") {
                        form.closest('.modal').modal('hide');
                        notify("Project Updated Successfully", 'success');
                        $('#projecttable').dataTable().api().ajax.reload();
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
