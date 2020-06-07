@extends('layouts.app')

@section('content')
<div class="h-full">
@include('dashboard.form')

@if(count($websites) > 0)
@include('dashboard.table')
@endif
@endsection
