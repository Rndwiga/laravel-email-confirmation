@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-warning">
                <div class="panel-heading">{{ trans( 'LEC::LEC.view.confirm.title' ) }}</div>
                <div class="panel-body">
                    <p>{{ trans( 'LEC::LEC.view.confirm.already-confirmed' ) }}</p>
                    <p>
                        <a href="{{ url('/') }}">{{ trans( 'LEC::LEC.view.confirm.goto-index' ) }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
