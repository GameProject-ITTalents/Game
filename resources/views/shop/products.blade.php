@extends('layouts.master')

@section('Admin shop', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="container" style="margin-top: 60px">
        <div class="col-md-12">
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
                                <a href="{{ url('/addProduct/' . $object->id) }}"><button class="btn btn-success">Add To Cart</button></a>
                                <a href="{{ url('/buyCoins') }}"><button class="btn btn-info">Get Coins</button></a>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            {{--@if (Auth::user()->user == 1)
                <tfoot>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><a href="{{ url('/newObject') }}"><button class="btn btn-success">Add Object</button></a></td>
                </tfoot>
            @endif--}}
            </table>
        </div>
    </div>
@endsection