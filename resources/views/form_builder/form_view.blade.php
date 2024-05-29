@php
  //  $logo=asset(Storage::url('uploads/logo/'));
    $logo=\App\Models\Utility::get_file('uploads/logo');
    $company_favicon=Utility::getValByName('company_favicon');
    $favicon=Utility::getValByName('company_favicon');

    $getseo= App\Models\Utility::getSeoSetting();
    $metatitle =  isset($getseo['meta_title']) ? $getseo['meta_title'] :'';
    $metsdesc= isset($getseo['meta_desc'])?$getseo['meta_desc']:'';
    $meta_image = \App\Models\Utility::get_file('uploads/meta/');
    $meta_logo = isset($getseo['meta_image'])?$getseo['meta_image']:'';
    $get_cookie = \App\Models\Utility::getCookieSetting();
@endphp

<html lang="en">
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
<head>
    <title>{{(Utility::getValByName('title_text')) ? Utility::getValByName('title_text') : config('app.name', 'ERPGO')}} - Form Builder</title>
{{--    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>--}}
{{--    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>--}}

    <meta name="title" content="{{$metatitle}}">
    <meta name="description" content="{{$metsdesc}}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:title" content="{{$metatitle}}">
    <meta property="og:description" content="{{$metsdesc}}">
    <meta property="og:image" content="{{$meta_image.$meta_logo}}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:title" content="{{$metatitle}}">
    <meta property="twitter:description" content="{{$metsdesc}}">
    <meta property="twitter:image" content="{{$meta_image.$meta_logo}}">


    <!-- Meta -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
{{--    <meta name="url" content="{{ url('').'/'.config('chatify.path') }}" data-user="{{ Auth::user()->id }}">--}}
    <link rel="icon" href="{{$logo.'/'.(isset($company_favicon) && !empty($company_favicon)?$company_favicon:'favicon.png')}}" type="image" sizes="16x16">

    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon"/>

    <link rel="stylesheet" href="{{ asset('assets/css/plugins/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/animate.min.css') }}">

    <!-- font css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/main.css') }}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('assets/css/customizer.css') }}">

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" id="main-style-link">

</head>

<body class="theme-4">

    <div class="dash-content">

        <div class="min-vh-100 py-5 d-flex align-items-center">
            <div class="w-100">
                <div class="row justify-content-center">
                    <div class="col-sm-8 col-lg-5">
                        <div class="row justify-content-center mb-3">
                            <a class="navbar-brand" href="#">
                                <img src="{{asset(Storage::url('uploads/logo/logo-dark.png'))}}" class="navbar-brand-img big-logo">
                            </a>
                        </div>
                        <div class="card shadow zindex-100 mb-0">
                            @if($form->is_active == 1)
                                {{Form::open(array('route'=>array('form.view.store'),'method'=>'post'))}}
                                <div class="card-body px-md-5 py-5">
                                    <div class="mb-4">
                                        <h6 class="h3">{{$form->name}}</h6>
                                    </div>
                                    <input type="hidden" value="{{$code}}" name="code">
                                    @if($objFields && $objFields->count() > 0)
                                        @foreach($objFields as $objField)
                                            @if($objField->type == 'text')
                                                <div class="form-group">
                                                    {{ Form::label('field-'.$objField->id, __($objField->name),['class'=>'form-label']) }}
                                                    {{ Form::text('field['.$objField->id.']', null, array('class' => 'form-control','required'=>'required','id'=>'field-'.$objField->id)) }}
                                                </div>
                                            @elseif($objField->type == 'email')
                                                <div class="form-group">
                                                    {{ Form::label('field-'.$objField->id, __($objField->name),['class'=>'form-label']) }}
                                                    {{ Form::email('field['.$objField->id.']', null, array('class' => 'form-control','required'=>'required','id'=>'field-'.$objField->id)) }}
                                                </div>
                                            @elseif($objField->type == 'number')
                                                <div class="form-group">
                                                    {{ Form::label('field-'.$objField->id, __($objField->name),['class'=>'form-label']) }}
                                                    {{ Form::number('field['.$objField->id.']', null, array('class' => 'form-control','required'=>'required','id'=>'field-'.$objField->id)) }}
                                                </div>
                                            @elseif($objField->type == 'date')
                                                <div class="form-group">
                                                    {{ Form::label('field-'.$objField->id, __($objField->name),['class'=>'form-label']) }}
                                                    {{ Form::date('field['.$objField->id.']', null, array('class' => 'form-control','required'=>'required','id'=>'field-'.$objField->id)) }}
                                                </div>
                                            @elseif($objField->type == 'textarea')
                                                <div class="form-group">
                                                    {{ Form::label('field-'.$objField->id, __($objField->name),['class'=>'form-label']) }}
                                                    {{ Form::textarea('field['.$objField->id.']', null, array('class' => 'form-control','required'=>'required','id'=>'field-'.$objField->id)) }}
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                    <div class="mt-4 text-end">

                                        {{Form::submit(__('Submit'),array('class'=>'btn btn-primary'))}}
                                    </div>
                                </div>

                                {{Form::close()}}
                            @else
                                <div class="page-title"><h5>{{__('Form is not active.')}}</h5></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.admin.footer')

    @if($get_cookie['enable_cookie'] == 'on')
        @include('layouts.cookie_consent')
    @endif

</body>

</html>
