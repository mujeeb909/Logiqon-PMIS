@extends('layouts.admin')
@section('page-title')
    {{ __('Settings') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Settings')}}</li>
@endsection

@php
    $lang = \App\Models\Utility::getValByName('default_language');
   // $logo=asset(Storage::url('uploads/logo/'));
    $logo=\App\Models\Utility::get_file('uploads/logo');
    $logo_light = \App\Models\Utility::getValByName('logo_light');
    $logo_dark = \App\Models\Utility::getValByName('logo_dark');
    $company_favicon = \App\Models\Utility::getValByName('company_favicon');
    $setting = \App\Models\Utility::colorset();
    $mode_setting = \App\Models\Utility::mode_layout();
    $color = (!empty($setting['color'])) ? $setting['color'] : 'theme-3';
    $SITE_RTL= isset($setting['SITE_RTL'])?$setting['SITE_RTL']:'off';
    $meta_image = \App\Models\Utility::get_file('uploads/meta/');


@endphp

{{--Storage setting--}}
@php
    $file_type = config('files_types');
    $setting = App\Models\Utility::settings();

   $local_storage_validation    = $setting['local_storage_validation'];
   $local_storage_validations   = explode(',', $local_storage_validation);

   $s3_storage_validation    = $setting['s3_storage_validation'];
   $s3_storage_validations   = explode(',', $s3_storage_validation);

   $wasabi_storage_validation    = $setting['wasabi_storage_validation'];
   $wasabi_storage_validations   = explode(',', $wasabi_storage_validation);

@endphp
{{-- end Storage setting--}}
@push('css-page')
    @if($color == 'theme-3')
        <style>
            .btn-check:checked + .btn-outline-primary, .btn-check:active + .btn-outline-primary,
            .btn-outline-primary:active, .btn-outline-primary.active, .btn-outline-primary.dropdown-toggle.show {
                color: #ffffff;
                background-color: #6fd943 !important;
                border-color: #6fd943 !important;
            }


            .btn-outline-primary:hover
            {
                color: #ffffff;
                background-color: #6fd943 !important;
                border-color: #6fd943 !important;
            }


            .btn[class*="btn-outline-"]:hover {

                border-color: #6fd943 !important;
            }
        </style>
    @endif
    @if($color == 'theme-2')
        <style>
            .btn-check:checked + .btn-outline-primary, .btn-check:active + .btn-outline-primary, .btn-outline-primary:active, .btn-outline-primary.active, .btn-outline-primary.dropdown-toggle.show {
                color: #ffffff;
                background: linear-gradient(141.55deg, rgba(240, 244, 243, 0) 3.46%, #4ebbd3 99.86%)#1f3996 !important;
                border-color: #4ebbd3 !important;

            }

            .btn-outline-primary:hover
            {
                color: #ffffff;
                background: linear-gradient(141.55deg, rgba(240, 244, 243, 0) 3.46%, #4ebbd3 99.86%)#1f3996 !important;
                border-color: #4ebbd3 !important;
            }
            .btn.btn-outline-primary{
                color: #1F3996;
                border-color: #4ebbd3 !important;
            }
        </style>
    @endif
    @if($color == 'theme-4')
        <style>
            .btn-check:checked + .btn-outline-primary, .btn-check:active + .btn-outline-primary, .btn-outline-primary:active, .btn-outline-primary.active, .btn-outline-primary.dropdown-toggle.show {
                color: #ffffff;
                background-color: #584ed2 !important;
                border-color: #584ed2 !important;

            }

            .btn-outline-primary:hover
            {
                color: #ffffff;
                background-color: #584ed2 !important;
                border-color: #584ed2 !important;
            }
            .btn.btn-outline-primary{
                color: #584ed2;
                border-color: #584ed2 !important;
            }
        </style>
    @endif
    @if($color == 'theme-1')
        <style>
            .btn-check:checked + .btn-outline-primary, .btn-check:active + .btn-outline-primary,
            .btn-outline-primary:active, .btn-outline-primary.active, .btn-outline-primary.dropdown-toggle.show {
                color: #ffffff;
                background: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, rgba(255, 58, 110, 0.6) 99.86%), #51459d !important;
                border-color: #51459d !important;
            }


            body.theme-1 .btn-outline-primary:hover
            {
                color: #ffffff;
                background: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, rgba(255, 58, 110, 0.6) 99.86%), #51459d !important;
                border-color: #51459d !important;
            }
        </style>
    @endif
@endpush


@push('script-page')
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300,
        })
        // $(".list-group-item").click(function(){
        //     $('.list-group-item').filter(function(){
        //         return this.href == id;
        //     }).parent().removeClass('text-primary');
        // });

        function check_theme(color_val) {
            $('#theme_color').prop('checked', false);
            $('input[value="' + color_val + '"]').prop('checked', true);
        }
        //
        // $(document).ready(function() {
        //     if ($('.gdpr_fulltime').is(':checked')) {
        //         $('.fulltime').show();
        //     } else {
        //         $('.fulltime').hide();
        //     }
        //     $('#gdpr_cookie').on('change', function() {
        //         if ($('.gdpr_fulltime').is(':checked')) {
        //             $('.fulltime').show();
        //         } else {
        //             $('.fulltime').hide();
        //         }
        //     });
        // });

        // storage setting
        $(document).on('change','[name=storage_setting]',function(){
            if($(this).val() == 's3'){
                $('.s3-setting').removeClass('d-none');
                $('.wasabi-setting').addClass('d-none');
                $('.local-setting').addClass('d-none');
            }else if($(this).val() == 'wasabi'){
                $('.s3-setting').addClass('d-none');
                $('.wasabi-setting').removeClass('d-none');
                $('.local-setting').addClass('d-none');
            }else{
                $('.s3-setting').addClass('d-none');
                $('.wasabi-setting').addClass('d-none');
                $('.local-setting').removeClass('d-none');
            }
        });
    </script>

    <script>
        document.getElementById('logo_dark').onchange = function () {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image').src = src
        }
        document.getElementById('logo_light').onchange = function () {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image1').src = src
        }
        document.getElementById('favicon').onchange = function () {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image2').src = src
        }
    </script>

    <script type="text/javascript">

        $(document).on("click", '.send_email', function(e)
        {
            e.preventDefault();
            var title = $(this).attr('data-title');
            var size = 'md';
            var url = $(this).attr('data-url');

            if (typeof url != 'undefined') {
                $("#commonModal .modal-title").html(title);
                $("#commonModal .modal-dialog").addClass('modal-' + size);
                $("#commonModal").modal('show');


                $.post(url, {
                    _token:'{{csrf_token()}}',
                    mail_driver: $("#mail_driver").val(),
                    mail_host: $("#mail_host").val(),
                    mail_port: $("#mail_port").val(),
                    mail_username: $("#mail_username").val(),
                    mail_password: $("#mail_password").val(),
                    mail_encryption: $("#mail_encryption").val(),
                    mail_from_address: $("#mail_from_address").val(),
                    mail_from_name: $("#mail_from_name").val(),

                }, function(data) {
                    $('#commonModal .body').html(data);
                });
            }
        });
        $(document).on('submit', '#test_email', function(e) {
            e.preventDefault();
            // $("#email_sending").show();
            var post = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                type: "post",
                url: url,
                data: post,
                cache: false,
                beforeSend: function() {
                    $('#test_email .btn-create').attr('disabled', 'disabled');
                },
                success: function(data) {
                    // console.log(data)
                    if (data.success) {
                        show_toastr('success', data.message, 'success');
                    } else {
                        show_toastr('error', data.message, 'error');
                    }
                    // $("#email_sending").hide();
                    $('#commonModal').modal('hide');


                },
                complete: function() {
                    $('#test_email .btn-create').removeAttr('disabled');
                },
            });
        });
    </script>

    {{--    for cookie setting--}}
    <script type="text/javascript">
        function enablecookie() {
            const element = $('#enable_cookie').is(':checked');
            $('.cookieDiv').addClass('disabledCookie');
            if (element==true) {
                $('.cookieDiv').removeClass('disabledCookie');
                $("#cookie_logging").attr('checked', true);
            } else {
                $('.cookieDiv').addClass('disabledCookie');
                $("#cookie_logging").attr('checked', false);
            }
        }
    </script>

@endpush

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Settings')}}</li>
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#brand-settings" class="list-group-item list-group-item-action border-0">{{ __('Brand Settings') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#email-settings" class="list-group-item list-group-item-action border-0">{{ __('Email Settings') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#payment-settings" class="list-group-item list-group-item-action border-0">{{ __('Payment Settings') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#pusher-settings" class="list-group-item list-group-item-action border-0">{{ __('Pusher Settings') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#recaptcha_settings" class="list-group-item list-group-item-action border-0">{{ __('ReCaptcha Settings') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#storage-settings" class="list-group-item list-group-item-action border-0">{{ __('Storage Settings') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#seo-settings" class="list-group-item list-group-item-action border-0">{{ __('SEO Settings') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#cookie-settings" class="list-group-item list-group-item-action border-0">{{ __('Cookie Settings') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#cache-settings" class="list-group-item list-group-item-action border-0">{{ __('Cache Settings') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                        </div>
                    </div>
                </div>

                <div class="col-xl-9">
                    <!--Site Settings-->
                    <div id="brand-settings" class="card">
                        <div class="card-header">
                            <h5>{{ __('Brand Settings') }}</h5>
                        </div>
                        {{ Form::model($settings, ['url' => 'systems', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 col-sm-6 col-md-6">
                                    <div class="card logo_card">
                                        <div class="card-header">
                                            <h5>{{ __('Logo dark') }}</h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="setting-card">
                                                <div class="logo-content mt-4">
                                                    <img id="image" src="{{$logo.'/'.(isset($logo_dark) && !empty($logo_dark)?$logo_dark:'logo-dark.png')}}"
                                                         class="big-logo">
                                                </div>
                                                <div class="choose-files mt-5">
                                                    <label for="logo_dark">
                                                        <div class=" bg-primary company_logo_update"> <i
                                                                class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                        </div>
                                                        <input type="file" name="logo_dark" id="logo_dark" class="form-control file" data-filename="logo_dark">
                                                    </label>
                                                </div>
                                                @error('logo_dark')
                                                    <div class="row">
                                                    <span class="invalid-logo" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-md-6">
                                    <div class="card logo_card">
                                        <div class="card-header">
                                            <h5>{{ __('Logo Light') }}</h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class=" setting-card">
                                                <div class="logo-content mt-4">
                                                    <img id="image1" src="{{$logo.'/'.(isset($logo_light) && !empty($logo_light)?$logo_light:'logo-light.png')}}"
                                                         class="big-logo img_setting">
                                                </div>
                                                <div class="choose-files mt-5">
                                                    <label for="logo_light">
                                                        <div class=" bg-primary dark_logo_update"> <i class="ti ti-upload px-1">
                                                            </i>{{ __('Choose file here') }}
                                                        </div>
                                                        <input type="file" name="logo_light" id="logo_light" class="form-control file" data-filename="logo_light">
                                                    </label>
                                                </div>
                                                @error('logo_light')
                                                <div class="row">
                                                    <span class="invalid-logo" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-md-6">
                                    <div class="card logo_card">
                                        <div class="card-header">
                                            <h5>{{ __('Favicon') }}</h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class=" setting-card">
                                                <div class="logo-content mt-4">
                                                    <img id="image2" src="{{$logo.'/'.(isset($company_favicon) && !empty($company_favicon)?$company_favicon:'favicon.png')}}" width="50px"
                                                         class="img_setting">
                                                </div>
                                                <div class="choose-files mt-5">
                                                    <label for="favicon">
                                                        <div class="bg-primary company_favicon_update"> <i
                                                                class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                        </div>
                                                        <input type="file" class="form-control file"  id="favicon" name="favicon"
                                                               data-filename="favicon">
                                                    </label>
                                                </div>
                                                @error('favicon')
                                                <div class="row">
                                                    <span class="invalid-logo" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{Form::label('title_text',__('Title Text'),array('class'=>'form-label')) }}
                                            {{Form::text('title_text',null,array('class'=>'form-control','placeholder'=>__('Title Text')))}}
                                            @error('title_text')
                                            <span class="invalid-title_text" role="alert">
                                                     <strong class="text-danger">{{ $message }}</strong>
                                                 </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{Form::label('footer_text',__('Footer Text'),['class'=>'form-label']) }}
                                            {{Form::text('footer_text',Utility::getValByName('footer_text'),array('class'=>'form-control','placeholder'=>__('Enter Footer Text')))}}
                                            @error('footer_text')
                                            <span class="invalid-footer_text" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{Form::label('default_language',__('Default Language'),['class'=>'form-label text-dark']) }}
                                            <div class="changeLanguage">
                                                <select name="default_language" id="default_language" class="form-control select">
                                                    @foreach (\App\Models\Utility::languages() as $language)
                                                        <option @if ($lang == $language) selected @endif value="{{ $language }}">
                                                            {{ Str::upper($language) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('default_language')
                                            <span class="invalid-default_language" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-2">
                                        <div class="custom-control custom-switch">
                                            <label class="text-dark mb-1 mt-3" for="SITE_RTL">{{ __('Enable RTL') }}</label>
                                            <div class="">
                                                <input type="checkbox" name="SITE_RTL" id="SITE_RTL" data-toggle="switchbutton"  data-onstyle="primary"  {{ $settings['SITE_RTL'] == 'on' ? 'checked="checked"' : '' }}>
                                                <label class="custom-control-label" for="SITE_RTL"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="text-dark mb-1 mt-3" for="display_landing_page">{{ __('Enable Landing Page') }}</label>
                                            <div class="form-check form-switch d-inline-block">
                                                <input type="checkbox" name="display_landing_page" class="form-check-input" id="display_landing_page" data-toggle="switchbutton" {{ (Utility::getValByName('display_landing_page') == 'on') ? 'checked' : '' }} data-onstyle="primary">
                                                <label class="form-check-label" for="display_landing_page"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="text-dark mb-1 mt-3" for="signup_button">{{ __('Enable Sign-Up Page') }}</label>
                                            <div class="">
                                                <input type="checkbox" name="enable_signup" id="enable_signup" data-toggle="switchbutton"  {{ $settings['enable_signup'] == 'on' ? 'checked="checked"' : '' }} data-onstyle="primary">
                                                <label class="form-check-label" for="enable_signup"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto  ">
                                        <div class="form-group">
                                            <label class="text-dark mb-1 mt-3" for="email_verification">{{ __('Email Verification') }}</label>
                                            <div class="">
                                                <input type="checkbox" name="email_verification" id="email_verification" data-toggle="switchbutton"  {{ $settings['email_verification'] == 'on' ? 'checked="checked"' : '' }} data-onstyle="primary">
                                                <label class="form-check-label" for="email_verification"></label>
                                            </div>
                                        </div>
                                    </div>

{{--                                    <div class="col-auto  ">--}}
{{--                                        <div class="form-group">--}}
{{--                                            {{ Form::label('gdpr_cookie', 'GDPR Cookie', ['class' => 'form-label text-dark mb-1 mt-3']) }}--}}
{{--                                            <div class="custom-control custom-switch">--}}
{{--                                                <input type="checkbox" data-toggle="switchbutton" data-onstyle="primary" class="form-check-label gdpr_fulltime gdpr_type"--}}
{{--                                                       name="gdpr_cookie" id="gdpr_cookie"{{ isset($settings['gdpr_cookie']) && $settings['gdpr_cookie'] == 'on' ? 'checked="checked"' : '' }}>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>

{{--                                <div class="row">--}}
{{--                                    <div class="form-group col-12">--}}
{{--                                        {{Form::label('cookie_text',__('GDPR Cookie Text'),array('class'=>'fulltime col-form-label text-dark text-dark') )}}--}}
{{--                                        {!! Form::textarea('cookie_text',$settings['cookie_text'], ['class'=>'form-control fulltime','rows'=>'4']) !!}--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <h4 class="small-title">{{__('Theme Customizer')}}</h4>
                                <div class="setting-card setting-logo-box p-3">
                                    <div class="row">
                                        <div class="col-lg-4 col-xl-4 col-md-4">
                                            <h6 class="mt-2">
                                                <i data-feather="credit-card" class="me-2"></i>{{ __('Primary color settings') }}
                                            </h6>

                                            <hr class="my-2" />
                                            <div class="theme-color themes-color">
                                                <a href="#!" class="{{($settings['color'] == 'theme-1') ? 'active_color' : ''}}" data-value="theme-1" onclick="check_theme('theme-1')"></a>
                                                <input type="radio" class="theme_color" name="color" value="theme-1" style="display: none;">
                                                <a href="#!" class="{{($settings['color'] == 'theme-2') ? 'active_color' : ''}} " data-value="theme-2" onclick="check_theme('theme-2')"></a>
                                                <input type="radio" class="theme_color" name="color" value="theme-2" style="display: none;">
                                                <a href="#!" class="{{($settings['color'] == 'theme-3') ? 'active_color' : ''}}" data-value="theme-3" onclick="check_theme('theme-3')"></a>
                                                <input type="radio" class="theme_color" name="color" value="theme-3" style="display: none;">
                                                <a href="#!" class="{{($settings['color'] == 'theme-4') ? 'active_color' : ''}}" data-value="theme-4" onclick="check_theme('theme-4')"></a>
                                                <input type="radio" class="theme_color" name="color" value="theme-4" style="display: none;">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-xl-4 col-md-4">
                                            <h6 class="mt-2">
                                                <i data-feather="layout" class="me-2"></i>{{__('Sidebar settings')}}
                                            </h6>
                                            <hr class="my-2" />
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" id="cust-theme-bg" name="cust_theme_bg" {{ !empty($settings['cust_theme_bg']) && $settings['cust_theme_bg'] == 'on' ? 'checked' : '' }}/>
                                                <label class="form-check-label f-w-600 pl-1" for="cust-theme-bg"
                                                >{{__('Transparent layout')}}</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-xl-4 col-md-4">
                                            <h6 class="mt-2">
                                                <i data-feather="sun" class="me-2"></i>{{__('Layout settings')}}
                                            </h6>
                                            <hr class="my-2" />
                                            <div class="form-check form-switch mt-2">
                                                <input type="checkbox" class="form-check-input" id="cust-darklayout" name="cust_darklayout"{{ !empty($settings['cust_darklayout']) && $settings['cust_darklayout'] == 'on' ? 'checked' : '' }} />
                                                <label class="form-check-label f-w-600 pl-1" for="cust-darklayout">{{ __('Dark Layout') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <div class="form-group">
                                        <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="{{__('Save Changes')}}">
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>

                    <!--Email Settings-->
                    <div id="email-settings" class="card">
                        <div class="card-header">
                            <h5>{{ __('Email Settings') }}</h5>
                        </div>
                        <div class="card-body">
                            {{ Form::open(['route' => 'email.settings', 'method' => 'post']) }}
                            @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('mail_driver', __('Mail Driver'), ['class' => 'form-label']) }}
                                            {{ Form::text('mail_driver', env('MAIL_DRIVER'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Driver')]) }}
                                            @error('mail_driver')
                                            <span class="invalid-mail_driver" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('mail_host', __('Mail Host'), ['class' => 'form-label']) }}
                                            {{ Form::text('mail_host', env('MAIL_HOST'), ['class' => 'form-control ', 'placeholder' => __('Enter Mail Host')]) }}
                                            @error('mail_host')
                                            <span class="invalid-mail_driver" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('mail_port', __('Mail Port'), ['class' => 'form-label']) }}
                                            {{ Form::text('mail_port', env('MAIL_PORT'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Port')]) }}
                                            @error('mail_port')
                                            <span class="invalid-mail_port" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('mail_username', __('Mail Username'), ['class' => 'form-label']) }}
                                            {{ Form::text('mail_username', env('MAIL_USERNAME'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Username')]) }}
                                            @error('mail_username')
                                            <span class="invalid-mail_username" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('mail_password', __('Mail Password'), ['class' => 'form-label']) }}
                                            {{ Form::text('mail_password', env('MAIL_PASSWORD'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Password')]) }}
                                            @error('mail_password')
                                            <span class="invalid-mail_password" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('mail_encryption', __('Mail Encryption'), ['class' => 'form-label']) }}
                                            {{ Form::text('mail_encryption', env('MAIL_ENCRYPTION'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Encryption')]) }}
                                            @error('mail_encryption')
                                            <span class="invalid-mail_encryption" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('mail_from_address', __('Mail From Address'), ['class' => 'form-label']) }}
                                            {{ Form::text('mail_from_address', env('MAIL_FROM_ADDRESS'), ['class' => 'form-control', 'placeholder' => __('Enter Mail From Address')]) }}
                                            @error('mail_from_address')
                                            <span class="invalid-mail_from_address" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('mail_from_name', __('Mail From Name'), ['class' => 'form-label']) }}
                                            {{ Form::text('mail_from_name', env('MAIL_FROM_NAME'), ['class' => 'form-control', 'placeholder' => __('Enter Mail From Name')]) }}
                                            @error('mail_from_name')
                                            <span class="invalid-mail_from_name" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="card-footer d-flex justify-content-end">
                                        <div class="form-group me-2">
                                            <a href="#" data-url="{{ route('test.mail') }}"
                                               data-title="{{ __('Send Test Mail') }}" class="btn btn-primary send_email ">
                                                {{ __('Send Test Mail') }}
                                            </a>
                                        </div>


                                        <div class="form-group">
                                            <input class="btn btn-primary" type="submit" value="{{__('Save Changes')}}">
                                        </div>
                                    </div>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>

                    <!--Payment Settings-->
                    <div class="card" id="payment-settings">
                        <div class="card-header">
                            <h5>{{ 'Payment Settings' }}</h5>
                            <small class="text-secondary font-weight-bold">
                                {{ __('These details will be used to collect subscription plan payments.Each subscription plan will have a payment button based on the below configuration.') }}
                            </small>
                        </div>
                        {{ Form::open(['route' => 'payment.settings', 'method' => 'post']) }}
                        @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label class="col-form-label">{{ __('Currency') }} *</label>

                                                {{ Form::text('currency', env('CURRENCY'), ['class' => 'form-control font-style', 'required', 'placeholder' => __('Enter Currency')]) }}
                                                <small class="text-xs">
                                                    {{ __('Note: Add currency code as per three-letter ISO code') }}.
                                                    <a href="https://stripe.com/docs/currencies"
                                                       target="_blank">{{ __('You can find out how to do that here.') }}</a>
                                                </small>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="currency_symbol"
                                                       class="col-form-label">{{ __('Currency Symbol') }}</label>
                                                {{ Form::text('currency_symbol', env('CURRENCY_SYMBOL'), ['class' => 'form-control', 'required', 'placeholder' => __('Enter Currency Symbol')]) }}
                                            </div>
                                        </div>
                                        <div class="faq justify-content-center">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="accordion accordion-flush setting-accordion" id="accordionExample">

                                                        <!-- Stripe -->
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="headingOne">
                                                                <button class="accordion-button collapsed" type="button"
                                                                        data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                                        aria-expanded="false" aria-controls="collapseOne">
                                                                    <span class="d-flex align-items-center">
                                                                        {{ __('Stripe') }}
                                                                    </span>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="me-2">{{__('Enable')}}:</span>
                                                                        <div class="form-check form-switch custom-switch-v1">
                                                                            <input type="hidden" name="is_stripe_enabled"
                                                                                   value="off">
                                                                            <input type="checkbox"
                                                                                   class="form-check-input input-primary"
                                                                                   id="customswitchv1-1 is_stripe_enabled"
                                                                                   name="is_stripe_enabled"
                                                                                {{ isset($admin_payment_setting['is_stripe_enabled']) && $admin_payment_setting['is_stripe_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                        </div>
                                                                    </div>
                                                                </button>
                                                            </h2>
                                                            <div id="collapseOne" class="accordion-collapse collapse"
                                                                 aria-labelledby="headingOne"
                                                                 data-bs-parent="#accordionExample">
                                                                <div class="accordion-body">
                                                                    <div class="row gy-4">
                                                                        <div class="col-lg-6">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    {{ Form::label('stripe_key', __('Stripe Key'), ['class' => 'col-form-label']) }}
                                                                                    {{ Form::text('stripe_key', isset($admin_payment_setting['stripe_key']) ? $admin_payment_setting['stripe_key'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Stripe Key')]) }}
                                                                                    @if ($errors->has('stripe_key'))
                                                                                        <span class="invalid-feedback d-block">
                                                                                            {{ $errors->first('stripe_key') }}
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    {{ Form::label('stripe_secret', __('Stripe Secret'), ['class' => 'col-form-label']) }}
                                                                                    {{ Form::text('stripe_secret', isset($admin_payment_setting['stripe_secret']) ? $admin_payment_setting['stripe_secret'] : '', ['class' => 'form-control ', 'placeholder' => __('Enter Stripe Secret')]) }}
                                                                                    @if ($errors->has('stripe_secret'))
                                                                                        <span class="invalid-feedback d-block">
                                                                                            {{ $errors->first('stripe_secret') }}
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Paypal -->
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="headingTwo">
                                                                <button class="accordion-button collapsed" type="button"
                                                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                                        aria-expanded="false" aria-controls="collapseTwo">
                                                                    <span class="d-flex align-items-center">
                                                                        {{ __('Paypal') }}
                                                                    </span>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="me-2">{{__('Enable')}}:</span>
                                                                        <div class="form-check form-switch custom-switch-v1">
                                                                            <input type="hidden" name="is_paypal_enabled"
                                                                                   value="off">
                                                                            <input type="checkbox"
                                                                                   class="form-check-input input-primary"
                                                                                   id="customswitchv1-1 is_paypal_enabled"
                                                                                   name="is_paypal_enabled"
                                                                                {{ isset($admin_payment_setting['is_paypal_enabled']) && $admin_payment_setting['is_paypal_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                        </div>
                                                                    </div>
                                                                </button>
                                                            </h2>
                                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                                 aria-labelledby="headingTwo"
                                                                 data-bs-parent="#accordionExample">
                                                                <div class="accordion-body">
                                                                    <div class="d-flex">
                                                                        <div class="mr-2" style="margin-right: 15px;">
                                                                            <div class="border card p-1">
                                                                                <div class="form-check">
                                                                                    <label class="form-check-labe text-dark">
                                                                                        <input type="radio"
                                                                                               name="paypal_mode" value="sandbox"
                                                                                               class="form-check-input"
                                                                                            {{ (isset($admin_payment_setting['paypal_mode']) && $admin_payment_setting['paypal_mode'] == '') || (isset($admin_payment_setting['paypal_mode']) && $admin_payment_setting['paypal_mode'] == 'sandbox') ? 'checked="checked"' : '' }}>
                                                                                        {{ __('Sandbox') }}
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mr-2">
                                                                            <div class="border card p-1">
                                                                                <div class="form-check">
                                                                                    <label class="form-check-labe text-dark">
                                                                                        <input type="radio"
                                                                                               name="paypal_mode" value="live"
                                                                                               class="form-check-input"
                                                                                            {{ isset($admin_payment_setting['paypal_mode']) && $admin_payment_setting['paypal_mode'] == 'live' ? 'checked="checked"' : '' }}>
                                                                                        {{ __('Live') }}
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row gy-4">
                                                                        <div class="col-lg-6">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label class="col-form-label"
                                                                                           for="paypal_client_id">{{ __('Client ID') }}</label>
                                                                                    <input type="text"
                                                                                           name="paypal_client_id"
                                                                                           id="paypal_client_id"
                                                                                           class="form-control"
                                                                                           value="{{ !isset($admin_payment_setting['paypal_client_id']) || is_null($admin_payment_setting['paypal_client_id']) ? '' : $admin_payment_setting['paypal_client_id'] }}"
                                                                                           placeholder="{{ __('Client ID') }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label class="col-form-label"
                                                                                           for="paypal_secret_key">{{ __('Secret Key') }}</label>
                                                                                    <input type="text"
                                                                                           name="paypal_secret_key"
                                                                                           id="paypal_secret_key"
                                                                                           class="form-control"
                                                                                           value="{{ isset($admin_payment_setting['paypal_secret_key']) ? $admin_payment_setting['paypal_secret_key'] : '' }}"
                                                                                           placeholder="{{ __('Secret Key') }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Paystack -->
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="headingThree">
                                                                <button class="accordion-button collapsed" type="button"
                                                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                                        aria-expanded="false" aria-controls="collapseThree">
                                                                    <span class="d-flex align-items-center">
                                                                        {{ __('Paystack') }}
                                                                    </span>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="me-2">{{__('Enable')}}:</span>
                                                                        <div class="form-check form-switch custom-switch-v1">
                                                                            <input type="hidden" name="is_paystack_enabled"
                                                                                   value="off">
                                                                            <input type="checkbox"
                                                                                   class="form-check-input input-primary"
                                                                                   id="customswitchv1-1 is_paystack_enabled"
                                                                                   name="is_paystack_enabled"
                                                                                {{ isset($admin_payment_setting['is_paystack_enabled']) && $admin_payment_setting['is_paystack_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                        </div>
                                                                    </div>
                                                                </button>
                                                            </h2>
                                                            <div id="collapseThree" class="accordion-collapse collapse"
                                                                 aria-labelledby="headingThree"
                                                                 data-bs-parent="#accordionExample">
                                                                <div class="accordion-body">
                                                                    <div class="row gy-4">
                                                                        <div class="col-lg-6">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label for="paypal_client_id"
                                                                                           class="col-form-label">{{ __('Public Key') }}</label>
                                                                                    <input type="text"
                                                                                           name="paystack_public_key"
                                                                                           id="paystack_public_key"
                                                                                           class="form-control"
                                                                                           value="{{ isset($admin_payment_setting['paystack_public_key']) ? $admin_payment_setting['paystack_public_key'] : '' }}"
                                                                                           placeholder="{{ __('Public Key') }}" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label for="paystack_secret_key"
                                                                                           class="col-form-label">{{ __('Secret Key') }}</label>
                                                                                    <input type="text"
                                                                                           name="paystack_secret_key"
                                                                                           id="paystack_secret_key"
                                                                                           class="form-control"
                                                                                           value="{{ isset($admin_payment_setting['paystack_secret_key']) ? $admin_payment_setting['paystack_secret_key'] : '' }}"
                                                                                           placeholder="{{ __('Secret Key') }}" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Flutterwave -->
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="headingFour">
                                                                <button class="accordion-button collapsed" type="button"
                                                                        data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                                        aria-expanded="false" aria-controls="collapseFour">
                                                                    <span class="d-flex align-items-center">
                                                                        {{ __('Flutterwave') }}
                                                                    </span>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="me-2">{{__('Enable')}}:</span>
                                                                        <div class="form-check form-switch custom-switch-v1">
                                                                            <input type="hidden"
                                                                                   name="is_flutterwave_enabled" value="off">
                                                                            <input type="checkbox"
                                                                                   class="form-check-input input-primary"
                                                                                   id="customswitchv1-1 is_flutterwave_enabled"
                                                                                   name="is_flutterwave_enabled"
                                                                                {{ isset($admin_payment_setting['is_flutterwave_enabled']) && $admin_payment_setting['is_flutterwave_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                        </div>
                                                                    </div>
                                                                </button>
                                                            </h2>
                                                            <div id="collapseFour" class="accordion-collapse collapse"
                                                                 aria-labelledby="headingFour"
                                                                 data-bs-parent="#accordionExample">
                                                                <div class="accordion-body">
                                                                    <div class="row gy-4">
                                                                        <div class="col-lg-6">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label for="paypal_client_id"
                                                                                           class="col-form-label">{{ __('Public Key') }}</label>
                                                                                    <input type="text"
                                                                                           name="flutterwave_public_key"
                                                                                           id="flutterwave_public_key"
                                                                                           class="form-control"
                                                                                           value="{{ isset($admin_payment_setting['flutterwave_public_key']) ? $admin_payment_setting['flutterwave_public_key'] : '' }}"
                                                                                           placeholder="Public Key">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label for="paystack_secret_key"
                                                                                           class="col-form-label">{{ __('Secret Key') }}</label>
                                                                                    <input type="text"
                                                                                           name="flutterwave_secret_key"
                                                                                           id="flutterwave_secret_key"
                                                                                           class="form-control"
                                                                                           value="{{ isset($admin_payment_setting['flutterwave_secret_key']) ? $admin_payment_setting['flutterwave_secret_key'] : '' }}"
                                                                                           placeholder="Secret Key">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Razorpay -->
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="headingFive">
                                                                <button class="accordion-button collapsed" type="button"
                                                                        data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                                        aria-expanded="false" aria-controls="collapseFive">
                                                                    <span class="d-flex align-items-center">
                                                                        {{ __('Razorpay') }}
                                                                    </span>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="me-2">{{__('Enable')}}:</span>
                                                                        <div class="form-check form-switch custom-switch-v1">
                                                                            <input type="hidden" name="is_razorpay_enabled"
                                                                                   value="off">
                                                                            <input type="checkbox"
                                                                                   class="form-check-input input-primary"
                                                                                   id="customswitchv1-1 is_razorpay_enabled"
                                                                                   name="is_razorpay_enabled"
                                                                                {{ isset($admin_payment_setting['is_razorpay_enabled']) && $admin_payment_setting['is_razorpay_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                        </div>
                                                                    </div>
                                                                </button>
                                                            </h2>
                                                            <div id="collapseFive" class="accordion-collapse collapse"
                                                                 aria-labelledby="headingFive"
                                                                 data-bs-parent="#accordionExample">
                                                                <div class="accordion-body">
                                                                    <div class="row gy-4">
                                                                        <div class="col-lg-6">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label for="paypal_client_id"
                                                                                           class="col-form-label">{{ __('Public Key') }}</label>
                                                                                    <input type="text"
                                                                                           name="razorpay_public_key"
                                                                                           id="razorpay_public_key"
                                                                                           class="form-control"
                                                                                           value="{{ !isset($admin_payment_setting['razorpay_public_key']) || is_null($admin_payment_setting['razorpay_public_key']) ? '' : $admin_payment_setting['razorpay_public_key'] }}"
                                                                                           placeholder="Public Key">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label for="paystack_secret_key"
                                                                                           class="col-form-label">
                                                                                        {{ __('Secret Key') }}</label>
                                                                                    <input type="text"
                                                                                           name="razorpay_secret_key"
                                                                                           id="razorpay_secret_key"
                                                                                           class="form-control"
                                                                                           value="{{ !isset($admin_payment_setting['razorpay_secret_key']) || is_null($admin_payment_setting['razorpay_secret_key']) ? '' : $admin_payment_setting['razorpay_secret_key'] }}"
                                                                                           placeholder="Secret Key">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Paytm -->
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="headingSix">
                                                                <button class="accordion-button collapsed" type="button"
                                                                        data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                                                        aria-expanded="false" aria-controls="collapseSix">
                                                                    <span class="d-flex align-items-center">
                                                                        {{ __('Paytm') }}
                                                                    </span>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="me-2">{{__('Enable')}}:</span>
                                                                        <div class="form-check form-switch custom-switch-v1">
                                                                            <input type="hidden" name="is_paytm_enabled"
                                                                                   value="off">
                                                                            <input type="checkbox"
                                                                                   class="form-check-input input-primary"
                                                                                   id="customswitchv1-1 is_paytm_enabled"
                                                                                   name="is_paytm_enabled"
                                                                                {{ isset($admin_payment_setting['is_paytm_enabled']) && $admin_payment_setting['is_paytm_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                        </div>
                                                                    </div>
                                                                </button>
                                                            </h2>
                                                            <div id="collapseSix" class="accordion-collapse collapse"
                                                                 aria-labelledby="headingSix"
                                                                 data-bs-parent="#accordionExample">
                                                                <div class="accordion-body">
                                                                    <div class="col-md-12 pb-4">
                                                                        <label class="paypal-label col-form-label"
                                                                               for="paypal_mode">{{ __('Paytm Environment') }}</label>
                                                                        <br>
                                                                        <div class="d-flex">
                                                                            <div class="mr-2" style="margin-right: 15px;">
                                                                                <div class="border card p-1">
                                                                                    <div class="form-check">
                                                                                        <label
                                                                                            class="form-check-labe text-dark">
                                                                                            <input type="radio"
                                                                                                   name="paytm_mode"
                                                                                                   value="local"
                                                                                                   class="form-check-input"
                                                                                                {{ !isset($admin_payment_setting['paytm_mode']) || $admin_payment_setting['paytm_mode'] == '' || $admin_payment_setting['paytm_mode'] == 'local' ? 'checked="checked"' : '' }}>
                                                                                            {{ __('Local') }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mr-2">
                                                                                <div class="border card p-1">
                                                                                    <div class="form-check">
                                                                                        <label
                                                                                            class="form-check-labe text-dark">
                                                                                            <input type="radio"
                                                                                                   name="paytm_mode"
                                                                                                   value="production"
                                                                                                   class="form-check-input"
                                                                                                {{ isset($admin_payment_setting['paytm_mode']) && $admin_payment_setting['paytm_mode'] == 'production' ? 'checked="checked"' : '' }}>
                                                                                            {{ __('Production') }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row gy-4">
                                                                        <div class="col-lg-4">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label for="paytm_public_key"
                                                                                           class="col-form-label">{{ __('Merchant ID') }}</label>
                                                                                    <input type="text"
                                                                                           name="paytm_merchant_id"
                                                                                           id="paytm_merchant_id"
                                                                                           class="form-control"
                                                                                           value="{{ isset($admin_payment_setting['paytm_merchant_id']) ? $admin_payment_setting['paytm_merchant_id'] : '' }}"
                                                                                           placeholder="{{ __('Merchant ID') }}" />
                                                                                    @if ($errors->has('paytm_merchant_id'))
                                                                                        <span class="invalid-feedback d-block">
                                                                                            {{ $errors->first('paytm_merchant_id') }}
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label for="paytm_secret_key"
                                                                                           class="col-form-label">{{ __('Merchant Key') }}</label>
                                                                                    <input type="text"
                                                                                           name="paytm_merchant_key"
                                                                                           id="paytm_merchant_key"
                                                                                           class="form-control"
                                                                                           value="{{ isset($admin_payment_setting['paytm_merchant_key']) ? $admin_payment_setting['paytm_merchant_key'] : '' }}"
                                                                                           placeholder="{{ __('Merchant Key') }}" />
                                                                                    @if ($errors->has('paytm_merchant_key'))
                                                                                        <span class="invalid-feedback d-block">
                                                                                            {{ $errors->first('paytm_merchant_key') }}
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label for="paytm_industry_type"
                                                                                           class="col-form-label">{{ __('Industry Type') }}</label>
                                                                                    <input type="text"
                                                                                           name="paytm_industry_type"
                                                                                           id="paytm_industry_type"
                                                                                           class="form-control"
                                                                                           value="{{ isset($admin_payment_setting['paytm_industry_type']) ? $admin_payment_setting['paytm_industry_type'] : '' }}"
                                                                                           placeholder="{{ __('Industry Type') }}" />
                                                                                    @if ($errors->has('paytm_industry_type'))
                                                                                        <span class="invalid-feedback d-block">
                                                                                            {{ $errors->first('paytm_industry_type') }}
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Mercado Pago -->
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="headingseven">
                                                                <button class="accordion-button collapsed" type="button"
                                                                        data-bs-toggle="collapse" data-bs-target="#collapseseven"
                                                                        aria-expanded="false" aria-controls="collapseseven">
                                                                    <span class="d-flex align-items-center">
                                                                        {{ __('Mercado Pago') }}
                                                                    </span>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="me-2">{{__('Enable')}}:</span>
                                                                        <div class="form-check form-switch custom-switch-v1">
                                                                            <input type="hidden" name="is_mercado_enabled"
                                                                                   value="off">
                                                                            <input type="checkbox"
                                                                                   class="form-check-input input-primary"
                                                                                   id="customswitchv1-1 is_mercado_enabled"
                                                                                   name="is_mercado_enabled"
                                                                                {{ isset($admin_payment_setting['is_mercado_enabled']) && $admin_payment_setting['is_mercado_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                        </div>
                                                                    </div>
                                                                </button>
                                                            </h2>
                                                            <div id="collapseseven" class="accordion-collapse collapse"
                                                                 aria-labelledby="headingseven"
                                                                 data-bs-parent="#accordionExample">
                                                                <div class="accordion-body">
                                                                    <div class="col-md-12 pb-4">
                                                                        <label class="coingate-label col-form-label"
                                                                               for="mercado_mode">{{ __('Mercado Mode') }}</label>
                                                                        <br>
                                                                        <div class="d-flex">
                                                                            <div class="mr-2" style="margin-right: 15px;">
                                                                                <div class="border card p-1">
                                                                                    <div class="form-check">
                                                                                        <label
                                                                                            class="form-check-labe text-dark">
                                                                                            <input type="radio"
                                                                                                   name="mercado_mode"
                                                                                                   value="sandbox"
                                                                                                   class="form-check-input"
                                                                                                {{ (isset($admin_payment_setting['mercado_mode']) && $admin_payment_setting['mercado_mode'] == '') || (isset($admin_payment_setting['mercado_mode']) && $admin_payment_setting['mercado_mode'] == 'sandbox') ? 'checked="checked"' : '' }}>
                                                                                            {{ __('Sandbox') }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mr-2">
                                                                                <div class="border card p-1">
                                                                                    <div class="form-check">
                                                                                        <label
                                                                                            class="form-check-labe text-dark">
                                                                                            <input type="radio"
                                                                                                   name="mercado_mode"
                                                                                                   value="live"
                                                                                                   class="form-check-input"
                                                                                                {{ isset($admin_payment_setting['mercado_mode']) && $admin_payment_setting['mercado_mode'] == 'live' ? 'checked="checked"' : '' }}>
                                                                                            {{ __('Live') }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row gy-4">
                                                                        <div class="col-lg-6">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label for="mercado_access_token"
                                                                                           class="col-form-label">{{ __('Access Token') }}</label>
                                                                                    <input type="text"
                                                                                           name="mercado_access_token"
                                                                                           id="mercado_access_token"
                                                                                           class="form-control"
                                                                                           value="{{ isset($admin_payment_setting['mercado_access_token']) ? $admin_payment_setting['mercado_access_token'] : '' }}"
                                                                                           placeholder="{{ __('Access Token') }}" />
                                                                                    @if ($errors->has('mercado_secret_key'))
                                                                                        <span class="invalid-feedback d-block">
                                                                                            {{ $errors->first('mercado_access_token') }}
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Mollie -->
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="headingeight">
                                                                <button class="accordion-button collapsed" type="button"
                                                                        data-bs-toggle="collapse" data-bs-target="#collapseeight"
                                                                        aria-expanded="false" aria-controls="collapseeight">
                                                                    <span class="d-flex align-items-center">
                                                                        {{ __('Mollie') }}
                                                                    </span>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="me-2">{{__('Enable')}}:</span>
                                                                        <div class="form-check form-switch custom-switch-v1">
                                                                            <input type="hidden" name="is_mollie_enabled"
                                                                                   value="off">
                                                                            <input type="checkbox"
                                                                                   class="form-check-input input-primary"
                                                                                   id="customswitchv1-1 is_mollie_enabled"
                                                                                   name="is_mollie_enabled"
                                                                                {{ isset($admin_payment_setting['is_mollie_enabled']) && $admin_payment_setting['is_mollie_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                        </div>
                                                                    </div>
                                                                </button>
                                                            </h2>
                                                            <div id="collapseeight" class="accordion-collapse collapse"
                                                                 aria-labelledby="headingeight"
                                                                 data-bs-parent="#accordionExample">
                                                                <div class="accordion-body">
                                                                    <div class="row gy-4">
                                                                        <div class="col-lg-6">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label for="mollie_api_key"
                                                                                           class="col-form-label">{{ __('Mollie Api Key') }}</label>
                                                                                    <input type="text"
                                                                                           name="mollie_api_key"
                                                                                           id="mollie_api_key"
                                                                                           class="form-control"
                                                                                           value="{{ !isset($admin_payment_setting['mollie_api_key']) || is_null($admin_payment_setting['mollie_api_key']) ? '' : $admin_payment_setting['mollie_api_key'] }}"
                                                                                           placeholder="Mollie Api Key">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label for="mollie_profile_id"
                                                                                           class="col-form-label">{{ __('Mollie Profile Id') }}</label>
                                                                                    <input type="text"
                                                                                           name="mollie_profile_id"
                                                                                           id="mollie_profile_id"
                                                                                           class="form-control"
                                                                                           value="{{ !isset($admin_payment_setting['mollie_profile_id']) || is_null($admin_payment_setting['mollie_profile_id']) ? '' : $admin_payment_setting['mollie_profile_id'] }}"
                                                                                           placeholder="Mollie Profile Id">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label for="mollie_partner_id"
                                                                                           class="col-form-label">{{ __('Mollie Partner Id') }}</label>
                                                                                    <input type="text"
                                                                                           name="mollie_partner_id"
                                                                                           id="mollie_partner_id"
                                                                                           class="form-control"
                                                                                           value="{{ !isset($admin_payment_setting['mollie_partner_id']) || is_null($admin_payment_setting['mollie_partner_id']) ? '' : $admin_payment_setting['mollie_partner_id'] }}"
                                                                                           placeholder="Mollie Partner Id">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Skrill -->
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="headingnine">
                                                                <button class="accordion-button collapsed" type="button"
                                                                        data-bs-toggle="collapse" data-bs-target="#collapsenine"
                                                                        aria-expanded="false" aria-controls="collapsenine">
                                                                    <span class="d-flex align-items-center">
                                                                        {{ __('Skrill') }}
                                                                    </span>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="me-2">{{__('Enable')}}:</span>
                                                                        <div class="form-check form-switch custom-switch-v1">
                                                                            <input type="hidden" name="is_skrill_enabled"
                                                                                   value="off">
                                                                            <input type="checkbox"
                                                                                   class="form-check-input input-primary"
                                                                                   id="customswitchv1-1 is_skrill_enabled"
                                                                                   name="is_skrill_enabled"
                                                                                {{ isset($admin_payment_setting['is_skrill_enabled']) && $admin_payment_setting['is_skrill_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                        </div>
                                                                    </div>
                                                                </button>
                                                            </h2>
                                                            <div id="collapsenine" class="accordion-collapse collapse"
                                                                 aria-labelledby="headingnine"
                                                                 data-bs-parent="#accordionExample">
                                                                <div class="accordion-body">
                                                                    <div class="row gy-4">
                                                                        <div class="col-lg-6">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label for="mollie_api_key"
                                                                                           class="col-form-label">{{ __('Skrill Email') }}</label>
                                                                                    <input type="email" name="skrill_email"
                                                                                           id="skrill_email" class="form-control"
                                                                                           value="{{ isset($admin_payment_setting['skrill_email']) ? $admin_payment_setting['skrill_email'] : '' }}"
                                                                                           placeholder="{{ __('Mollie Api Key') }}" />
                                                                                    @if ($errors->has('skrill_email'))
                                                                                        <span class="invalid-feedback d-block">
                                                                                            {{ $errors->first('skrill_email') }}
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- CoinGate -->
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="headingten">
                                                                <button class="accordion-button collapsed" type="button"
                                                                        data-bs-toggle="collapse" data-bs-target="#collapseten"
                                                                        aria-expanded="false" aria-controls="collapseten">
                                                                    <span class="d-flex align-items-center">
                                                                        {{ __('CoinGate') }}
                                                                    </span>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="me-2">{{__('Enable')}}:</span>
                                                                        <div class="form-check form-switch custom-switch-v1">
                                                                            <input type="hidden" name="is_coingate_enabled"
                                                                                   value="off">
                                                                            <input type="checkbox"
                                                                                   class="form-check-input input-primary"
                                                                                   id="customswitchv1-1 is_coingate_enabled"
                                                                                   name="is_coingate_enabled"
                                                                                {{ isset($admin_payment_setting['is_coingate_enabled']) && $admin_payment_setting['is_coingate_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                        </div>
                                                                    </div>
                                                                </button>
                                                            </h2>
                                                            <div id="collapseten" class="accordion-collapse collapse"
                                                                 aria-labelledby="headingten"
                                                                 data-bs-parent="#accordionExample">
                                                                <div class="accordion-body">
                                                                    <div class="col-md-12 pb-4">
                                                                        <label class="col-form-label"
                                                                               for="coingate_mode">{{ __('CoinGate Mode') }}</label>
                                                                        <br>
                                                                        <div class="d-flex">
                                                                            <div class="mr-2" style="margin-right: 15px;">
                                                                                <div class="border card p-1">
                                                                                    <div class="form-check">
                                                                                        <label
                                                                                            class="form-check-labe text-dark">
                                                                                            <input type="radio"
                                                                                                   name="coingate_mode"
                                                                                                   value="sandbox"
                                                                                                   class="form-check-input"
                                                                                                {{ !isset($admin_payment_setting['coingate_mode']) || $admin_payment_setting['coingate_mode'] == '' || $admin_payment_setting['coingate_mode'] == 'sandbox' ? 'checked="checked"' : '' }}>
                                                                                            {{ __('Sandbox') }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mr-2">
                                                                                <div class="border card p-1">
                                                                                    <div class="form-check">
                                                                                        <label
                                                                                            class="form-check-labe text-dark">
                                                                                            <input type="radio"
                                                                                                   name="coingate_mode"
                                                                                                   value="live"
                                                                                                   class="form-check-input"
                                                                                                {{ isset($admin_payment_setting['coingate_mode']) && $admin_payment_setting['coingate_mode'] == 'live' ? 'checked="checked"' : '' }}>
                                                                                            {{ __('Live') }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row gy-4">
                                                                        <div class="col-lg-6">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label for="coingate_auth_token"
                                                                                           class="col-form-label">{{ __('CoinGate Auth Token') }}</label>
                                                                                    <input type="text"
                                                                                           name="coingate_auth_token"
                                                                                           id="coingate_auth_token"
                                                                                           class="form-control"
                                                                                           value="{{ !isset($admin_payment_setting['coingate_auth_token']) || is_null($admin_payment_setting['coingate_auth_token']) ? '' : $admin_payment_setting['coingate_auth_token'] }}"
                                                                                           placeholder="CoinGate Auth Token">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- PaymentWall -->
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="headingeleven">
                                                                <button class="accordion-button collapsed" type="button"
                                                                        data-bs-toggle="collapse" data-bs-target="#collapseeleven"
                                                                        aria-expanded="false" aria-controls="collapseeleven">
                                                                    <span class="d-flex align-items-center">
                                                                        {{ __('PaymentWall') }}
                                                                    </span>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="me-2">{{__('Enable')}}:</span>
                                                                        <div class="form-check form-switch custom-switch-v1">
                                                                            <input type="hidden"
                                                                                   name="is_paymentwall_enabled" value="off">
                                                                            <input type="checkbox"
                                                                                   class="form-check-input input-primary"
                                                                                   id="customswitchv1-1 is_paymentwall_enabled"
                                                                                   name="is_paymentwall_enabled"
                                                                                {{ isset($admin_payment_setting['is_paymentwall_enabled']) && $admin_payment_setting['is_paymentwall_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                        </div>
                                                                    </div>
                                                                </button>
                                                            </h2>
                                                            <div id="collapseeleven" class="accordion-collapse collapse"
                                                                 aria-labelledby="headingeleven"
                                                                 data-bs-parent="#accordionExample">
                                                                <div class="accordion-body">
                                                                    <div class="row gy-4">
                                                                        <div class="col-lg-6">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label for="paymentwall_public_key"
                                                                                           class="col-form-label">{{ __('Public Key') }}</label>
                                                                                    <input type="text"
                                                                                           name="paymentwall_public_key"
                                                                                           id="paymentwall_public_key"
                                                                                           class="form-control"
                                                                                           value="{{ !isset($admin_payment_setting['paymentwall_public_key']) || is_null($admin_payment_setting['paymentwall_public_key']) ? '' : $admin_payment_setting['paymentwall_public_key'] }}"
                                                                                           placeholder="{{ __('Public Key') }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label for="paymentwall_secret_key"
                                                                                           class="col-form-label">{{ __('Private Key') }}</label>
                                                                                    <input type="text"
                                                                                           name="paymentwall_secret_key"
                                                                                           id="paymentwall_secret_key"
                                                                                           class="form-control"
                                                                                           value="{{ !isset($admin_payment_setting['paymentwall_secret_key']) || is_null($admin_payment_setting['paymentwall_secret_key']) ? '' : $admin_payment_setting['paymentwall_secret_key'] }}"
                                                                                           placeholder="{{ __('Private Key') }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Toyyibpay -->
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="headingtwelve">
                                                                <button class="accordion-button collapsed" type="button"
                                                                        data-bs-toggle="collapse" data-bs-target="#collapsetwelve"
                                                                        aria-expanded="false" aria-controls="collapsetwelve">
                                                                    <span class="d-flex align-items-center">
                                                                        {{ __('Toyyibpay') }}
                                                                    </span>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="me-2">Enable:</span>
                                                                        <div class="form-check form-switch custom-switch-v1">
                                                                            <input type="hidden"
                                                                                   name="is_toyyibpay_enabled" value="off">
                                                                            <input type="checkbox"
                                                                                   class="form-check-input input-primary"
                                                                                   id="customswitchv1-1 is_toyyibpay_enabled"
                                                                                   name="is_toyyibpay_enabled"
                                                                                {{ isset($admin_payment_setting['is_toyyibpay_enabled']) && $admin_payment_setting['is_toyyibpay_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                        </div>
                                                                    </div>
                                                                </button>
                                                            </h2>
                                                            <div id="collapsetwelve" class="accordion-collapse collapse"
                                                                 aria-labelledby="headingtwelve"
                                                                 data-bs-parent="#accordionExample">
                                                                <div class="accordion-body">
                                                                    <div class="row gy-4">
                                                                        <div class="col-lg-6">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label for="toyyibpay_category_code"
                                                                                           class="col-form-label">{{ __('Category Key') }}</label>
                                                                                    <input type="text"
                                                                                           name="toyyibpay_category_code"
                                                                                           id="toyyibpay_category_code"
                                                                                           class="form-control"
                                                                                           value="{{ !isset($admin_payment_setting['toyyibpay_category_code']) || is_null($admin_payment_setting['toyyibpay_category_code']) ? '' : $admin_payment_setting['toyyibpay_category_code'] }}"
                                                                                           placeholder="{{ __('Category Key') }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label for="toyyibpay_secret_key"
                                                                                           class="col-form-label">{{ __('Secrect Key') }}</label>
                                                                                    <input type="text"
                                                                                           name="toyyibpay_secret_key"
                                                                                           id="toyyibpay_secret_key"
                                                                                           class="form-control"
                                                                                           value="{{ !isset($admin_payment_setting['toyyibpay_secret_key']) || is_null($admin_payment_setting['toyyibpay_secret_key']) ? '' : $admin_payment_setting['toyyibpay_secret_key'] }}"
                                                                                           placeholder="{{ __('Secrect Key') }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn-submit btn btn-primary" type="submit">
                                    {{ __('Save Changes') }}
                                </button>
                            </div>
                        </form>
                    </div>

                    <!--Pusher Settings-->
                    <div id="pusher-settings" class="card">
                        <div class="card-header">
                            <h5>{{ __('Pusher Settings') }}</h5>
                        </div>
                        <div class="card-body">
                            {{Form::model($settings,array('route'=>'pusher.setting','method'=>'post'))}}
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::label('pusher_app_id',__('Pusher App Id'),array('class'=>'form-label')) }}
                                        {{Form::text('pusher_app_id',env('PUSHER_APP_ID'),array('class'=>'form-control font-style'))}}
                                        @error('pusher_app_id')
                                        <span class="invalid-pusher_app_id" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::label('pusher_app_key',__('Pusher App Key'),array('class'=>'form-label')) }}
                                        {{Form::text('pusher_app_key',env('PUSHER_APP_KEY'),array('class'=>'form-control font-style'))}}
                                        @error('pusher_app_key')
                                        <span class="invalid-pusher_app_key" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::label('pusher_app_secret',__('Pusher App Secret'),array('class'=>'form-label')) }}
                                        {{Form::text('pusher_app_secret',env('PUSHER_APP_SECRET'),array('class'=>'form-control font-style'))}}
                                        @error('pusher_app_secret')
                                        <span class="invalid-pusher_app_secret" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::label('pusher_app_cluster',__('Pusher App Cluster'),array('class'=>'form-label')) }}
                                        {{Form::text('pusher_app_cluster',env('PUSHER_APP_CLUSTER'),array('class'=>'form-control font-style'))}}
                                        @error('pusher_app_cluster')
                                        <span class="invalid-pusher_app_cluster" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <div class="form-group">
                                    <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit" value="{{__('Save Changes')}}">
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>

                    <!--ReCaptcha Settings-->
                    <div id="recaptcha_settings" class="card">
                        <form method="POST" action="{{ route('recaptcha.settings.store') }}" accept-charset="UTF-8">
                            @csrf
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="mb-2">{{ __('ReCaptcha Settings') }}</h5>
                                        <a href="https://phppot.com/php/how-to-get-google-recaptcha-site-and-secret-key/"
                                           target="_blank" class="text-dark">
                                            <small>({{ __('How to Get Google reCaptcha Site and Secret key') }})</small>
                                        </a>
                                    </div>
                                    <div class="col switch-width text-end">
                                        <div class="form-group mb-0">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" data-toggle="switchbutton" data-onstyle="primary" class="" name="recaptcha_module"
                                                       id="recaptcha_module"  {{ env('RECAPTCHA_MODULE') == 'on' ? 'checked="checked"' : '' }}>
                                                <label class="custom-control-label" for="recaptcha_module"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="google_recaptcha_key" class="form-label">{{ __('Google Recaptcha Key') }}</label>
                                                <input class="form-control" placeholder="{{ __('Enter Google Recaptcha Key') }}" name="google_recaptcha_key" type="text" value="{{env('NOCAPTCHA_SITEKEY')}}" id="google_recaptcha_key">
                                            </div>
                                        </div>
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="google_recaptcha_secret" class="form-label">{{ __('Google Recaptcha Secret') }}</label>
                                                <input class="form-control" placeholder="{{ __('Enter Google Recaptcha Secret') }}" name="google_recaptcha_secret" type="text" value="{{env('NOCAPTCHA_SECRET')}}" id="google_recaptcha_secret">
                                            </div>
                                        </div>
                                </div>
                                <div class="card-footer text-end">
                                    <div class="form-group">
                                        <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="{{__('Save Changes')}}">
                                    </div>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>

                    <!-- Storage Settings -->
                    <div id="storage-settings" class="card mb-3">
                        {{ Form::open(array('route' => 'storage.setting.store', 'enctype' => "multipart/form-data")) }}
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <h5 class="">{{ __('Storage Settings') }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="pe-2">
                                    <input type="radio" class="btn-check" name="storage_setting" id="local-outlined" autocomplete="off" {{  $setting['storage_setting'] == 'local'?'checked':'' }} value="local" checked>
                                    <label class="btn btn-outline-primary" for="local-outlined">{{ __('Local') }}</label>
                                </div>
                                <div  class="pe-2">
                                    <input type="radio" class="btn-check" name="storage_setting" id="s3-outlined" autocomplete="off" {{  $setting['storage_setting']=='s3'?'checked':'' }}  value="s3">
                                    <label class="btn btn-outline-primary" for="s3-outlined"> {{ __('AWS S3') }}</label>
                                </div>
                                <div  class="pe-2">
                                    <input type="radio" class="btn-check" name="storage_setting" id="wasabi-outlined" autocomplete="off" {{  $setting['storage_setting']=='wasabi'?'checked':'' }} value="wasabi">
                                    <label class="btn btn-outline-primary" for="wasabi-outlined">{{ __('Wasabi') }}</label>
                                </div>
                            </div>
                            <div  class="mt-2">
                                <div class="local-setting row {{  $setting['storage_setting']=='local'?' ':'d-none' }}">
                                    <div class="form-group col-8 switch-width">
                                        {{Form::label('local_storage_validation',__('Only Upload Files'),array('class'=>' form-label')) }}
                                        <select name="local_storage_validation[]" class="select2"  id="local_storage_validation"  multiple>
                                            @foreach($file_type as $f)
                                                <option @if (in_array($f, $local_storage_validations)) selected @endif>{{$f}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label" for="local_storage_max_upload_size">{{ __('Max upload size ( In KB)')}}</label>
                                            <input type="number" name="local_storage_max_upload_size" class="form-control" value="{{(!isset($setting['local_storage_max_upload_size']) || is_null($setting['local_storage_max_upload_size'])) ? '' : $setting['local_storage_max_upload_size']}}" placeholder="{{ __('Max upload size') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="s3-setting row {{  $setting['storage_setting']=='s3'?' ':'d-none' }}">
                                    <div class=" row ">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="s3_key">{{ __('S3 Key') }}</label>
                                                <input type="text" name="s3_key" class="form-control" value="{{(!isset($setting['s3_key']) || is_null($setting['s3_key'])) ? '' : $setting['s3_key']}}" placeholder="{{ __('S3 Key') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="s3_secret">{{ __('S3 Secret') }}</label>
                                                <input type="text" name="s3_secret" class="form-control" value="{{(!isset($setting['s3_secret']) || is_null($setting['s3_secret'])) ? '' : $setting['s3_secret']}}" placeholder="{{ __('S3 Secret') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="s3_region">{{ __('S3 Region') }}</label>
                                                <input type="text" name="s3_region" class="form-control" value="{{(!isset($setting['s3_region']) || is_null($setting['s3_region'])) ? '' : $setting['s3_region']}}" placeholder="{{ __('S3 Region') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="s3_bucket">{{ __('S3 Bucket') }}</label>
                                                <input type="text" name="s3_bucket" class="form-control" value="{{(!isset($setting['s3_bucket']) || is_null($setting['s3_bucket'])) ? '' : $setting['s3_bucket']}}" placeholder="{{ __('S3 Bucket') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="s3_url">{{ __('S3 URL')}}</label>
                                                <input type="text" name="s3_url" class="form-control" value="{{(!isset($setting['s3_url']) || is_null($setting['s3_url'])) ? '' : $setting['s3_url']}}" placeholder="{{ __('S3 URL')}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="s3_endpoint">{{ __('S3 Endpoint')}}</label>
                                                <input type="text" name="s3_endpoint" class="form-control" value="{{(!isset($setting['s3_endpoint']) || is_null($setting['s3_endpoint'])) ? '' : $setting['s3_endpoint']}}" placeholder="{{ __('S3 Bucket') }}">
                                            </div>
                                        </div>
                                        <div class="form-group col-8 switch-width">
                                            {{Form::label('s3_storage_validation',__('Only Upload Files'),array('class'=>' form-label')) }}
                                            <select name="s3_storage_validation[]" class="select2" id="s3_storage_validation" multiple>
                                                @foreach($file_type as $f)
                                                    <option @if (in_array($f, $s3_storage_validations)) selected @endif>{{$f}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label" for="s3_max_upload_size">{{ __('Max upload size ( In KB)')}}</label>
                                                <input type="number" name="s3_max_upload_size" class="form-control" value="{{(!isset($setting['s3_max_upload_size']) || is_null($setting['s3_max_upload_size'])) ? '' : $setting['s3_max_upload_size']}}" placeholder="{{ __('Max upload size') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="wasabi-setting row {{  $setting['storage_setting']=='wasabi'?' ':'d-none' }}">
                                    <div class=" row ">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="s3_key">{{ __('Wasabi Key') }}</label>
                                                <input type="text" name="wasabi_key" class="form-control" value="{{(!isset($setting['wasabi_key']) || is_null($setting['wasabi_key'])) ? '' : $setting['wasabi_key']}}" placeholder="{{ __('Wasabi Key') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="s3_secret">{{ __('Wasabi Secret') }}</label>
                                                <input type="text" name="wasabi_secret" class="form-control" value="{{(!isset($setting['wasabi_secret']) || is_null($setting['wasabi_secret'])) ? '' : $setting['wasabi_secret']}}" placeholder="{{ __('Wasabi Secret') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="s3_region">{{ __('Wasabi Region') }}</label>
                                                <input type="text" name="wasabi_region" class="form-control" value="{{(!isset($setting['wasabi_region']) || is_null($setting['wasabi_region'])) ? '' : $setting['wasabi_region']}}" placeholder="{{ __('Wasabi Region') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="wasabi_bucket">{{ __('Wasabi Bucket') }}</label>
                                                <input type="text" name="wasabi_bucket" class="form-control" value="{{(!isset($setting['wasabi_bucket']) || is_null($setting['wasabi_bucket'])) ? '' : $setting['wasabi_bucket']}}" placeholder="{{ __('Wasabi Bucket') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="wasabi_url">{{ __('Wasabi URL')}}</label>
                                                <input type="text" name="wasabi_url" class="form-control" value="{{(!isset($setting['wasabi_url']) || is_null($setting['wasabi_url'])) ? '' : $setting['wasabi_url']}}" placeholder="{{ __('Wasabi URL')}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="wasabi_root">{{ __('Wasabi Root')}}</label>
                                                <input type="text" name="wasabi_root" class="form-control" value="{{(!isset($setting['wasabi_root']) || is_null($setting['wasabi_root'])) ? '' : $setting['wasabi_root']}}" placeholder="{{ __('Wasabi Bucket') }}">
                                            </div>
                                        </div>
                                        <div class="form-group col-8 switch-width">
                                            {{Form::label('wasabi_storage_validation',__('Only Upload Files'),array('class'=>'form-label')) }}

                                            <select name="wasabi_storage_validation[]" class="select2" id="wasabi_storage_validation" multiple>
                                                @foreach($file_type as $f)
                                                    <option @if (in_array($f, $wasabi_storage_validations)) selected @endif>{{$f}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label" for="wasabi_root">{{ __('Max upload size ( In KB)')}}</label>
                                                <input type="number" name="wasabi_max_upload_size" class="form-control" value="{{(!isset($setting['wasabi_max_upload_size']) || is_null($setting['wasabi_max_upload_size'])) ? '' : $setting['wasabi_max_upload_size']}}" placeholder="{{ __('Max upload size') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit" value="{{ __('Save Changes') }}">
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>

                    {{-- SEO settings --}}
                    <div id="seo-settings" class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <h5>{{ __('SEO Settings') }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ Form::open(['url' => route('seo.settings.store'), 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('Meta Keywords', __('Meta Keywords'), ['class' => 'col-form-label']) }}
                                        {{ Form::text('meta_title', !empty($setting['meta_title']) ? $setting['meta_title'] : '', ['class' => 'form-control ', 'placeholder' => 'Meta Keywords']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('Meta Description', __('Meta Description'), ['class' => 'col-form-label']) }}
                                        {{ Form::textarea('meta_desc', !empty($setting['meta_desc']) ? $setting['meta_desc'] : '', ['class' => 'form-control ', 'placeholder' => 'Meta Description','rows'=>7]) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                    {{ Form::label('Meta Image', __('Meta Image'), ['class' => 'col-form-label']) }}
                                    </div>
                                    <div class="setting-card">
                                        <div class="logo-content">
                                            <img id="image2" src="{{ $meta_image . '/' . (isset($setting['meta_image']) && !empty($setting['meta_image']) ? $setting['meta_image'] : 'meta_image.png') }}"
                                                 class="img_setting seo_image">
                                        </div>
                                        <div class="choose-files mt-4">
                                            <label for="meta_image">
                                                <div class="bg-primary company_favicon_update"> <i
                                                        class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                </div>
                                                <input type="file" class="form-control file"  id="meta_image" name="meta_image"
                                                       data-filename="meta_image">
                                            </label>
                                        </div>
                                        @error('meta_image')
                                        <div class="row">
                                            <span class="invalid-logo" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="card-footer text-end">
                                <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="{{ __('Save Changes') }}">
                            </div>

                            {{ Form::close() }}
                        </div>
                    </div>

                    {{-- Cookie settings --}}
                    <div class="card" id="cookie-settings">

                        {{Form::model($settings,array('route'=>'cookie.setting','method'=>'post'))}}
                        <div class="card-header flex-column flex-lg-row d-flex align-items-lg-center gap-2 justify-content-between">
                            <h5>{{ __('Cookie Settings') }}</h5>
                            <div class="d-flex align-items-center">
                                {{ Form::label('enable_cookie', __('Enable cookie'), ['class' => 'col-form-label p-0 fw-bold me-3']) }}
                                <div class="custom-control custom-switch"  onclick="enablecookie()">
                                    <input type="checkbox" data-toggle="switchbutton" data-onstyle="primary" name="enable_cookie" class="form-check-input input-primary "
                                           id="enable_cookie" {{ $settings['enable_cookie'] == 'on' ? ' checked ' : '' }} >
                                    <label class="custom-control-label mb-1" for="enable_cookie"></label>
                                </div>
                            </div>
                        </div>
                        <div class="card-body cookieDiv {{ $settings['enable_cookie'] == 'off' ? 'disabledCookie ' : '' }}">
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="form-check form-switch custom-switch-v1" id="cookie_log">
                                        <input type="checkbox" name="cookie_logging" class="form-check-input input-primary cookie_setting"
                                               id="cookie_logging" {{ $settings['cookie_logging'] == 'on' ? ' checked ' : '' }}>
                                        <label class="form-check-label" for="cookie_logging">{{__('Enable logging')}}</label>
                                    </div>
                                    <div class="form-group" >
                                        {{ Form::label('cookie_title', __('Cookie Title'), ['class' => 'col-form-label' ]) }}
                                        {{ Form::text('cookie_title', null, ['class' => 'form-control cookie_setting'] ) }}
                                    </div>
                                    <div class="form-group ">
                                        {{ Form::label('cookie_description', __('Cookie Description'), ['class' => ' form-label']) }}
                                        {!! Form::textarea('cookie_description', null, ['class' => 'form-control cookie_setting', 'rows' => '3']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-switch custom-switch-v1 ">
                                        <input type="checkbox" name="necessary_cookies" class="form-check-input input-primary"
                                               id="necessary_cookies" checked onclick="return false">
                                        <label class="form-check-label" for="necessary_cookies">{{__('Strictly necessary cookies')}}</label>
                                    </div>
                                    <div class="form-group ">
                                        {{ Form::label('strictly_cookie_title', __(' Strictly Cookie Title'), ['class' => 'col-form-label']) }}
                                        {{ Form::text('strictly_cookie_title', null, ['class' => 'form-control cookie_setting']) }}
                                    </div>
                                    <div class="form-group ">
                                        {{ Form::label('strictly_cookie_description', __('Strictly Cookie Description'), ['class' => ' form-label']) }}
                                        {!! Form::textarea('strictly_cookie_description', null, ['class' => 'form-control cookie_setting ', 'rows' => '3']) !!}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <h5>{{__('More Information')}}</h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('more_information_description', __('Contact Us Description'), ['class' => 'col-form-label']) }}
                                        {{ Form::text('more_information_description', null, ['class' => 'form-control cookie_setting']) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        {{ Form::label('contactus_url', __('Contact Us URL'), ['class' => 'col-form-label']) }}
                                        {{ Form::text('contactus_url', null, ['class' => 'form-control cookie_setting']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer mb-3">
                            <div class="row">
                                <div class="col-6">
                                    @if(isset($settings['cookie_logging']) && $settings['cookie_logging'] == 'on')
                                        <label for="file" class="form-label">{{__('Download cookie accepted data')}}</label>
                                        <a href="{{ asset(Storage::url('uploads/sample')) . '/data.csv' }}" class="btn btn-primary mr-3">
                                            <i class="ti ti-download"></i>
                                        </a>
                                    @endif
                                </div>
                                <div class="col-6 text-end ">
                                    <input class="btn btn-print-invoice btn-primary cookie_btn" type="submit" value="{{ __('Save Changes') }}">
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>

                    {{-- Cache settings --}}
                    <div class="card" id="cache-settings">
                        <div class="card-header">
                            <h5>{{ 'Cache Settings' }}</h5>
                            <small class="text-secondary font-weight-bold">
                                {{ __("This is a page meant for more advanced users, simply ignore it if you don't understand what cache is.") }}
                            </small>
                        </div>
                        <form method="POST" action="{{ route('cache.settings.store') }}" accept-charset="UTF-8">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 form-group">
                                        {{ Form::label('Current cache size', __('Current cache size'), ['class' => 'col-form-label']) }}
                                        <div class="input-group mb-5">
                                            <input type="text" class="form-control" value="{{ $file_size }}" readonly >
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon6">{{ __('MB') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="card-footer text-end">
                                <input class="btn btn-print-invoice btn-primary cookie_btn" type="submit" value="{{ __('Cache Clear') }}">
                            </div>
                        {{ Form::close() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection



