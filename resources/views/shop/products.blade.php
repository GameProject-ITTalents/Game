@extends('layouts.master')

@section('Admin shop', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="container" style="margin-top: 60px">
        <div class="col-md-12">
            @if (Session::has('status'))
                <br>
                <div class="bg-success" style="padding: 20px">
                    {{ Session::get('status') }}
                </div>
                <hr>
            @endif
            <table class="table table-striped panel-info">
                <thead  class="panel-heading">
                <th class="panel-title">Objects</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                @if (Auth::user()->user == 0)
                    <th>Amount</th>
                @else
                    <th></th>
                @endif
                @if (Auth::user()->user == 1)
                    <th>Modifications</th>
                    @else
                    <th> </th>
                @endif
                </thead>
                <tbody class="panel-body">
                <?php $modal=0; ?>
                @foreach ($objects as $object)
                    <tr>
                        <td><img src="{{ $object->image }}" class="media-object" style="max-width: 100px"></td>
                        <td style="vertical-align: middle"><h3>{{ $object->name }}</h3></td>
                        <td style="vertical-align: middle">{{ $object->description }}</td>
                        <td style="vertical-align: middle">{{ $object->price }}</td>
                        @if (Auth::user()->user == 0)
                            <td style="vertical-align: middle"><input type="number" id="quantity" style="width: 40px" value="0"></td>
                        @else
                            <td></td>
                        @endif
                        @if (Auth::user()->user == 1)
                            <td style="vertical-align: middle"td style="width: 150px">
                                <a href="{{ url('/editProduct/' . $object->id) }}"><button class="btn btn-primary">Edit Price</button></a>
                                {{--<a href="{{ url('/deleteProduct/' . $object->id) }}"><button class="btn btn-danger">Delete</button></a>--}}
                            </td>
                        @else
                            <td style="vertical-align: middle"td style="width: 220px">
                                {{--<a href="{{ url('/addProduct/' . $object->id) }}"><button class="btn btn-success">Add To Cart</button></a>--}}

                                    <button type="button" data-toggle="modal" data-target="#confirmAdd{{$modal}}" class="btn btn-success">Add To Cart</button>
                                    <div class="modal fade" id="confirmAdd{{$modal}}" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Do you wish to add the item to the cart?</h4>
                                                </div>
                                                <div class="modal-body col-md-12">
                                                    <div class="col-md-4"><img src="{{ $object->image }}" class="media-object" style="max-width: 100px"></div>
                                                    <div class="col-md-4"><h3>{{ $object->name }}</h3></div>
                                                    <div class="col-md-4"><h3>{{ $object->price }} coins</h3></div>
                                                    <hr>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="pull-left">
                                                        <a href="{{ url('/addProduct/' . $object->id) }}"><button class="btn btn-success">Add To Cart</button></a>
                                                    </div>
                                                    <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $modal++ ?>
                                <a href="{{ url('/buyCoins') }}"><button class="btn btn-info">Get Coins</button></a>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection