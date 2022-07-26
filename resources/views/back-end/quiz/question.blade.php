@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    @if (session()->has('type'))
        @php session()->forget('type'); @endphp
    @endif
    <section class="wt-haslayout wt-dbsectionspace" id="question-home">
    <div class="row"  style="margin-left: 10px;padding-bottom: 15px;">
                            <ol class="wt-breadcrumb">
                                <li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                                <li><a href="{{ route('quiz.index') }}">{{ trans('lang.quiz') }}</a></li>
                                <li class="active">{{ trans('lang.manage_questions')}}</li>
                            </ol>
                        </div>
        
        <question userid = "{{ Auth::user()->id }}" quizid = "{{ $id }}"></question>
        
    </section>
@endsection
