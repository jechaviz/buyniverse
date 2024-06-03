<div class="wt-tabscontenttitle">
    <h2>{{{ trans('lang.your_details') }}}</h2>
</div>
<div class="wt-formtheme">
    <fieldset>
        <div class="form-group form-group-half">
            <span class="wt-select">
                
                <select name="gender" class="form-control" placeholder="{{ trans('lang.ph_select_gender') }}">
                    <option value="male" @if ($gender == 'male') selected @endif>Male</option>
                    <option value="female" @if ($gender == 'female') selected @endif>Female</option>
                </select>

            </span>
        </div>
        <div class="form-group form-group-half">
            
            <input type="text" name="first_name" value="{{ Auth::user()->first_name }}" class="form-control" placeholder="{{ trans('lang.ph_first_name')}}">
        </div>
        <div class="form-group form-group-half">
            
            <input type="text" name="last_name" value="{{ Auth::user()->last_name }}" class="form-control" placeholder="{{ trans('lang.ph_last_name')}}">
        </div>
        <div class="form-group">
            
            <input type="text" name="nickname" value="{{ Auth::user()->nickname }}" class="form-control" placeholder="{{ trans('lang.nickname')}}">
        </div>
        <div class="form-group form-group-half">
            
            <input type="number" name="hourly_rate" value="{{ $hourly_rate }}" class="form-control" placeholder="{{ trans('lang.ph_service_hoyrly_rate')}}">
        </div>
        <div class="form-group">
            
            <input type="text" name="tagline" value="{{ $tagline }}" class="form-control" placeholder="{{ trans('lang.ph_add_tagline')}}">
        </div>
        <div class="form-group">
            
            <textarea name="description" class="form-control" placeholder="{{ trans('lang.ph_desc'])') }}">{{ $description }}</textarea>
        </div>
    </fieldset>
</div>