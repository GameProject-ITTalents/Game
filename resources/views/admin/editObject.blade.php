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
                    {{--<label for="img">Image: </label>
                    <input type="file" name="img" />
                    <div class="text-danger">{{$errors->first('image')}}</div>
                    <br>
                    <label>Name</label>
                    <input name="name" type="text" class="form-control" placeholder="{{$object->name}}">
                    <br>
                    <label>Description</label>
                    <br>
                    <input name="description" type="text" class="form-control" placeholder="{{ $object->description }}"/>--}}
                    <br>
                    <label>Set New Price</label>
                    <input name="price" type="number" style="width: 45px" value="{{ $object->price }}"/>
                    <br><hr>
                    <button type="submit" form="form" class="btn btn-success">Edit Price</button>
                    <br>
                </div>
            </form>


            {{--<table class="table table-striped panel-info"">
            <thead  class="panel-heading">
            <th class="panel-title">Image</th>
            <th></th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th></th>
            </thead>
            <tbody class="panel-body">
                <tr>
                    <td><img src="../{{ $object->image }}" style="max-width: 100px"></td>
                    <td style="vertical-align: middle; width: 200px">
                        <label for="img">Image: </label>
                        <input type="file" name="img" />
                        <div class="text-danger">{{$errors->first('image')}}</div>
                    </td>
                    <td style="vertical-align: middle">
                        <input name="name" type="text" size="10" placeholder="{{ $object->name }}"/>
                    </td>
                    <td style="vertical-align: middle">
                        <textarea name="description" id="" cols="20" rows="3">{{ $object->description }}</textarea>
                    </td>
                    <td style="vertical-align: middle">
                        <input name="price" type="number" style="width: 45px" value="{{ $object->price }}"/>
                    </td>
                    <td style="vertical-align: middle; width: 150px">
                        <a href="{{ url('/updateProduct/' . $object->id) }}"><button class="btn btn-primary">Update Object</button></a>
                    </td>
                </tr>
            </tbody>
            </table>--}}
        </div>
    </div>
@endsection