@extends('layouts.app')
@section('style')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css"> --}}
@endsection
@section('content')
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Task List</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Task</a></li>
                            <li class="breadcrumb-item"><a href="#!">Task List</a></li>
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
                            <table class="table table-striped dataTable" id="tasktable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Employee</th>
                                        <th>Project</th>
                                        <th>hours</th>
                                        <th>remarks</th>
                                        <th>date</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="AddTask" action="{{ route('employe.task.add') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Project</label>
                            <select class="form-control" id="project" name="project">
                                <option value="">Select Project</option>
                                @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="exampleFormControlSelect1" for="hours">Hours</label>
                            <select class="form-control" id="hours" name="hours">
                                <option value="">Select Hours</option>
                                <option value="1">1</option>
                                <option value="1.5">1.5</option>
                                <option value="2">2</option>
                                <option value="2.5">2.5</option>
                                <option value="3">3</option>
                                <option value="3.5">3.5</option>
                                <option value="4">4</option>
                                <option value="4.5">4.5</option>
                                <option value="5">5</option>
                                <option value="5.5">5.5</option>
                                <option value="6">6</option>
                                <option value="6.5">6.5</option>
                                <option value="7">7</option>
                                <option value="7.5">7.5</option>
                                <option value="8">8</option>
                                <option value="8.5">8.5</option>
                                <option value="9">9</option>
                                <option value="9.5">9.5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="floating-label" for="remarks">Remark</label>
                            <input type="text" name="remarks" class="form-control" id="remarks" placeholder="Enter Task Remark">
                        </div>
                        <div class="form-group">
                            <label class="floating-label" for="date">Start Date</label>

                            <input type="date" name="date" class="form-control" id="datepicker" value="{{ date('Y/m/d') }}">
                            {{-- <input type="text" id="startDate" name="startDate"> --}}

                        </div>
                    </div>
                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="employedittask12" tabindex="-1" role="dialog" aria-labelledby="exampleeditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="employedittask">



            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var currentDate = new Date();
        currentDate.setDate(currentDate.getDate() - 2);
        var minDate = currentDate.toISOString().split('T')[0];
        document.getElementById('datepicker').min = minDate;
    });
    $(document).ready(function() {
        $("#AddTask").validate({
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
                var form = $('#AddTask');
                $(form).ajaxSubmit({
                    dataType: 'json',

                    success: function(data) {
                        if (data.status == "success") {
                            form.closest('.modal').modal('hide');
                            notify("Task Successfully Completed", 'success');
                            // $('#datatable').dataTable().api().ajax.reload();
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

        var table = $('#tasktable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('employe.task.list') }}",
            columns: [{
                    "data": "DT_RowIndex",
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'user_name',
                    name: 'user_name'
                },
                {
                    data: 'project_name',
                    name: 'project_name'
                },
                {
                    data: 'hours',
                    name: 'hours'
                },
                {
                    data: 'remarks',
                    name: 'remarks'
                },
                {
                    data: 'date',
                    name: 'date'
                },

                {
                    data: 'action',
                    name: 'action'
                },

            ]
        });
    });

    function viewemployestask(id) {
        $.ajax({
            url: "{{ url('task/edit') }}/" + id,
            type: "GET",
            success: function(data) {

                $('#employedittask12').modal('show');
                $("#employedittask").html(data);
                var currentDate = new Date();
                currentDate.setDate(currentDate.getDate() - 2);
                var minDate = currentDate.toISOString().split('T')[0];
                document.getElementById('datepickers').min = minDate;
            }
        });
    }
</script>
@endsection