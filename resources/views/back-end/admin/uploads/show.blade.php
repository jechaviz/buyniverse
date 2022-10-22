@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
<style>
    .upload-btn-wrapper {
     position: relative;
    overflow: hidden;
    float: left;
    margin-right: -2px;
}

.upload-btn-wrapper .btn {
      border: 1px solid gray!important;
    color: gray;
    background-color: white;
    padding: 6px 20px;
    border-radius: 4px 0px 0px 4px!important;
    font-size: 14px;
    font-weight: 600!important;
}

.upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
}
.input-group .form-control {
   height: 34px;
}
.input-group-sm>.form-control, .input-group-sm>.input-group-addon, .input-group-sm>.input-group-btn>.btn {
    height: 34px;
   
}
</style>
    <section class="wt-haslayout wt-dbsectionspace" id="profile_settings">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 float-right">
                @if (Session::has('message'))
                    <div class="flash_msg">
                        <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
                    </div>
                @endif
                <div class="wt-dashboardbox">
                    
                    <div class="wt-dashboardboxcontent wt-categoriescontentholder">
                        <div class="row" style="margin: 20px;border: 1px solid #e5dddd;padding: 27px;">
                            <div class="col-md-6" style="text-align: center;border-right: 1px solid #e5dddd;">
                                <h3>Provider</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ route('provider_template') }}"><button class="btn btn-primary"><i class="fa fa-download"></i>&nbsp; Download Template</button></a>
                                    </div>
                                    <div class="col-md-6">
                                        <div style="display:flex;">
                                            <form action="{{ route('upload_provider') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                                                {{ csrf_field() }}
                                                {{ method_field('POST') }}
                                                <div class="upload-btn-wrapper">
                                            <button id="filename" class="btn">Choose file</button>
                                            <input type="file" id="file-input" name="excel_file" />
                                            </div>
                                                <input type="submit" class="btn btn-primary wt-btn" value="Upload" style="color: white;line-height: 37px;border-radius: 0px 4px 4px 0px!important;" />
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="text-align: center;">
                                <h3>Employer</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ route('employer_template') }}"><button class="btn btn-primary"><i class="fa fa-download"></i>&nbsp; Download Template</button></a>
                                    </div>
                                    <div class="col-md-6">
                                        <div style="display:flex;">
                                            <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                                                {{ csrf_field() }}
                                                {{ method_field('POST') }}
                                                <div class="upload-btn-wrapper">
                                            <button id="filename" class="btn">Choose file</button>
                                            <input type="file" id="file-input" name="excel_file" />
                                            </div>
                                                <input type="submit" class="btn btn-primary wt-btn" value="Upload" style="color: white;line-height: 37px;border-radius: 0px 4px 4px 0px!important;" />
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 20px;border: 1px solid #e5dddd;padding: 27px;">
                            <div class="col-md-6" style="text-align: center;border-right: 1px solid #e5dddd;">
                                <h3>Address</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ route('address_template') }}"><button class="btn btn-primary"><i class="fa fa-download"></i>&nbsp; Download Template</button></a>
                                    </div>
                                    <div class="col-md-6">
                                        <div style="display:flex;">
                                            <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                                                {{ csrf_field() }}
                                                {{ method_field('POST') }}
                                                <div class="upload-btn-wrapper">
                                            <button id="filename" class="btn">Choose file</button>
                                            <input type="file" id="file-input" name="excel_file" />
                                            </div>
                                                <input type="submit" class="btn btn-primary wt-btn" value="Upload" style="color: white;line-height: 37px;border-radius: 0px 4px 4px 0px!important;" />
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="text-align: center;">
                                <h3>Contacts</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ route('contact_template') }}"><button class="btn btn-primary"><i class="fa fa-download"></i>&nbsp; Download Template</button></a>
                                    </div>
                                    <div class="col-md-6">
                                        <div style="display:flex;">
                                            <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                                                {{ csrf_field() }}
                                                {{ method_field('POST') }}
                                                <div class="upload-btn-wrapper">
                                            <button id="filename" class="btn">Choose file</button>
                                            <input type="file" id="file-input" name="excel_file" />
                                            </div>
                                                <input type="submit" class="btn btn-primary wt-btn" value="Upload" style="color: white;line-height: 37px;border-radius: 0px 4px 4px 0px!important;" />
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
