@extends('layouts.app')

@section('content')
<h1>Updated User</h1>
    @foreach($returnedUser as $key => $value)
     <p>{{ $key . ' => ' . $value }}</p>
    @endforeach
@endsection
{{--{{ url('welcome') }}--}}
