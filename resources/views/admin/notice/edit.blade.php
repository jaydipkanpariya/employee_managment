<div class="modal-header border-bottom-0">
    <h5 class="modal-title" id="exampleModalLabel">Edit Notice</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="EditNotice" action="{{ route('notice.update') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $pro->id }}">
    <div class="modal-body">
        <div class="form-group">
            <label class="floating-label" for="date">Date</label>
            <input type="date" name="date" class="form-control" id="date"
                value="{{ $pro->date }}">
        </div>
        <div class="form-group">
            <label class="floating-label" for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ $pro->title }}"
                placeholder="Enter Your Title">
        </div>
        <div class="form-group">
            <label class="floating-label" for="description">Description</label>
            <textarea name="description" rows="6" class="form-control" id="description" placeholder="Enter Your Description">{{ $pro->description }}</textarea>
        </div>

    </div>
    <div class="modal-footer border-top-0 d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
<script>
    $("#EditNotice").validate({
        rules: {

            description: {
                required: true,
            },
            title: {
                required: true,
            },
            date: {
                required: true,
            },
        },
        messages: {

            description: {
                required: "Please enter Some Notes",
            },
            title: {
                required: "Please Enter Title",
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
        },
        submitHandler: function() {
            var form = $('#EditNotice');
            $(form).ajaxSubmit({
                dataType: 'json',

                success: function(data) {
                    if (data.status == "success") {
                        form.closest('.modal').modal('hide');
                        notify("Notice Updated Successfully", 'success');
                        $('#noticetable').dataTable().api().ajax.reload();
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
