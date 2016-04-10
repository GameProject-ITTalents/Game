@extends('layouts.master')

@section('Admin shop', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="container" style="margin-top: 60px">
        <div class="col-md-4">
            <img src="{{url($object->image)}}" style="width: 200px" class="img-rounded img-responsive" />
            <label>{{ $object->name }}</label>
            <form id="form" method="post" action="{{url('/updateProduct/' . $object->id)}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <br>
                    <label>Set New Price</label>
                    <input name="price" type="number" style="width: 45px" value="{{ $object->price }}"/>
                    <br><hr>
                    <button type="submit" form="form" class="btn btn-success">Edit Price</button>
                    <br>
                </div>
            </form>
        </div>
    </div>
@endsection