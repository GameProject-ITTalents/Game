@extends('layouts.master')

@section('Digital shop', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
<div class="container" style="margin-top: 60px">
    <div class="row" >
        <div class="col-sm-12 col-md-10 col-md-offset-1">
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
                    <?php array_push($url, $item->object_id);  ?>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
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
                        <a href="{{ url('/total/'. $total . '/items/' . $json) }}" class="btn btn-success">Buy with coins</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection