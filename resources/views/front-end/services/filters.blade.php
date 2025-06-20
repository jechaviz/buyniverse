<aside id="wt-sidebar" class="wt-sidebar">
    
    <form action="{{ url('search-results') }}" class="wt-formtheme wt-formsearch" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" value="{{$type}}" name="type">
        <div class="wt-widget wt-effectiveholder wt-startsearch">
            <div class="wt-widgettitle">
                <h2>{{ trans('lang.start_search') }}</h2>
            </div>
            <div class="wt-widgetcontent">
                <div class="wt-formtheme wt-formsearch">
                    <fieldset>
                        <div class="form-group">
                            <input type="text" name="s" class="form-control" placeholder="{{ trans('lang.ph_search_services') }}" value="{{$keyword}}">
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="wt-widget wt-widgetrange">
            <div class="wt-widgettitle">
                <h2>{{ trans('lang.price_range') }}</h2>
            </div>
            <div class="wt-widgetcontent">
                <div class="wt-formtheme wt-formsearch">
                    <fieldset>
                        <div class="wt-amountbox">
                            <input type="text" :value="'{{ !empty($symbol['symbol']) ? $symbol['symbol'] : '$' }}'+start+'-{{ !empty($symbol['symbol']) ? $symbol['symbol'] : '$' }}'+end" id="wt-consultationfeeamount" readonly="">
                        </div>
                        <a-slider 
                            id="wt-pricerange"
                            class="wt-productrangeslider wt-themerangeslider"
                            range
                            :min="0"
                            :max="max_value"
                            :reverse="reverse"
                            @change="onChange"
                            :default-value="[start, end]"
                            ref="priceRange"
                            v-if="show_price_slider"
                        />
                    </fieldset>
                    <input type="hidden" name="minprice" :value="start">
                    <input type="hidden" name="maxprice" :value="end">
                </div>
            </div>
        </div>
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgettitle">
                <h2>{{ trans('lang.cats') }}</h2>
            </div>
            <div class="wt-widgetcontent">
                <fieldset>
                    <div class="form-group">
                        <input type="text" class="form-control filter-records" placeholder="{{ trans('lang.ph_search_cat') }}">
                        <a href="javascrip:void(0);" class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></a>
                    </div>
                </fieldset>
                <fieldset>
                    @if (!empty($categories))
                        <div class="wt-checkboxholder wt-verticalscrollbar">
                            @foreach ($categories as $category)
                                @php $checked = in_array($category->slug, (array) request()->query('category', [])) ? 'checked' : ''; @endphp
                                <span class="wt-checkbox">
                                    <input id="cat-{{{ $category->slug }}}" type="checkbox" name="category[]" value="{{{ $category->slug }}}" {{$checked}} >
                                    <label for="cat-{{{ $category->slug }}}"> {{{ $category->title }}}</label>
                                </span>
                            @endforeach
                        </div>
                    @endif
                </fieldset>
            </div>
        </div>
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgettitle">
                <h2>{{ trans('lang.locations') }}</h2>
            </div>
            <div class="wt-widgetcontent">
                <fieldset>
                    <div class="form-group">
                        <input type="text" class="form-control filter-records" placeholder="{{ trans('lang.ph_search_locations') }}">
                        <a href="javascrip:void(0);" class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></a>
                    </div>
                </fieldset>
                <fieldset>
                    @if (!empty($locations))
                        <div class="wt-checkboxholder wt-verticalscrollbar">
                            @foreach ($locations as $location)
                                @php 
                                    $checked = '';
                                    $selectedLocations = request()->query('locations');
                                    if (!empty($selectedLocations)) {
                                        if (is_array($selectedLocations) && in_array($location->slug, $selectedLocations)) {
                                            $checked = 'checked';
                                        } elseif ($location->slug == $selectedLocations) {
                                            $checked = 'checked';
                                        }
                                    }
                                @endphp
                                <span class="wt-checkbox">
                                    <input id="location-{{{ $location->slug }}}" type="checkbox" name="locations[]" value="{{{$location->slug}}}" {{$checked}} >
                                    <label for="location-{{{ $location->slug }}}"> <img src="{{{asset(Helper::getLocationFlag($location->flag))}}}" alt="{{ trans('lang.img') }}"> {{{ $location->title }}}</label>
                                </span>
                            @endforeach
                        </div>
                    @endif
                </fieldset>
            </div>
        </div>
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgettitle">
                <h2>{{ trans('lang.langs') }}</h2>
            </div>
            <div class="wt-widgetcontent">
                <fieldset>
                    <div class="form-group">
                        <input type="text" class="form-control filter-records" placeholder="{{ trans('lang.ph_search_langs') }}">
                        <a href="javascrip:void(0);" class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></a>
                    </div>
                </fieldset>
                <fieldset>
                    @if (!empty($languages))
                        <div class="wt-checkboxholder wt-verticalscrollbar">
                            @foreach ($languages as $language)
                                @php $checked = in_array($language->slug, (array) request()->query('languages', [])) ? 'checked' : '' @endphp
                                <span class="wt-checkbox">
                                    <input id="language-{{{ $language->slug }}}" type="checkbox" name="languages[]" value="{{{$language->slug}}}" {{$checked}} >
                                    <label for="language-{{{ $language->slug }}}">{{{ $language->title }}}</label>
                                </span>
                            @endforeach
                        </div>
                    @endif
                </fieldset>
            </div>
        </div>
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgettitle">
                <h2>{{ trans('lang.delivery_time') }}</h2>
            </div>
            <div class="wt-widgetcontent">
                <fieldset>
                    <div class="form-group">
                        <input type="text" class="form-control filter-records" placeholder="{{ trans('lang.ph_search_delivery_time') }}" >
                        <a href="javascrip:void(0);" class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></a>
                    </div>
                </fieldset>
                <fieldset>
                    @if (!empty($delivery_time))
                        <div class="wt-checkboxholder wt-verticalscrollbar">
                            @foreach ($delivery_time as $time)
                                @php $checked = in_array($time->slug, (array) request()->query('delivery_time', [])) ? 'checked' : '' @endphp
                                <span class="wt-checkbox">
                                    <input id="time-{{{ $time->slug }}}" type="checkbox" name="delivery_time[]" value="{{{$time->slug}}}" {{$checked}} >
                                    <label for="time-{{{ $time->slug }}}">{{{ $time->title }}}</label>
                                </span>
                            @endforeach
                        </div>
                    @endif
                </fieldset>
            </div>
        </div>
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgettitle">
                <h2>{{ trans('lang.response_time') }}</h2>
            </div>
            <div class="wt-widgetcontent">
                <fieldset>
                    <div class="form-group">
                        <input type="text" class="form-control filter-records" placeholder="{{ trans('lang.ph_search_response_time') }}">
                        <a href="javascrip:void(0);" class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></a>
                    </div>
                </fieldset>
                <fieldset>
                    @if (!empty($response_time))
                        <div class="wt-checkboxholder wt-verticalscrollbar">
                            @foreach ($response_time as $time)
                                @php $checked = in_array($time->slug, (array) request()->query('response_time', [])) ? 'checked' : '' @endphp
                                <span class="wt-checkbox">
                                    <input id="time-{{{ $time->slug }}}" type="checkbox" name="response_time[]" value="{{{$time->slug}}}" {{$checked}} >
                                    <label for="time-{{{ $time->slug }}}">{{{ $time->title }}}</label>
                                </span>
                            @endforeach
                        </div>
                    @endif
                </fieldset>
            </div>
        </div>
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgetcontent">
                <div class="wt-applyfilters">
                    <span>{{ trans('lang.apply_filter') }}<br> {{ trans('lang.changes_by_you') }}</span>
                    
                    <input type="submit" value="{{ trans('lang.btn_apply_filters') }}" class="wt-btn">
                </div>
            </div>
        </div>
    </form>
</aside>
