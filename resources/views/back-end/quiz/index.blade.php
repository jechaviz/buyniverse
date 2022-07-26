@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    @if (session()->has('type'))
        @php session()->forget('type'); @endphp
    @endif
    <section class="wt-haslayout wt-dbsectionspace"  id="quiz-home">
    <div class="row"  style="margin-left: 10px;padding-bottom: 15px;">
                            <ol class="wt-breadcrumb">
                                <li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                                <li class="active">{{ trans('lang.quiz')}}</li>
                            </ol>
                        </div>
        <quiz userid = "{{ Auth::user()->id }}"></quiz> 
        
    </section>
@endsection
