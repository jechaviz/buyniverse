@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="cats-listing" id="cat-list">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
        <section class="wt-haslayout wt-dbsectionspace la-addnewcats">
        <div class="row"  style="margin-left: 10px;padding-bottom: 15px;">
                            <ol class="wt-breadcrumb">
                                <li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                                <li class="active">{{ trans('lang.cats')}}</li>
                            </ol>
                        </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-4 float-left">
                    <div class="wt-dashboardbox la-category-box">
                        <div class="wt-dashboardboxtitle">
                            <h2>{{{ trans('lang.add_cat') }}}</h2>
                        </div>
                        <div class="wt-dashboardboxcontent">
                            <form action="{{ url('admin/store-category') }}" class="wt-formtheme wt-formprojectinfo wt-formcategory" method="post" id="categories">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <fieldset>
                                    <div class="form-group">
                                        <input type="text" name="category_title" value="" class="form-control {{( $errors->has('category_title') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.ph_cat_title')}}">
                                        <span class="form-group-description">{{{ trans('lang.desc') }}}</span>
                                        @if ($errors->has('category_title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('category_title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <textarea name="category_abstract" class="form-control" placeholder="{{ trans('lang.ph_desc') }}"></textarea>
                                        <span class="form-group-description">{{{ trans('lang.cat_desc') }}}</span>
                                    </div>
                                    <div class="form-group">
                                        <span class="wt-select">
                                            <select class="form-control" name="parent_id">
                                                <option value="0">{{ trans('lang.choose_parent_cat') }}</option>
                                                @if ($cats->count() > 0)
                                                @foreach ($cats as $cat)
                                                <option value="{{$cat->id}}">{{ $cat->title }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </span> 
                                        <span class="form-group-description">{{{ trans('lang.parent_desc') }}}</span>
                                    </div>
                                    <div class="wt-settingscontent">
                                        <div class = "wt-formtheme wt-userform">
                                            <upload-image
                                                :id="'cat_image'"
                                                :img_ref="'cat_ref'"
                                                :url="'{{url('admin/categories/upload-temp-image')}}'"
                                                :name="'uploaded_image'"
                                                >
                                            </upload-image>
                                            <input type="hidden" name="uploaded_image" id="hidden_img" value="">
                                        </div>
                                        <span class="form-group-description">{{{ trans('lang.cat_icon_desc') }}}</span>
                                    </div>
                                    <div class="form-group wt-btnarea">
                                        <input type="submit" value="{{ trans('lang.add_cat') }}" class="wt-btn">
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-8 float-right">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle wt-titlewithsearch">
                        @php
                            $user = !empty(Auth::user()) ? Auth::user() : '';
                            $role = !empty($user) ? $user->role : array();
                        @endphp
                            <h2>{{{ trans('lang.cats') }}}</h2>
                            @if ($role === 'admin')
                            <form action="{{ url('admin/categories/search') }}" class="wt-formtheme wt-formsearch" >
                            @else
                            <form action="{{ url('employer/categories/search') }}" class="wt-formtheme wt-formsearch" >                            
                            @endif
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <fieldset>
                                <div class="form-group">
                                    <input type="text" name="keyword" value="{{{ request()->query('keyword', '') }}}"
                                        class="form-control" placeholder="{{{ trans('lang.ph_search_cats') }}}">
                                    <button type="submit" class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></button>
                                </div>
                            </fieldset>
                            </form>
                            @if ($role === 'admin')
                            <a href="javascript:void(0);" v-if="this.is_show" @click="deleteChecked('{{ trans('lang.ph_delete_confirm_title') }}', '{{ trans('lang.ph_cat_delete_message') }}')" class="wt-skilldel">
                                <i class="lnr lnr-trash"></i>
                                <span>{{ trans('lang.del_select_rec') }}</span>
                            </a>
                            @endif
                        </div>
                        @if ($cats->count() > 0)
                            <div class="wt-dashboardboxcontent wt-categoriescontentholder">
                                <table class="wt-tablecategories" id="checked-val">
                                    <thead>
                                        <tr>
                                            @if ($role === 'admin')
                                            <th>
                                                <span class="wt-checkbox">
                                                    <input name="cats[]" id="wt-cats" @click="selectAll" type="checkbox" name="head">
                                                    <label for="wt-cats"></label>
                                                </span>
                                            </th>
                                            @endif
                                            <th>{{{ trans('lang.cat_icon') }}}</th>
                                            <th>{{{ trans('lang.name') }}}</th>
                                            <th>{{{ trans('lang.slug') }}}</th>
                                            <th>{{{ trans('lang.scope') }}}</th>
                                            <th>{{{ trans('lang.action') }}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($cats as $cat)
                                            <tr class="del-{{{ $cat->id }}}">
                                                @if ($role === 'admin')
                                                <td>
                                                    <span class="wt-checkbox">
                                                        <input name="cats[]" @click="selectRecord" value="{{{ $cat->id }}}" id="wt-check-{{{ $counter }}}" type="checkbox" name="head">
                                                        <label for="wt-check-{{{ $counter }}}"></label>
                                                    </span>
                                                </td>
                                                @endif
                                                <td data-th="Icon"><span class="bt-content"><figure><img src="{{{ asset(\App\Helper::getCategoryImage($cat->image)) }}}" alt="{{{ $cat->title }}}"></figure></span></td>
                                                <td>{{{ $cat->title }}}</td>
                                                <td>{{{ $cat->slug }}}</td>
                                                <td>
                                                    @if($cat->status == 'appear_globally')
                                                    Globally
                                                    @elseif($cat->status == 'appear_user')
                                                    Locally
                                                    @elseif($cat->status == 'rejected')
                                                    Rejected
                                                    @else
                                                    Waiting
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="wt-actionbtn">
                                                        @if ($role === 'admin')
                                                        @if($cat->admin == 0)
                                                        <a href="{{{ url('admin/approve-category') }}}/{{{ $cat->id }}}" class="wt-addinfo wt-skillsaddinfo">
                                                            <i class="lnr lnr-thumbs-up"></i>
                                                        </a>
                                                        <a href="{{{ url('admin/reject-category') }}}/{{{ $cat->id }}}" class="wt-addinfo wt-skillsaddinfo">
                                                            <i class="lnr lnr-thumbs-down"></i>
                                                        </a>
                                                        @endif
                                                        <a href="{{{ url('admin/categories/edit-cats') }}}/{{{ $cat->id }}}" class="wt-addinfo wt-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                        <!--<a href="{{{ url('admin/sub-category') }}}/{{{ $cat->id }}}" class="wt-addinfo wt-skillsaddinfo">
                                                            <i class="lnr lnr-eye"></i>
                                                        </a>-->
                                                        
                                                        @else
                                                            @if($cat->user_id == Auth::user()->id)
                                                            <a href="{{{ url('employer/categories/edit-cats') }}}/{{{ $cat->id }}}" class="wt-addinfo wt-skillsaddinfo">
                                                                <i class="lnr lnr-pencil"></i>
                                                            </a>
                                                            <!--<a href="{{{ url('employer/sub-category') }}}/{{{ $cat->id }}}" class="wt-addinfo wt-skillsaddinfo">
                                                                <i class="lnr lnr-eye"></i>
                                                            </a>-->
                                                            @endif
                                                        @endif
                                                        @if ($role === 'admin')
                                                        <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{$cat->id}}'" :message="'{{trans("lang.ph_cat_delete_message")}}'" :url="'{{url('admin/categories/delete-cats')}}'"></delete>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($cats,'links') )
                                    {{ $cats->links('pagination.custom') }}
                                @endif
                            </div>
                        @else
                            @if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
                                @include('extend.errors.no-record')
                            @else 
                                @include('errors.no-record')
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
