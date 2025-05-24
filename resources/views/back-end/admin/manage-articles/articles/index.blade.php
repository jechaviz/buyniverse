@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="cats-listing wt-addarticles-wrap" id="articles">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
        <section class="wt-haslayout wt-dbsectionspace">
        <div class="row"  style="margin-left: 10px;padding-bottom: 15px;">
                            <ol class="wt-breadcrumb">
                                <li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                                <li class="active">{{ trans('lang.articles')}}</li>
                            </ol>
                        </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-4 float-left">
                    <div class="wt-dashboardbox la-article-box">
                        <div class="wt-dashboardboxtitle">
                            <h2>{{{ trans('lang.add_article') }}}</h2>
                        </div>
                        <div class="wt-dashboardboxcontent">
                            
                            <form action="{{ url('admin/articles/store-article') }}" class="wt-formtheme la-articlebox-form" method="post" id="categories">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <fieldset>
                                    <div class="form-group">
                                        
                                        <input type="text" name="title" value="" class="form-control {{( $errors->has('title') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.ph_title')}}">
                                        <span class="form-group-description">{{{ trans('lang.desc') }}}</span>
                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        
                                        <textarea id="wt-tinymceeditor" name="description" class="wt-tinymceeditor" placeholder="{{ trans('lang.ph_desc'])') }}"></textarea>
                                        
                                        <span class="form-group-description">{{{ trans('lang.article_desc') }}}</span>
                                    </div>
                                    <div class="form-group">
                                        <span class="wt-select">
                                            <select name="cats[]" class="chosen-select" multiple data-placeholder = "{{trans('lang.select_cats')}}">
                                                @foreach ($cats as $key => $cat)
                                                    {{-- @php $selected = in_array($payment_method['value'], $payment_gateway) ? 'selected': ''; @endphp --}}
                                                    <option value="{{$key}}">{{$cat}}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <upload-image
                                            :id="'article_image'"
                                            :img_ref="'article_ref'"
                                            :url="'{{url('admin/articles/upload-temp-image')}}'"
                                            :name="'uploaded_image'"
                                            >
                                        </upload-image>
                                        <input type="hidden" name="uploaded_image" id="hidden_img" value="">
                                    </div>
                                    <div class="form-group wt-btnarea">
                                        
                                        <input type="submit" value="{{ trans('lang.add_article') }}" class="wt-btn">
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-8 float-right">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle wt-titlewithsearch">
                            <h2>{{{ trans('lang.articles') }}}</h2>
                            
                            <form action="{{ url('admin/articles/search') }}" class="wt-formtheme wt-formsearch" >
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <fieldset>
                                <div class="form-group">
                                    <input type="text" name="keyword" value="{{{ request()->query('keyword', '') }}}"
                                        class="form-control" placeholder="{{{ trans('lang.ph_search_articles') }}}">
                                    <button type="submit" class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></button>
                                </div>
                            </fieldset>
                            </form>
                            <a href="javascript:void(0);" v-if="this.is_show" @click="deleteChecked('{{ trans('lang.ph_delete_confirm_title') }}', '{{ trans('lang.ph_article_delete_message') }}')" class="wt-skilldel">
                                <i class="lnr lnr-trash"></i>
                                <span>{{ trans('lang.del_select_rec') }}</span>
                            </a>
                        </div>
                        @if ($articles->count() > 0)
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
                                        @foreach ($articles as $article)
                                            <tr class="del-{{{ $article->id }}}">
                                                <td>
                                                    <span class="wt-checkbox">
                                                        <input name="cats[]" @click="selectRecord" value="{{{ $article->id }}}" id="wt-check-{{{ $counter }}}" type="checkbox" name="head">
                                                        <label for="wt-check-{{{ $counter }}}"></label>
                                                    </span>
                                                </td>
                                                <td data-th="Icon"><span class="bt-content"><figure><img src="{{{asset(Helper::getImage('uploads/articles', $article->banner, '', 'small-default-article.png')) }}}" alt="{{{ $article->title }}}"></figure></span></td>
                                                <td>{{{ $article->title }}}</td>
                                                <td>{{{ $article->slug }}}</td>
                                                <td>
                                                    <div class="wt-actionbtn">
                                                        <a href="{{{ url('admin/articles/edit-article') }}}/{{{ $article->id }}}" class="wt-addinfo wt-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                        <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{$article->id}}'" :message="'{{trans("lang.ph_article_delete_message")}}'" :url="'{{url('admin/articles/delete-article')}}'"></delete>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($articles,'links') )
                                    {{ $articles->links('pagination.custom') }}
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
