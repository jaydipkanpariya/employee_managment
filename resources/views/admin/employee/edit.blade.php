<div class="modal-header border-bottom-0">
    <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="AddEmployee" action="{{route('employee.add')}}" method="POST">
{{ csrf_field() }}
    <div class="modal-body" >


<div class="form-group" >
    <label class="floating-label" for="Email">Emp Code</label>
    <input type="text" name="emp_code" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Emp Code"  value="{{$emp->emp_code}}" >
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
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
