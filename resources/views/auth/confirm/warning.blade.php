@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-warning">
					<div class="panel-heading">{{ trans( 'LEC::LEC.view.warning.title' ) }}</div>
					<div class="panel-body">
						<p>{!! trans( 'LEC::LEC.view.warning.message' ) !!}</p>
						<p>
							<a href="{{ url( config('LEC.route_prefix').'/repeat' ) }}">
								{{ trans( 'LEC::LEC.view.warning.goto-resend' ) }}
							</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>


@endsection
