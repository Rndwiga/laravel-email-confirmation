@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans( 'LEC::LEC.view.confirm.title' ) }}</div>
                <div class="panel-body">
                    <form name="confirm-email" class="form-horizontal" method="POST" action="{{ url( config('LEC.route_prefix').'/email' ) }}">
                        {{csrf_field()}}
                        <div class="form-group{{ ( !empty( $errors ) && $errors->has('email') ) ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{{ trans( 'LEC::LEC.view.confirm.email' ) }}</label>
                            <div class="col-md-6">
                                <input type="text" name="email" class="form-control" value="@if(auth()->check()){{auth()->user()->email}}@endif" placeholder="E-Mail" />
                                @if ( !empty( $errors ) && $errors->has('email') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ ( !empty( $errors ) && $errors->has('vcode') ) ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{{ trans( 'LEC::LEC.view.confirm.vcode' ) }}</label>
                            <div class="col-md-6">
                                <input type="text" name="vcode" class="form-control" value="{{ $hash }}" placeholder="" />
                                @if ( !empty( $errors ) && $errors->has('email') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <input type="submit" class="btn btn-primary">

                                <a class="btn btn-link" href="{{ url( config('LEC.route_prefix').'/repeat' ) }}">
                                    {{ trans( 'LEC::LEC.view.confirm.resend' ) }}
                                </a>
                            </div>
                        </div>
                    </form>
                    @if ( !empty( $errors ) && $errors->has('general') )
                    <span class="text-center help-block">
                        <strong>{{ $errors->first('general') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
