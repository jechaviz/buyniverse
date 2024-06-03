<div class="wt-widget wt-reportjob">
    <div class="wt-widgettitle">
        <h2>{{ trans('lang.report_job') }}</h2>
    </div>
    <div class="wt-widgetcontent">
        
        <form action="{{ url('submit-report') }}" class="wt-formtheme wt-formreport" method="post" id="submit-report" @submit.prevent="submitReport({{ $job->id }}, 'job-report')">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <fieldset>
                <div class="form-group">
                    <span class="wt-select">
                        
                        <select name="reason" class="" placeholder="Select a reason" v-model="report.reason">
                            <option value="" disabled>Select a reason</option>
                            @foreach ($reasons as $reason)
                                <option value="{{ $reason['title'] }}">{{ $reason['title'] }}</option>
                            @endforeach
                        </select>

                    </span>
                </div>
                <div class="form-group">
                    
                    <textarea v-model="report.description" name="description" class="form-control" placeholder="{{ trans('lang.ph_desc'])') }}"></textarea>
                </div>
                <div class="form-group wt-btnarea">
                    
                    <input type="submit" value="{{ trans('lang.btn_submit') }}" class="wt-btn" id="submit-profile">
                </div>
            </fieldset>
        </form>
    </div>
</div>
