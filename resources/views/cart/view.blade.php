@extends('layouts.master')

@section('Digital shop', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
<div class="container" style="margin-top: 60px">
    <div class="row" >
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            @if (Session::has('additionStatus'))
                <br>
                <div class="bg-success" style="padding: 20px">
                    {{ Session::get('additionStatus') }}
                </div>
                <hr>
            @endif
            <table class="table table-hover panel-info">
                <thead class="panel-heading">
                <tr>
                    <th>Product</th>
                    <th></th>
                    <th class="text-center"></th>
                    <th class="text-center">Total</th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                <?php $url = []; ?>

                @foreach($items as $item)
                    <tr>
                        <td class="col-sm-8 col-md-6">
                            <div class="media">
                                <img class="media-object thumbnail pull-left" src="{{$item->object->image}}" style="width: 100px">
                                <div class="media-body">
                                    <h4 class="media-heading" style="margin: 5px 20px">{{$item->object->name}}</h4>
                                </div>
                            </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"></td>
                        <td class="col-sm-1 col-md-1 text-center"> <strong>{{$item->object->price}} coins</strong></td>
                        <td class="col-sm-1 col-md-1">
                            <a href="{{ url('/removeItem/'. $item->id) }}"> <button type="button" class="btn btn-danger">
                                    <span class="fa fa-remove"></span> Remove
                                </button>
                            </a>
                        </td>
                    </tr>
                    <?php
                        array_push($url, $item->object_id);
                        $modal = 0;
                    ?>
                @endforeach
                <tr>
                    @if ($total >= Auth::user()->coins )
                        <td><h3  class="text-center" style="color: red">You don't have enough coins</h3></td>
                        <td></td>
                        <td>
                            <a style="margin-top: 17px" class="btn btn-primary" href="{{ url('/buyCoins') }}">Buy Coins</a>
                        </td>
                    @else
                        <td></td>
                        <td></td>
                        <td></td>
                    @endif
                    <td><h3>Total</h3></td>
                    <td class="text-right"><h3><strong>{{$total}} coins</strong></h3></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="{{ url('/shop') }}" class="btn btn-info">
                                <span class="fa fa-shopping-cart"></span> Continue Shopping
                        </a>
                    <td>
                    <td>
                        <?php $json = json_encode($url); ?>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#buy{{$modal}}">Buy with coins</button>
                            @if(Auth::user()->coins >= $total)
                            <div class="modal fade" id="buy{{$modal}}" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Are you sure you want to buy Power-ups?</h4>
                                        </div>
                                        <div class="modal-body">
                                            @foreach($items as $item)
                                                <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-2"><img class="media-object thumbnail pull-left" src="{{$item->object->image}}" style="width: 60px"></div>
                                                    <div class="col-md-6"><h4>{{ $item->object->name }}</h4></div>
                                                    <div class="col-md-4"><h4>{{ $item->object->price }} coins</h4></div>
                                                </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <div class="pull-left">
                                                <a href="{{ url('/total/'. $total . '/items/' . $json) }}" class="btn btn-success">Buy with coins</a>
                                            </div>
                                            <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                                <div class="modal fade" id="buy{{$modal}}" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title text-center" style="color: red" id="myModalLabel">You don't have enough coins</h4>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4>Do you wish to buy more coins?</h4>
                                                        <a class="btn btn-info" href="{{ url('/buyCoins') }}">Buy Coins</a>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <?php $modal++ ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection