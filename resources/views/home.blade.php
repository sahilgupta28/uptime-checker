@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <div class="row">
                        <!--form -->
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('website.create') }}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                <div class="form-group row">
                                    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                    <div class="col-md-6">
                                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" required autocomplete="current-title" value="{{ old('title') }}">

                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="domain" class="col-md-4 col-form-label text-md-right">{{ __('Domain') }}</label>

                                    <div class="col-md-6">
                                        <input id="domain" type="text" class="form-control @error('domain') is-invalid @enderror" name="domain" value="{{ old('domain') }}" required autocomplete="domain" autofocus>

                                        @error('domain')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="Description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                    <div class="col-md-6">
                                        <textarea id="Description" type="text" class="form-control @error('Description') is-invalid @enderror" name="description" value="{{ old('Description') }}" required>{{ old('description') }}</textarea>

                                        @error('Description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Save') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--/form -->
                        <!--table -->
                        <div class="col-md-12">
                            @include('common.alert')
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Domain</th>
                                    <th scope="col">UP Time Status</th>
                                    <th scope="col">Last Tested</th>
                                    <th scope="col">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($websites as $website)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$website->title}}</td>
                                        <td>{{$website->domain}}</td>
                                        <td>
                                            @foreach($website->testLogs->reverse() as $test_log)
                                                @if($test_log->status)
                                                    <i class="fa fa-check-circle green" data-toggle="tooltip" data-placement="top" title="{{\Carbon\Carbon::parse($test_log->test_at)->diffForHumans()}}"></i>
                                                @else
                                                    <i class="fa fa-times-circle grey"></i>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{\Carbon\Carbon::parse($website->test_at)->diffForHumans()}}</td>
                                        <td>
                                            <form action="{{route('website.test', $website->id)}}" method="POST">
                                            @csrf
                                                <button type="submit" class="btn btn-primary">
                                                {{ __('Test Again') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--/table -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
