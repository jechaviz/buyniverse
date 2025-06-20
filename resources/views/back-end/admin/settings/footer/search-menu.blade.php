
<form action="" class="wt-formtheme wt-skillsform" id="search-menu" @submit.prevent="submitSearchMenu">
@csrf
    <div class="wt-tabscontenttitle">
        <h2>{{{ trans('lang.search_menu') }}}</h2>
    </div>
    <fieldset class="search-content">
        @if (!empty($unserialize_menu_array) && !empty($menu_title))
            @php $counter = 0; @endphp
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    
                    <input type="text" name="menu_title" value="{{ $menu_title->meta_value }}" class="form-control" placeholder="{{ trans('lang.menu_title') }}">
                </div>
            </div>
            @foreach ($unserialize_menu_array as $unserialize_key => $value)
                <div class="wrap-search wt-haslayout">
                    <div class="form-group">
                        <div class="form-group-holder">
                            
                            <input type="text" name="search['{{$counter}}'][title]" value="{{ $value['title'] }}" class="form-control author_title">
                            
                            <input type="text" name="search['{{ $counter }}'][url]" value="{{ $value['url'] }}" class="form-control author_title">
                        </div>
                        <div class="form-group wt-rightarea">
                            @if ($unserialize_key == 0 )
                                <span class="wt-addinfobtn" @click="addSearchItem"><i class="fa fa-plus"></i></span>
                            @else
                                <span class="wt-addinfobtn wt-deleteinfo delete-search" data-check="{{{$counter}}}">
                                    <i class="fa fa-trash"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                @php $counter++; @endphp
            @endforeach
        @else
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    
                    <input type="text" name="menu_title" value="" class="form-control" placeholder="{{ trans('lang.menu_title') }}">
                </div>
            </div>
            <div class="wrap-search wt-haslayout">
                <div class="form-group">
                    <div class="form-group-holder">
                        
                        <input type="text" name="search[0][title]" value="" class="form-control author_title" placeholder="{{ trans('lang.ph_title') }}" v-model="first_search_title">
                        
                         <input type="text" name="search[0][url]" value="" class="form-control author_title" placeholder="{{ trans('lang.ph_url') }}" v-model="first_search_url">
                    </div>
                    <div class="form-group wt-rightarea">
                        <span class="wt-addinfo" @click="addSearchItem"><i class="fa fa-plus"></i></span>
                    </div>
                </div>
            </div>
        @endif
            <div v-for="(search, index) in searches" v-cloak>
                <div class="wrap-search wt-haslayout">
                    <div class="form-group">
                        <div class="form-group-holder">
                            <input placeholder="{{{trans('lang.ph_title')}}}" v-bind:name="'search['+[search.count]+'][title]'"
                                type="text" class="form-control" v-model="search.search_title">
                            <input placeholder="{{{trans('lang.ph_url')}}}" v-bind:name="'search['+[search.count]+'][url]'"
                                type="text" class="form-control" v-model="search.search_url">
                            <div class="form-group wt-rightarea">
                                <span class="wt-addinfo wt-deleteinfo wt-addinfobtn" @click="removeSearchItem(index)"><i class="fa fa-trash"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </fieldset>
    <div class="wt-updatall la-updateall-holder">
        <i class="ti-announcement"></i>
        <span>{{{ trans('lang.save_changes_note') }}}</span>
        <input type="submit" value="{{ trans('lang.btn_save') }}" class="wt-btn">
    </div>
    {{-- <div class="wt-updatall la-updateall-holder">
        
        <input type="submit" value="{{ trans('lang.btn_submit') }}" class="wt-btn wt-btnactive">
    </div> --}}
</form>
