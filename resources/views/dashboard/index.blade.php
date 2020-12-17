@extends('layouts.app')

@section('content')
<div class="h-full">
@can('user', auth()->user())
@include('dashboard.form')
@endcan
@if(count($websites) > 0)
@include('dashboard.table')
@endif
@endsection
