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
                                <h5 class="m-b-10">Notice List</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Notice List</a></li>
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
                            <button type="button" class="btn btn-primary m-t-5 mr-4 mt-2" data-toggle="modal"
                                data-target="#form">
                                Add
                            </button>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-striped dataTable" id="noticetable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Title</th>
                                            <th>Notes</th>
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

        <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title" id="exampleModalLabel">Add Notice</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="AddNotice" action="{{ route('notice.add') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="floating-label" for="date">Date</label>
                                <input type="date" name="date" class="form-control" id="date"
                                    value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                <label class="floating-label" for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title" value=""
                                    placeholder="Enter Your Title">
                            </div>
                            <div class="form-group">
                                <label class="floating-label" for="description">Description</label>
                                <textarea name="description" rows="6" class="form-control" id="description" placeholder="Enter Your Description"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer border-top-0 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editprojects" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" id="projectdetails">

                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {


            $("#AddNotice").validate({
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
                    var form = $('#AddNotice');
                    $(form).ajaxSubmit({
                        dataType: 'json',

                        success: function(data) {
                            if (data.status == "success") {
                                form[0].reset();
                                form.closest('.modal').modal('hide');
                                notify("Notice Successfully Completed", 'success');
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
            var table = $('#noticetable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('notice.list') }}",
                columns: [{
                        "data": "DT_RowIndex",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },

                ]
            });
        });

        function viewproject(id) {
            $.ajax({
                url: "{{ url('admin/notice/edit') }}/" + id,
                type: "GET"

                    ,
                success: function(data) {
                    $('#editprojects').modal('show');
                    $("#projectdetails").html(data);
                }
            });
        }
    </script>
@endsection
