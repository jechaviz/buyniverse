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
                                <li class="active">{{ trans('lang.team')}}</li>
                            </ol>
                        </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 float-left">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle">
                            <h2>{{{ trans('lang.add_team') }}}</h2>
                        </div>
                        <div class="wt-dashboardboxcontent">
                            {!! Form::open([
                                'url' => url('freelancer/teams'), 'class' =>'wt-formtheme wt-formprojectinfo wt-formcategory',
                                'id' => 'teams'
                                ])
                            !!}
                            <fieldset>
                                <div class="form-group">
                                    {!! Form::text( 'name', null, ['class' =>'form-control'.($errors->has('name') ? ' is-invalid' : ''),
                                    'placeholder' => trans('lang.name')] ) !!}
                                    
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'email', null, ['class' =>'form-control'.($errors->has('email') ? ' is-invalid' : ''),
                                    'placeholder' => trans('lang.email')] ) !!}
                                    
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'role', null, ['class' =>'form-control'.($errors->has('role') ? ' is-invalid' : ''),
                                    'placeholder' => trans('lang.role')] ) !!}
                                    
                                    @if ($errors->has('role'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                
                                <div class="form-group wt-btnarea">
                                    {!! Form::submit(trans('lang.add_team'), ['class' => 'wt-btn']) !!}
                                </div>
                            </fieldset>
                            {!! Form::close(); !!}
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 float-right">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle wt-titlewithsearch">
                            <h2>{{ trans('lang.team')}}</h2>
                            
                        </div>
                        @if ($teams->count() > 0)
                            <div class="wt-dashboardboxcontent wt-categoriescontentholder">
                                <table class="wt-tablecategories" id="checked-val">
                                    <thead>
                                        <tr>
                                            <!--<th>
                                                <span class="wt-checkbox">
                                                    <input name="skills[]" id="wt-skills" @click="selectAll" type="checkbox" name="head">
                                                    <label for="wt-skills"></label>
                                                </span>
                                            </th>-->
                                            <th>{{{ trans('lang.name') }}}</th>
                                            <th>{{{ trans('lang.email') }}}</th>
                                            <th>{{{ trans('lang.role') }}}</th>
                                            
                                            <th>{{{ trans('lang.action') }}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($teams as $team)
                                            <tr class="del-{{{ $team->id }}}">
                                                
                                                <td>{{{ $team->name }}}</td>
                                                <td>{{{ $team->email }}}</td>
                                                <td>{{{ $team->role }}}</td>
                                                <td>
                                                    <div class="wt-actionbtn">
                                                        <a href="{{{ url('freelancer/teams/') }}}/{{{ $team->id }}}/edit" class="wt-addinfo wt-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                        
                                                        
                                                        <button type="submit" style="margin-left: 5px;"><a href="{{ route('fteam.destroy', $team->id) }}" class="wt-addinfo wt-skillsaddinfo" style="background: #005178!important;">
                                                            <i class="lnr lnr-trash"></i>
                                                        </a></button>
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($team,'links') )
                                    {{ $team->links('pagination.custom') }}
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
