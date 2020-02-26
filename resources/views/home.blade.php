@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @can('gate-in-view')
                            <div class="alert alert-success">
                                View this alert
                            </div>
                        @endcan

                        @can('is-admin')
                            <div class="alert alert-success">
                                Admin is login ...
                            </div>
                        @endcan

                        <user test-route="{{route('had-seen')}}"></user>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
