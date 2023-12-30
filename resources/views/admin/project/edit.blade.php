<div class="modal-header border-bottom-0">
    <h5 class="modal-title" id="exampleModalLabel">Edit Project</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="AddProject" action="{{ route('project.add') }}" method="POST">
    {{ csrf_field() }}
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
