@extends('layout.app')

@section('customstyle')
@stop

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/users') }}">User List</a></li>
                    <li class="breadcrumb-item active">Add User</li>
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
                        <h3 class="card-title">Add User</h3>
                    </div>
                    <form id="user_form" autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Name <b style="color: red;">*</b></label>
                                        <input type="text" class="form-control" placeholder="Enter name" name="name" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Email <b style="color: red;">*</b></label>
                                        <input type="email" class="form-control" placeholder="Enter email" name="email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Password <b style="color: red;">*</b></label>
                                        <input type="password" class="form-control"  placeholder="Enter Password" id="password" name="password" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Confirm Password <b style="color: red;">*</b></label>
                                        <input type="password" class="form-control"  placeholder="Enter Confirm Password" id="confirm_password" name="confirm_password" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" align="center">
                            <a href="{{ url('users') }}" type="button" class="btn btn-primary">Back</a>
                            &emsp;
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('pagespecificscripts')
<script>
    $('#user_form').submit(function(e) {
        e.preventDefault();
        var form = $(this)[0];  //selector for the current form

        //if form validation passed
        if(form.checkValidity() === true){

            var formData = new FormData(this);
            formData.append("status", "Active");

            if($('#password').val() != $('#confirm_password').val()){
                Swal.fire(
                    'Error!',
                    "Confirm Password Not Match!",
                    'error'
                )
            }

            else{

                $.ajax({
                    type: "POST",
                    url: "{{ url('users') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            position: 'center',
                            type: 'success',
                            title: 'User Added',
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
</script>
@endsection
