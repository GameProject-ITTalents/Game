
@extends('layouts.master')

@section('New Product', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="panel panel-info" style="margin-top: 60px">
        <div class="panel-heading">
            <div class="panel-title">New Bundle</div>
        </div>
        <div class="panel-body" >
            <form method="POST" action="{{ url('saveBundle') }}" class="form-horizontal" enctype="multipart/form-data" role="form">
                {!! csrf_field() !!}
                <fieldset>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Name</label>
                        <div class="col-md-9">
                            <input id="name" name="name" type="text" placeholder="Product name" class="form-control input-md" required="">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="textarea">Coins</label>
                        <div class="col-md-9">
                            <input id="coins" name="coins" type="number" placeholder="Coins" class="form-control input-md" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="price">Price</label>
                        <div class="col-md-9">
                            <input id="price" name="price" type="text" placeholder="Product price" class="form-control input-md" required="">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="submit"></label>
                        <div class="col-md-9">
                            <button id="submit" name="submit" class="btn btn-primary">Create Object</button>
                        </div>
                    </div>

                </fieldset>

            </form>
        </div>
    </div>
@endsection