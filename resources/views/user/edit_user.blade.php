@extends('layout.app')

@section('customstyle')
@stop

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>User Details</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/users') }}">User</a></li>
                    <li class="breadcrumb-item active">User Details</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" value="{{ $datas->name }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" value="{{ $datas->email }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Status</label>
                                    <input type="text" class="form-control" value="{{ $datas->status }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" align="center">

                        <a href="{{ url('users') }}" type="button" class="btn btn-primary">Back</a>

                        &emsp;

                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#change-password-modal">
                            Change Password
                        </button>

                        &emsp;

                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit-modal">
                            Edit Details
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="edit-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Details Edit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit_form" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Name <b style="color: red;">*</b></label>
                                    <input type="text" class="form-control" placeholder="Enter name" name="name" value="{{ $datas->name }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Email <b style="color: red;">*</b></label>
                                    <input type="email" class="form-control" placeholder="Enter email" name="email" value="{{ $datas->email }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Status <b style="color: red;">*</b></label>
                                    <select class="form-control" name="status" required>
                                        <option value="">Select Status</option>
                                        <option {{ $datas->status == 'ACTIVE' ? "selected" : "" }}>ACTIVE</option>
                                        <option {{ $datas->status == 'DEACTIVE' ? "selected" : "" }}>DEACTIVE</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="change-password-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Change Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="password_form" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" class="form-control" name="new_password" id="new_password"  placeholder="Enter New Password" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Enter Confirm Password" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('pagespecificscripts')
<script>
    $(function(){

        $('#edit_form').submit(function(e) {
            e.preventDefault();
            var form = $(this)[0];  //selector for the current form

            //if form validation passed
            if(form.checkValidity() === true){

                var formData = new FormData(this);
                formData.append("_method", "PUT");

                $.ajax({
                    type: "POST",
                    url: "{{ url('users') }}" + "/{{ $datas->id }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            position: 'center',
                            type: 'success',
                            title: 'User Info Edited',
                            showConfirmButton: true,
                        })
                        setTimeout(function() {
                            window.location.replace("{{ url('users') }}");
                        }, 1500);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            "Failed! Please try again.",
                            'error'
                        )
                        console.log(error);
                    }
                });
            }
        });

        $('#password_form').submit(function(e) {
            e.preventDefault();
            var form = $(this)[0];  //selector for the current form

            //if form validation passed
            if(form.checkValidity() === true){

                var formData = new FormData(this);
                formData.append("_method", "PUT");

                if($('#new_password').val() != $('#confirm_password').val()){
                    Swal.fire(
                        'Error!',
                        "Confirm Password Not Match!",
                        'error'
                    )
                }

                else{

                    $.ajax({
                        type: "POST",
                        url: "{{ url('users') }}" + "/{{ $datas->id }}/change_password",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                position: 'center',
                                type: 'success',
                                title: 'Password Changed',
                                showConfirmButton: true,
                            })
                            setTimeout(function() {
                                window.location.reload();
                            }, 1500);
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                "Failed! Please try again.",
                                'error'
                            )
                            console.log(error);
                        }
                    });
                }
            }
        });
    })
</script>
@endsection
