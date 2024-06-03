<div class="wt-widget wt-reportjob">
    <div class="wt-widgettitle">
        <h2>{{ trans('lang.report_service') }}</h2>
    </div>
    <div class="wt-widgetcontent">
        
        <form action="" class="wt-formtheme wt-formreport" id="submit-report" @submit.prevent="submitReport({{ $service->id }},'service-report')">
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
