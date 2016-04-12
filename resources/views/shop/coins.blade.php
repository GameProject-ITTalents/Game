@extends('layouts.master')

@section('Admin shop', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="container" style="margin-top: 60px">
        <div class="col-md-8 panel-info">
            @if (Session::has('status'))
                <div class="bg-warning" style="padding: 20px">
                    {{ Session::get('status') }}
                </div>
                <hr>
            @endif
            <div><a href="{{ url('/shop') }}">Back to the e-shop</a></div>
            <div class="panel-heading">
                <div class="panel-title">Bundles</div>
            </div>
            <div class="panel-body" >
                <table class="table table-striped">
                    <thead>
                    <th>Name</th>
                    <th>Coins</th>
                    <th>Price</th>
                    @if (Auth::user()->user == 1)
                    <th>Modifications</th>
                    @endif
                    </thead>
                    <tbody>
                        @foreach ($bundles as $product)
                            <tr>
                                <td>{{$product->name}}</td>
                                <td>{{$product->coins}}</td>
                                <td>{{$product->price}} lv</td>
                                @if (Auth::user()->user == 1)
                                    <td style="width: 150px">
                                        <a href="{{ url('/editBundle/' . $product->id) }}"><button class="btn btn-primary">Edit</button></a>
                                        <a href="{{ url('/deleteBundle/' . $product->id) }}"><button class="btn btn-danger">Delete</button></a>
                                    </td>
                                    @else
                                    <td style="width: 150px">
                                        {{--<a href="{{ url('/buyBundle/' . $product->id) }}"><button class="btn btn-success">Add To Cart</button></a>--}}

                                        <form action="/checkout" method="POST">
                                            {!! csrf_field() !!}
                                            <script
                                                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                                    data-key="pk_test_p0QQDCeJQA7W9X9y0VP7QOz5"
                                                    data-amount="{{$product->price * 100}}"
                                                    data-name="Game"
                                                    data-description="Objects in Game"
                                                    data-image="img/mario.png"
                                                    data-locale="euro">
                                            </script>
                                        </form>

                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    @if (Auth::user()->user == 1)
                                        <a href="{{ url('/newBundle') }}"><button class="btn btn-success">Add Bundle</button></a>
                                    @endif
                                </td>
                            </tr>
                        </tfoot>
                </table>
            </div>
        </div>

        {{--@if (Auth::user()->user == 0)
        <div class="col-md-8 panel-info">
            <div class="panel-heading">
                <div class="panel-title">Buy Coins</div>
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <th>Amount</th>
                        <th>Price</th>
                        <td></td>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="number" id="quantity" style="width: 40px" value="0">
                            </td>
                            <td> 1 lv</td>
                            <td style="width: 150px">
                                <a href="#"><button class="btn btn-warning">Buy</button></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endif--}}
    </div>

@endsection