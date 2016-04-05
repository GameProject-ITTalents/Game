@extends('layouts.master')

@section('Digital shop', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
<div class="container" style="margin-top: 60px">
    <div class="row" >
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
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
                                <a class="thumbnail pull-left" href="#"> <img class="media-object" src="{{$item->object->image}}" style="width: 100px; height: 72px;"> </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#">{{$item->object->name}}</a></h4>
                                </div>
                            </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>{{$item->object->price}} coins</strong></td>
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
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h3>Total</h3></td>
                    <td class="text-right"><h3><strong>{{$total}} coins</strong></h3></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td>
                        <a href="{{ url('/shop') }}"> <button type="button" class="btn btn-default">
                                <span class="fa fa-shopping-cart"></span> Continue Shopping
                            </button>
                        </a></td>
                    <td>
                    <td class="col-md-2">
                        <?php
                            $json = json_encode($url);
                            /*var_dump($json);*/



                        ?>
                        <a href="{{ url('/total/'. $total . '/items/' . $json) }}"><button class="btn btn-success">Buy with coins</button></a>
                        {{--<form action="/checkout" method="POST">
                            {!! csrf_field() !!}
                            <script
                                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                    data-key="pk_test_p0QQDCeJQA7W9X9y0VP7QOz5"
                                    data-amount="{{$total*100}}"
                                    data-name="Game"
                                    data-description="Objects in Game"
                                    data-image="img/mario.png"
                                    data-locale="euro">
                            </script>
                        </form>--}}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection