{{--@extends('layouts.app')--}}

@section('content')
<?php echo json_encode(App\User::where('id', Auth::user()->id)->get()); ?>
@endsection
{{--
{{ url('welcome') }}--}}
