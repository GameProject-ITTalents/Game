@extends('layouts.app')

@section('content')
    <br>
    <div class="container">
        <h1>Create new Administrator</h1>
        <div class="col-md-6">
            <hr/>
            @if (Session::has('messsage'))
                <div class="bg-info">
                    {{Session::get('message')}}
                </div>
                <hr/>
            @endif
            @if (Session::has('error'))
                <div class="bg-info">
                    {{Session::get('error')}}
                </div>
                <hr/>
            @endif
            <form method="post" action="{{url('admin/createAdmin')}}">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" value="{{old('name')}}">
                    <div class="text-danger">{{$errors->first('name')}}</div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" value="{{old('email')}}">
                    <div class="text-danger">{{$errors->first('email')}}</div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control">
                    <div class="text-danger">{{$errors->first('password')}}</div>
                </div>
                <div class="form-group">
                    <label for="currentPassword">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Create Administrator</button>
                </div>
            </form>
        </div>
    </div>

@endsection