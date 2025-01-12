@extends('layout.app')

@section('customstyle')
@stop

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Product List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Product</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Search</h3>
                    </div>
                    <div class="card-body">
                        <form method="get">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="keyword">Name</label>
                                        <input class="form-control" type="text" id="name" name="name" value="{{ $name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-right">
                                    <a class="btn btn-danger" href="{{ url('/products') }}">Reset</a>
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Product</h3>
                        <div style="float:right;">
                            <div style="display: inline-block;">
                                <a href="{{ url('products/create') }}" type="button" class="btn btn-block btn-success btn-sm">Create New Product</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped datatable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Details</th>
                                        <th>Publish</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datas as $item)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{!! nl2br($item->details) !!}</td>
                                        <td>{{ $item->publish == 1 ? 'Yes' : 'No' }}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{url('products')}}/{{$item->id}}">
                                                Show
                                            </a>

                                            &nbsp;

                                            <a class="btn btn-primary" href="{{url('products')}}/{{$item->id}}/edit">
                                                Edit
                                            </a>

                                            &nbsp;

                                            <button class="btn btn-danger" data-route="{{url('products')}}/{{$item->id}}" data-csrf="{{ csrf_token() }}" onclick="removeData(this)">
                                                Delete
                                            </button>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('pagespecificscripts')
@endsection
