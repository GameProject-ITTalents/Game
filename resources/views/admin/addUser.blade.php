@extends('layouts.admin_app')

@section('content')

    <div class="continer-fluid">
        <div class="list-group-item">
            <div>
                <h2>Add User</h2>
            </div>
        </div>
        <form class="list-group-item" action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Profile Picture</label>
                <input type="file" name="image">
            </div>
            <div class="form-group">
                <label for="post_title">Name</label>
                <input type="text" class="form-control" name="post_title">
            </div>
            <div class="form-group">
                <label for="post_author">Email</label>
                <input type="text" class="form-control" name="post_author">
            </div>
            <div class="form-group">
                <label for="post_tags">Password</label>
                <input type="text" class="form-control" name="post_tags">
            </div>
            <div class="form-group">
                <label for="admin_selection">Admin</label>
                <input type="checkbox" name="my-checkbox">

            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="createUser" value="Create User">
            </div>
        </form>
    </div>
@endsection