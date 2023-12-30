@extends('layouts.app')
@section('content')
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Employee List</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Employee</a></li>
                            <li class="breadcrumb-item"><a href="#!">Employee List</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ stiped-table ] start -->
            <div class="col-xl-12">
                <div class="card">
                    <!-- <div>
                        <h5>Striped Table</h5>
                        <span class="d-block m-t-5">use class <code>table-striped</code> inside table element</span>
                    </div> -->


                    <div class="justify-content-end d-flex">
                        <button type="button" class="btn btn-primary m-t-5 mr-4 mt-2" data-toggle="modal" data-target="#form">
                            Add
                        </button>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped dataTable" id="employeetable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Emp Code</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile No</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ stiped-table ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>

    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="AddEmployee" action="{{route('employee.add')}}" method="POST">
                {{ csrf_field() }}
                    <div class="modal-body">
                    <div class="form-group">
                            <label class="floating-label" for="Email">Emp Code</label>
                            <input type="text" name="emp_code" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Emp Code">
                        </div>
                        <div class="form-group">
                            <label class="floating-label" for="Email">Name</label>
                            <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Your Name">
                        </div>
                        <div class="form-group">
                            <label class="floating-label" for="Email">Email address</label>
                            <input type="email" name="emp_email" class="form-control" id="Email" aria-describedby="emailHelp" placeholder="Enter Your Email">
                        </div>
                        <div class="form-group">
                            <label class="floating-label" for="Text">Mobile No</label>
                            <input type="text" name="emp_mobile" class="form-control" id="Text" placeholder="Enter Your Mobile No">
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="employedit12" tabindex="-1" role="dialog" aria-labelledby="exampleeditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="employedit">



            </div>
        </div>
    </div>
</section>

@endsection
@section('scripts')
<script>
    $(document).ready(function() {


        $("#AddEmployee").validate({
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
                var form = $('#AddEmployee');
                $(form).ajaxSubmit({
                    dataType: 'json',

                    success: function(data) {
                        if (data.status == "success") {
                            form.closest('.modal').modal('hide');
                            notify("Employee Successfully Completed", 'success');
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
        var table = $('#employeetable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('employee.list') }}",
            columns: [{
                    "data": "DT_RowIndex",
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'emp_code',
                    name: 'emp_code'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'emp_email',
                    name: 'emp_email'
                },
                {
                    data: 'emp_mobile',
                    name: 'emp_mobile'
                },
                {
                    data: 'action',
                    name: 'action'
                },

            ]
        });


    });
    function viewemployes(id) {
            $.ajax({
                url: "{{ url('admin/employee/edit') }}/" + id,
                type: "GET"

                    ,
                success: function(data) {
                    $('#employedit12').modal('show');
                    $("#employedit").html(data);
                }
            });
        }
</script>
@endsection
