<div class="wt-tabscontenttitle">
    <h2>{{ trans('lang.your_loc') }}</h2>
</div>
<div class="wt-formtheme">
    <fieldset>
        <div class="form-group form-group-half">
            <span class="wt-select">
                
                <select name="location" class="" placeholder="{{ trans('lang.ph_select_location') }}">
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}" @if ($location->id == Auth::user()->location_id) selected @endif>{{ $location->name }}</option>
                    @endforeach
                </select>

            </span>
        </div>
        <div class="form-group form-group-half">
            
            <input type="text" name="address" value="{{ $address }}" class="form-control" placeholder="{{ trans('lang.ph_your_address')}}" id="pac-input">
        </div>
        <div class="form-group wt-formmap">
            @include('includes.map')
        </div>
        <div class="form-group form-group-half">
            
            <input type="text" name="longitude" value="{{ $longitude }}" class="form-control" placeholder="{{ trans('lang.ph_enter_logitude')}}" id="lng-input">
        </div>
        <div class="form-group form-group-half">
            
            <input type="text" name="latitude" value="{{ $latitude }}" class="form-control" placeholder="{{ trans('lang.ph_enter_latitude')}}" id="lat-input">
        </div>
    </fieldset>
</div>