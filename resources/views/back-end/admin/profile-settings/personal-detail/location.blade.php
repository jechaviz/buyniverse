<div class="wt-tabscontenttitle">
    <h2>Your Location</h2>
</div>
<div class="wt-formtheme">
    <fieldset>
        <div class="form-group form-group-half">
            <span class="wt-select">
                
                <select name="location" class="" placeholder="{{ trans('lang.ph_select_location') }}">
                    @foreach ($locations as $key => $value)
                        <option value="{{ $key }}" {{ Auth::user()->location_id == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>

            </span>
        </div>
        <div class="form-group form-group-half">
            
            <input type="text" name="address" value="{{ $address }}" class="form-control" placeholder="{{ trans('lang.ph_your_address')}}">
        </div>
        <div class="form-group wt-formmap">
            <div id="wt-locationmap" class="wt-locationmap"></div>
        </div>
        <div class="form-group form-group-half">
            
            <input type="text" name="longitude" value="{{ $longitude }}" class="form-control" placeholder="{{ trans('lang.ph_enter_logitude')}}">
        </div>
        <div class="form-group form-group-half">
            
            <input type="text" name="latitude" value="{{ $latitude }}" class="form-control" placeholder="{{ trans('lang.ph_enter_latitude')}}">
        </div>
    </fieldset>
</div>