@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
<div class="wt-haslayout wt-dbsectionspace">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 float-left" id="services">
            <div class="preloader-section" v-if="loading" v-cloak>
                <div class="preloader-holder">
                    <div class="loader"></div>
                </div>
            </div>
            <div class="wt-haslayout wt-post-job-wrap">
                
                <form action="{{ url('service/update-service') }}" class="wt-haslayout" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" value="{{$service->id}}" name="id">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle">
                            <h2>{{ trans('lang.update_service') }}</h2>
                        </div>
                        <div class="wt-dashboardboxcontent">
                            <div class="wt-jobdescription wt-tabsinfo">
                                <div class="wt-tabscontenttitle">
                                    <h2>{{ trans('lang.service_desc') }}</h2>
                                </div>
                                <div class="wt-formtheme wt-userform wt-userformvtwo">
                                    <fieldset>
                                        <div class="form-group">
                                            
                                            <input type="text" name="title" value="{{ $service->title }}" class="form-control" placeholder="{{ trans('lang.service_title') }}">
                                        </div>
                                        <div class="form-group form-group-half wt-formwithlabel">
                                            <span class="wt-select">
                                                
                                                <select name="delivery_time" class="" placeholder="{{ trans('lang.select_delivery_time') }}">
                                                    @foreach ($delivery_time as $time)
                                                        <option value="{{ $time->id }}" @if ($time->id == $service->delivery_time_id) selected @endif>{{ $time->name }}</option>
                                                    @endforeach
                                                </select>

                                            </span>
                                        </div>
                                        <div class="form-group form-group-half wt-formwithlabel job-cost-input">
                                            
                                            <input type="number" name="service_price" value="{{ $service->price }}" class="" placeholder="{{ trans('lang.service_price')}}">
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="wt-jobcategories wt-tabsinfo">
                                <div class="wt-tabscontenttitle">
                                    <h2>{{ trans('lang.service_cats') }}</h2>
                                </div>
                                <div class="wt-divtheme wt-userform wt-userformvtwo">
                                    <div class="form-group">
                                        <span class="wt-select">
                                            
                                            <select class="chosen-select" name="categories[]" multiple data-placeholder="{{ trans('lang.select_service_cats') }}">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @if (in_array($category->id, $service->categories)) selected @endif>{{ $category->name }}</option>
                                                @endforeach
                                            </select>

                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="wt-languages-holder wt-tabsinfo">
                                <div class="wt-tabscontenttitle">
                                    <h2>{{ trans('lang.service_response_time') }}</h2>
                                </div>
                                <div class="wt-divtheme wt-userform wt-userformvtwo">
                                    <div class="form-group">
                                        <span class="wt-select">
                                            
                                            <select name="response_time" class="" placeholder="{{ trans('lang.select_response_time') }}">
                                                @foreach ($response_time as $time)
                                                    <option value="{{ $time->id }}" @if ($time->id == $service->response_time_id) selected @endif>{{ $time->name }}</option>
                                                @endforeach
                                            </select>

                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-half wt-formwithlabel">
                                <div class="wt-tabscontenttitle">
                                    <h2>{{ trans('lang.langs') }}</h2>
                                </div>
                                <div class="wt-divtheme wt-userform wt-userformvtwo">
                                    <div class="form-group">
                                        <span class="wt-select">
                                            
                                            <select class="chosen-select" name="languages[]" multiple data-placeholder="{{ trans('lang.select_lang') }}">
                                                @foreach ($languages as $language)
                                                    <option value="{{ $language->id }}" @if (in_array($language->id, $service->languages)) selected @endif>{{ $language->name }}</option>
                                                @endforeach
                                            </select>

                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-half wt-formwithlabel">
                                <div class="wt-tabscontenttitle">
                                    <h2>{{ trans('lang.english_level') }}</h2>
                                </div>
                                <div class="wt-divtheme wt-userform wt-userformvtwo">
                                    <div class="form-group">
                                        <span class="wt-select">
                                            
                                            <select name="english_level" class="" placeholder="{{ trans('lang.select_english_level') }}">
                                                @foreach ($english_levels as $level)
                                                    <option value="{{ $level->id }}" @if ($level->id == $service->english_level) selected @endif>{{ $level->name }}</option>
                                                @endforeach
                                            </select>

                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="wt-jobdetails wt-tabsinfo">
                                <div class="wt-tabscontenttitle">
                                    <h2>{{ trans('lang.service_desc') }}</h2>
                                </div>
                                <div class="wt-formtheme wt-userform wt-userformvtwo">
                                    
                                    <textarea id="wt-tinymceeditor" name="description" class="wt-tinymceeditor" placeholder="{{ trans('lang.service_desc_note'])') }}">{{ $service->description }}</textarea>
                                </div>
                            </div>
                            <!--<div class="wt-joblocation wt-tabsinfo">
                                <div class="wt-tabscontenttitle">
                                    <h2>{{ trans('lang.your_loc') }}</h2>
                                </div>
                                <div class="wt-formtheme wt-userform">
                                    <fieldset>
                                        <div class="form-group form-group-half">
                                            <span class="wt-select">
                                                
                                            </span>
                                        </div>
                                        <div class="form-group form-group-half">
                                            
                                        </div>
                                        <div class="form-group wt-formmap">
                                            @include('includes.map')
                                        </div>
                                        <div class="form-group form-group-half">
                                            
                                        </div>
                                        <div class="form-group form-group-half">
                                            
                                        </div>
                                    </fieldset>
                                </div>
                            </div>-->
                            <div class="wt-featuredholder wt-tabsinfo">
                                <div class="wt-tabscontenttitle">
                                    <h2>{{ trans('lang.is_featured') }}</h2>
                                    <div class="wt-rightarea">
                                        <div class="wt-on-off float-right">
                                            <switch_button v-model="is_featured">{{{ trans('lang.is_featured') }}}</switch_button>
                                            <input type="hidden" :value="is_featured" name="is_featured">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (!empty($provider))
                                <div class="wt-attachmentsholder">
                                    <div class="lara-attachment-files">
                                        <div class="wt-tabscontenttitle">
                                            <h2>{{ trans('lang.attachments') }}</h2>
                                            <div class="wt-rightarea">
                                                <div class="wt-on-off float-right">
                                                    <switch_button v-model="show_attachments">{{{ trans('lang.attachments_note') }}}</switch_button>
                                                    <input type="hidden" :value="show_attachments" name="show_attachments">
                                                </div>
                                            </div>
                                        </div>
                                        <image-attachments :temp_url="'{{url('service/upload-temp-image')}}'" :type="'image'"></image-attachments>
                                        <div class="form-group input-preview">
                                            <ul class="wt-attachfile dropzone-previews">
                                                @if (!empty($attachments))
                                                    @php $count = 0; @endphp
                                                    @foreach ($attachments as $key => $attachment)
                                                    <li id="attachment-item-{{$key}}">
                                                        <span>{{{Helper::formateFileName($attachment)}}}</span>
                                                        <em>
                                                            @if (Storage::disk('local')->exists('uploads/services/'.$provider->user_id.'/'.$attachment))
                                                                {{ trans('lang.file_size') }} {{{Helper::bytesToHuman(Storage::size('uploads/services/'.$provider->user_id.'/'.$attachment))}}}
                                                            @endif
                                                            <a href="{{{route('getfile', ['type'=>'services','attachment'=>$attachment,'id'=>$provider->user_id])}}}"><i class="lnr lnr-download"></i></a>
                                                            <a href="#" v-on:click.prevent="deleteAttachment('attachment-item-{{$key}}')"><i class="lnr lnr-cross"></i></a>
                                                        </em>
                                                        <input type="hidden" value="{{{$attachment}}}" class="" name="attachments[{{$key}}]">
                                                    </li>
                                                    @php $count++; @endphp
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="wt-updatall">
                        <i class="ti-announcement"></i>
                        <span>{{{ trans('lang.save_changes_note') }}}</span>
                        
                        <input type="submit" value="{{ trans('lang.post_service') }}" class="wt-btn" id="submit-service">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
