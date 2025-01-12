@extends('layout.app')

@section('customstyle')
@stop

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add Product</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/products') }}">Product List</a></li>
                    <li class="breadcrumb-item active">Add Product</li>
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
                        <h3 class="card-title">Add Product</h3>
                    </div>
                    <form id="product_form" autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Name <b style="color: red;">*</b></label>
                                        <input type="text" class="form-control" placeholder="Enter name" name="name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Price <b style="color: red;">*</b></label>
                                        <input type="number" class="form-control" placeholder="Enter price" name="price" step="0.01" onchange="setTwoNumberDecimal" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Details <b style="color: red;">*</b></label>
                                        <textarea type="text" class="form-control" name="details" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Publish <b style="color: red;">*</b></label>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="publish_yes" name="publish" value="1" checked>
                                            <label for="publish_yes">
                                                Yes
                                            </label>
                                        </div>

                                        &emsp;

                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="publish_no" name="publish" value="0">
                                            <label for="publish_no">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" align="center">

                            <a href="{{ url('products') }}" type="button" class="btn btn-primary">Back</a>

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
    $('#product_form').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "{{ url('products') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    position: 'center',
                    type: 'success',
                    title: 'Product Added',
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
    });
</script>
@endsection
