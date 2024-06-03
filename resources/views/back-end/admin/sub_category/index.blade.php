@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="skills-listing" id="skill-list">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
        <section class="wt-haslayout wt-dbsectionspace la-admin-skills">
        <div class="row"  style="margin-left: 10px;padding-bottom: 15px;">
                            <ol class="wt-breadcrumb">
                                <li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                                <li class="active">{{ trans('lang.sub_cat')}}</li>
                            </ol>
                        </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 float-left">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle">
                            <h2>{{{ trans('lang.add_cat') }}}</h2>
                        </div>
                        <div class="wt-dashboardboxcontent">
                            
                            <form action="{{ url('admin/sub-category') }}" class="wt-formtheme wt-formprojectinfo wt-formcategory" method="post" id="skills">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <fieldset>
                                <div class="form-group">
                                    
                                    <input type="text" name="cat_title" value="" class="form-control {{( $errors->has('cat_title') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.ph_cat_title')}}">
                                    <span class="form-group-description">{{{ trans('lang.desc') }}}</span>
                                    @if ($errors->has('cat_title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('cat_title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <input type="hidden" name="category_id" value="{{ $id }}">
                                
                                <div class="form-group wt-btnarea">
                                    
                                    <input type="submit" value="{{ trans('lang.add_cat') }}" class="wt-btn">
                                </div>
                            </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 float-right">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle wt-titlewithsearch">
                            <h2>{{ trans('lang.sub_cat')}}</h2>
                            
                        </div>
                        @if ($cats->count() > 0)
                            <div class="wt-dashboardboxcontent wt-categoriescontentholder">
                                <table class="wt-tablecategories" id="checked-val">
                                    <thead>
                                        <tr>
                                            
                                            <th>{{{ trans('lang.name') }}}</th>
                                            
                                            <th>{{{ trans('lang.action') }}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php 
                                            $counter = 0; 
                                            $user = !empty(Auth::user()) ? Auth::user() : '';
                                            $role = !empty($user) ? $user->role : array();
                                        @endphp
                                        @foreach ($cats as $cat)
                                            <tr>
                                                
                                                <td>{{{ $cat->sub_category }}}</td>
                                                <td>
                                                    <div class="wt-actionbtn">
                                                        @if ($role === 'admin')
                                                        <a href="{{{ url('admin/sub-category/') }}}/{{{ $cat->id }}}/edit" class="wt-addinfo wt-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                        <form action="{{ route('sub-category.destroy', $cat->id) }}" method="POST">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button type="submit" style="margin-left: 5px;"><a href="javascript:void(0);" class="wt-addinfo wt-skillsaddinfo" style="background: #005178!important;">
                                                            <i class="lnr lnr-trash"></i>
                                                        </a></button>
                                                        </form>
                                                        @else
                                                        <a href="{{{ url('employer/sub-category/') }}}/{{{ $cat->id }}}/edit" class="wt-addinfo wt-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
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
