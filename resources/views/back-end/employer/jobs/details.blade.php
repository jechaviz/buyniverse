@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    @if (session()->has('type'))
        @php session()->forget('type'); @endphp
    @endif
    <link href="{{ asset('css/tasks.css') }}" rel="stylesheet">
    <div class="wt-haslayout wt-dbsectionspace">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="wt-dashboardbox" id="wt-new-added">
                    <div class="wt-dashboardboxtitle">
                        <h2>Job details</h2>
                    </div>
                    <tasks jobid = "{{ $job->id }}" userid = "{{ Auth::user()->id }}" jobtitle = "{{ $job->title }}"></tasks>
                    
                    
                    
                </div>
                
            </div>
        </div>
    </div>
@endsection
