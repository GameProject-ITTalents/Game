@extends('layouts.master')

@section('Admin shop', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="container" style="margin-top: 60px">
        <div class="col-md-4">
            <label>{{ $bundle->name }}</label>
            <form id="form" method="post" action="{{url('/updateBundle/' . $bundle->id)}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    {{--<label for="img">Image: </label>
                    <input type="file" name="img" />
                    <div class="text-danger">{{$errors->first('image')}}</div>--}}
                    <br>
                    <label>Name</label>
                    <input name="name" type="text" class="form-control" placeholder="{{$bundle->name}}">
                    <br>
                    <label>Coins</label>
                    <br>
                    <input name="coins" type="text" class="form-control" placeholder="{{ $bundle->coins }}"/>
                    <br>
                    <label>Set New Price</label>
                    <input name="price" type="number" style="width: 45px" value="{{ $bundle->price }}"/>
                    <br><hr>
                    <button type="submit" form="form" class="btn btn-success">Edit Price</button>
                    <br>
                </div>
            </form>
        </div>
    </div>
@endsection