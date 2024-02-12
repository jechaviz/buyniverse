@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    @if (session()->has('type'))
        @php session()->forget('type'); @endphp
    @endif
    <div class="wt-dashboardbox">
        <div class="wt-dashboardboxtitle wt-titlewithsearch">
            <h2>{{ trans('lang.quiz')}} : {{ $quiz->title }}</h2> 
            <!--<div class="wt-rightarea">
                <button class="wt-btn">Add Question</button>
            </div>-->
        </div>
        <div class="wt-dashboardboxcontent wt-categoriescontentholder">
            <form method="POST" action="{{ route('postquiz', $quiz->id) }}">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                @foreach ($quiz->questions as $question)
                <div class="row wt-insightsitem wt-dashboardbox" style="margin-left:0;">
                    <div class="row" style="text-align:left;width: 100%;">
                        <h3>{{ $question->question }}</h3>                    
                    </div>
                    @foreach ($question->answers as $answer)
                    <div class="row" style="text-align: left!important;width: 100%;font-size: 20px;margin-top: 20px">
                        <input type="radio" name="question{{$question->id}}" id="answer{{$answer->id}}" value="{{ $question->id }}-{{ $answer->id }}" style="margin-right: 23px;">
                        <label for="answer{{$answer->id}}">{{ $answer->answer }}</label>
                    </div>
                    @endforeach
                </div>
                @endforeach
                <div class="row wt-insightsitem wt-dashboardbox" style="margin-left:0;">
                    <div class="row" style="text-align: left!important;width: 100%;font-size: 20px;margin-top: 20px">
                        <button type="submit" class="wt-btn btn btn-primary btn-sm">
                            Submit
                        </button>
                        <button type="reset" class="wt-btn btn btn-danger btn-sm" style="margin-left: 30px;background-color: gray;">
                            Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
@endsection
