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
                                <li class="active">{{ trans('lang.skills')}}</li>
                            </ol>
                        </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 float-left">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle">
                            <h2>{{{ trans('lang.add_skill') }}}</h2>
                        </div>
                        
                        <div class="wt-dashboardboxcontent">
                            
                            <form action="{{ url('admin/store-skill') }}" class="wt-formtheme wt-formprojectinfo wt-formcategory" method="post" id="skills">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <fieldset>
                                <div class="form-group">
                                    
                                    <input type="text" name="skill_title" value="" class="form-control {{( $errors->has('skill_title') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.ph_skill_title')}}">
                                    <span class="form-group-description">{{{ trans('lang.desc') }}}</span>
                                    @if ($errors->has('skill_title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('skill_title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <textarea name="skill_desc" class="form-control" placeholder="{{ trans('lang.ph_desc') }}"></textarea>
                                    <span class="form-group-description">{{ trans('lang.cat_desc') }}</span>
                                </div>
                                <div class="form-group">
                                    <span class="wt-select">
                                        <select class="form-control" name="cat_id">
                                            <option value="0">{{ trans('lang.choose_cat') }}</option>
                                            @if ($cats->count() > 0)
                                            @foreach ($cats as $cat)
                                            <option value="{{$cat->id}}">{{ $cat->title }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </span>
                                    <!--<span class="form-group-description">{{{ trans('lang.parent_desc') }}}</span>-->
                                </div>
                                <div class="form-group wt-btnarea">
                                    
                                    <input type="submit" value="{{ trans('lang.add_skill') }}" class="wt-btn">
                                </div>
                            </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 float-right">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle wt-titlewithsearch">
                            @php
                                $user = !empty(Auth::user()) ? Auth::user() : '';
                                $role = !empty($user) ? $user->role : array();
                            @endphp
                            <h2>{{{ trans('lang.skills') }}}</h2>
                            @if ($role === 'admin')
                            
                            <form action="{{ url('admin/skills/search') }}" class="wt-formtheme wt-formsearch" >
                            @else
                            
                            <form action="{{ url('employer/skills/search') }}" class="wt-formtheme wt-formsearch" >
                            @endif
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <fieldset>
                                <div class="form-group">
                                    <input type="text" name="keyword" value="{{{ !empty($_GET['keyword']) ? $_GET['keyword'] : '' }}}"
                                        class="form-control" placeholder="{{{ trans('lang.ph_search_skills') }}}">
                                    <button type="submit" class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></button>
                                </div>
                            </fieldset>
                            </form>
                            @if ($role === 'admin')
                            <a href="javascript:void(0);" v-if="this.is_show" @click="deleteChecked('{{ trans('lang.ph_delete_confirm_title') }}', '{{ trans('lang.ph_skill_delete_message') }}')" class="wt-skilldel">
                                <i class="lnr lnr-trash"></i>
                                <span>{{ trans('lang.del_select_rec') }}</span>
                            </a>
                            @endif
                        </div>
                        @if ($skills->count() > 0)
                            <div class="wt-dashboardboxcontent wt-categoriescontentholder">
                                <table class="wt-tablecategories" id="checked-val">
                                    <thead>
                                        <tr>
                                            @if ($role === 'admin')
                                            <th>
                                                <span class="wt-checkbox">
                                                    <input name="skills[]" id="wt-skills" @click="selectAll" type="checkbox" name="head">
                                                    <label for="wt-skills"></label>
                                                </span>
                                            </th>
                                            @endif
                                            <th>{{{ trans('lang.name') }}}</th>
                                            <th>{{{ trans('lang.slug') }}}</th>
                                            <th>{{{ trans('lang.cats') }}}</th>
                                            <th>{{{ trans('lang.scope') }}}</th>
                                            <th>{{{ trans('lang.action') }}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($skills as $skill)
                                            <tr class="del-{{{ $skill->id }}}" v-bind:id="skillID">
                                                @if ($role === 'admin')
                                                <td>
                                                    <span class="wt-checkbox">
                                                        <input name="skills[]" @click="selectRecord" value="{{{ $skill->id }}}" id="wt-check-{{{ $counter }}}" type="checkbox" name="head">
                                                        <label for="wt-check-{{{ $counter }}}"></label>
                                                    </span>
                                                </td>
                                                @endif
                                                <td>{{{ $skill->title }}}</td>
                                                <td>{{{ $skill->slug }}}</td>
                                                <td>
                                                    @foreach ($skill->category as $cat)
                                                    {{ $cat->title}}
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @if($skill->status == 'appear_globally')
                                                    Globally
                                                    @elseif($skill->status == 'appear_user')
                                                    Locally
                                                    @elseif($skill->status == 'rejected')
                                                    Rejected
                                                    @else
                                                    Waiting
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="wt-actionbtn">
                                                        @if ($role === 'admin')
                                                        @if($skill->admin == 0)
                                                        <a href="{{{ url('admin/approve-skill') }}}/{{{ $skill->id }}}" class="wt-addinfo wt-skillsaddinfo">
                                                            <i class="lnr lnr-thumbs-up"></i>
                                                        </a>
                                                        <a href="{{{ url('admin/reject-skill') }}}/{{{ $skill->id }}}" class="wt-addinfo wt-skillsaddinfo">
                                                            <i class="lnr lnr-thumbs-down"></i>
                                                        </a>
                                                        @endif
                                                        <a href="{{{ url('admin/skills/edit-skills') }}}/{{{ $skill->id }}}" class="wt-addinfo wt-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                        <!--<a href="{{{ url('admin/sub-skills') }}}/{{{ $skill->id }}}" class="wt-addinfo wt-skillsaddinfo">
                                                            <i class="lnr lnr-eye"></i>
                                                        </a>-->
                                                        @else
                                                            @if($skill->user_id == Auth::user()->id)
                                                            <a href="{{{ url('employer/skills/edit-skills') }}}/{{{ $skill->id }}}" class="wt-addinfo wt-skillsaddinfo">
                                                                <i class="lnr lnr-pencil"></i>
                                                            </a>
                                                            <!--<a href="{{{ url('employer/sub-skills') }}}/{{{ $skill->id }}}" class="wt-addinfo wt-skillsaddinfo">
                                                                <i class="lnr lnr-eye"></i>
                                                            </a>-->
                                                            @endif
                                                        @endif
                                                        @if ($role === 'admin')
                                                        <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{$skill->id}}'" :message="'{{trans("lang.ph_skill_delete_message")}}'" :url="'{{url('admin/skills/delete-skills')}}'"></delete>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($skills,'links') )
                                    {{ $skills->links('pagination.custom') }}
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
