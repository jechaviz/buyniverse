@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="cats-listing" id="article-cat">
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
                            
                            <form action="{{ url('admin/article/store-category') }}" class="wt-formtheme wt-formprojectinfo wt-formcategory" method="post" id="categories">
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
                                        
                                        <textarea name="category_abstract" class="form-control" placeholder="{{ trans('lang.ph_desc'])') }}"></textarea>
                                        <span class="form-group-description">{{{ trans('lang.cat_desc') }}}</span>
                                    </div>
                                    <div class="wt-settingscontent">
                                        <div class = "wt-formtheme wt-userform">
                                            <upload-image
                                                :id="'cat_image'"
                                                :img_ref="'cat_ref'"
                                                :url="'{{url('admin/articles/categories/upload-temp-image')}}'"
                                                :name="'uploaded_image'"
                                                >
                                            </upload-image>
                                            <input type="hidden" name="uploaded_image" id="hidden_img" value="">
                                        </div>
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
                            <h2>{{{ trans('lang.cats') }}}</h2>
                            
                            <form action="{{ url('admin/article/categories/search') }}" class="wt-formtheme wt-formsearch" >
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <fieldset>
                                <div class="form-group">
                                    <input type="text" name="keyword" value="{{{ !empty($_GET['keyword']) ? $_GET['keyword'] : '' }}}"
                                        class="form-control" placeholder="{{{ trans('lang.ph_search_cats') }}}">
                                    <button type="submit" class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></button>
                                </div>
                            </fieldset>
                            </form>
                            <a href="javascript:void(0);" v-if="this.is_show" @click="deleteChecked('{{ trans('lang.ph_delete_confirm_title') }}', '{{ trans('lang.ph_cat_delete_message') }}')" class="wt-skilldel">
                                <i class="lnr lnr-trash"></i>
                                <span>{{ trans('lang.del_select_rec') }}</span>
                            </a>
                        </div>
                        @if ($cats->count() > 0)
                            <div class="wt-dashboardboxcontent wt-categoriescontentholder">
                                <table class="wt-tablecategories" id="checked-val">
                                    <thead>
                                        <tr>
                                            <th>
                                                <span class="wt-checkbox">
                                                    <input name="cats[]" id="wt-cats" @click="selectAll" type="checkbox" name="head">
                                                    <label for="wt-cats"></label>
                                                </span>
                                            </th>
                                            <th>{{{ trans('lang.cat_icon') }}}</th>
                                            <th>{{{ trans('lang.name') }}}</th>
                                            <th>{{{ trans('lang.slug') }}}</th>
                                            <th>{{{ trans('lang.action') }}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($cats as $cat)
                                            <tr class="del-{{{ $cat->id }}}">
                                                <td>
                                                    <span class="wt-checkbox">
                                                        <input name="cats[]" @click="selectRecord" value="{{{ $cat->id }}}" id="wt-check-{{{ $counter }}}" type="checkbox" name="head">
                                                        <label for="wt-check-{{{ $counter }}}"></label>
                                                    </span>
                                                </td>
                                                <td data-th="Icon"><span class="bt-content"><figure><img src="{{{asset(Helper::getImage('uploads/articles/categories', $cat->image, '', 'small-default-article.png')) }}}" alt="{{{ $cat->title }}}"></figure></span></td>
                                                <td>{{{ $cat->title }}}</td>
                                                <td>{{{ $cat->slug }}}</td>
                                                <td>
                                                    <div class="wt-actionbtn">
                                                        <a href="{{{ url('admin/article/categories/edit-cats') }}}/{{{ $cat->id }}}" class="wt-addinfo wt-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                        <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{$cat->id}}'" :message="'{{trans("lang.ph_cat_delete_message")}}'" :url="'{{url('admin/article/categories/delete-cats')}}'"></delete>
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
