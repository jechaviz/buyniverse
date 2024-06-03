<div class="wt-yourdetails wt-tabsinfo">
    <div class="wt-tabscontenttitle">
        <h2>{{{ trans('lang.your_details') }}}</h2>
    </div>
    <fieldset>
        <div class="form-group form-group-half">
            
            <input type="text" name="first_name" value="{{ Auth::user()->first_name }}" class="form-control" placeholder="{{ trans('lang.ph_first_name')}}">
        </div>
        <div class="form-group form-group-half">
            
            <input type="text" name="last_name" value="{{ Auth::user()->last_name }}" class="form-control" placeholder="{{ trans('lang.ph_last_name')}}">
        </div>
        <div class="form-group">
            
            <input type="text" name="tagline" value="{{ $tagline }}" class="form-control" placeholder="{{ trans('lang.ph_add_tagline')}}">
        </div>
        <div class="form-group">
            <textarea name="description" class="form-control" placeholder="{{ trans('lang.ph_desc'])') }}">{{ $description }}</textarea>
        </div>
    </fieldset>
</div>
