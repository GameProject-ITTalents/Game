@extends('layouts.app')

@section('content')
    <br>
    <div class="container">
        @if (Session::has('status'))
            <div class="bg-success" style="padding: 20px">
                {{ Session::get('status') }}
            </div>
            <hr>
        @endif
        <section style="padding-bottom: 50px; padding-top: 50px;">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{url($user->avatar)}}" style="width: 200px" class="img-rounded img-responsive" />
                    <br />
                    <form id="form1" method="post" action="{{url('user/updateProfile')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="image">Image: </label>
                            <input type="file" name="image" />
                            <div class="text-danger">{{$errors->first('image')}}</div>
                            <br>
                            <button type="submit" form="form1" class="btn btn-success">Change Image</button>
                        </div>
                    </form>
                    <div class="alert alert-info">
                        <label>Title Reached</label>
                        <h3>{{$user->name}}</h3>
                    </div>

                </div>
                <div class="col-md-8">
                    <div class="form-group col-md-8">
                        <h2>Profile Info</h2>
                        @if (Auth::user()->id == $user->id || Auth::user()->user == 1)
                            <form class="panel" id="form3" method="post" action="{{url('user/updateInfo')}}">
                                {{csrf_field()}}
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="{{$user->name}}">
                                <br>
                                <label>Email</label>
                                <input type="text" class="form-control" placeholder="{{$user->email}}">
                                <br>
                                <button type="submit" form="form3" class="btn btn-success">Change Info</button>
                                <br>
                            </form>
                        @elseif ($user->social == 0 && Auth::user()->id == $user->id)
                            <form class="panel" id="form2" method="post" action="{{url('user/updatePassword')}}">
                                {{csrf_field()}}
                                <label for="currentPassword">Old Password</label>
                                <input type="password" name="currentPassword" class="form-control">
                                <div class="text-danger">{{$errors->first('currentPassword')}}</div>
                                <br>
                                <label for="password">New Password</label>
                                <input type="password" name="password" class="form-control">
                                <div class="text-danger">{{$errors->first('password')}}</div>
                                <label for="currentPassword">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                                <br>
                                <button type="submit" form="form2" class="btn btn-success">Change Password</button>
                            </form>
                            <br />
                        @endif
                    </div>
                </div>
            </div>
            <!-- ROW END -->


        </section>
        <!-- SECTION END -->
    </div>
@endsection