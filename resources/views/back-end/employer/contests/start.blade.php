@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
	<div class="wt-haslayout wt-dbsectionspace la-manage-jobs-holder">
		<div class="manage-jobs">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					
					<div class="wt-dashboardbox" id="contest-home">
						<div class="wt-dashboardboxtitle">
							<h2>{{ $contest->title }}  @if($contest->status == 'close' && $result == true) -  Contest is over @endif</h2>
						</div>
						
						<contest contestid="{{ $contest->id}}"></contest>
					</div>




				</div>
			</div>
		</div>
	</div>
@endsection
