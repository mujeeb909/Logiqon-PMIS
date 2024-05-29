@php
    $logo=\App\Models\Utility::get_file('uploads/logo/');
    $setting = App\Models\Utility::colorset();
    $color = (!empty($setting['color'])) ? $setting['color'] : 'theme-3';

    $getseo= App\Models\Utility::getSeoSetting();
    $metatitle =  isset($getseo['meta_title']) ? $getseo['meta_title'] :'';
    $metsdesc= isset($getseo['meta_desc'])?$getseo['meta_desc']:'';
    $meta_image = \App\Models\Utility::get_file('uploads/meta/');
    $meta_logo = isset($getseo['meta_image'])?$getseo['meta_image']:'';
    $get_cookie = \App\Models\Utility::getCookieSetting();


@endphp

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        {{ !empty($companySettings['header_text']) ? $companySettings['header_text']->value : config('app.name', 'ERPGO SaaS') }}
        - {{ __('Career') }}</title>

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

    <link rel="icon" href="{{$logo.'/'.(isset($favicon) && !empty($favicon)?$favicon:'favicon.png')}}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}" id="stylesheet">
    @if (isset($setting['cust_darklayout']) && $setting['cust_darklayout'] == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-dark.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"id="main-style-link">
    @endif
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="{{$color}}">
    <div class="job-wrapper">
        <div class="job-content">
            <nav class="navbar">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="{{ $logo . '/' . (isset($company_logos) && !empty($company_logos) ? $company_logos : 'logo-light.png') }}" alt="logo" style="width: 90px">

                    </a>
                </div>
            </nav>
            <section class="job-banner">
                <div class="job-banner-bg">
                    <img src="{{asset('/storage/uploads/job/banner.png')}}" alt="">

                </div>
                <div class="container">
                    <div class="job-banner-content text-center text-white">
                        <h1 class="text-white mb-3">
                            {{__(' We help')}} <br> {{__('businesses grow')}}
                        </h1>
                        <p>{{ __('Work there. Find the dream job you’ve always wanted..') }}</p>
                        </p>
                    </div>
                </div>
            </section>
            <section class="apply-job-section">
                <div class="container">
                    <div class="apply-job-wrapper bg-light">
                        <div class="section-title text-center">
                            <p><b>{{$job->title}}</b></p>
                            <div class="d-flex flex-wrap justify-content-center gap-1 mb-4">
                                @foreach (explode(',', $job->skill) as $skill)
                                    <span class="badge rounded p-2 bg-primary">{{ $skill }}</span>
                                @endforeach
                            </div>

                            @if(!empty($job->branches)?$job->branches->name:'')
                                <p> <i class="ti ti-map-pin ms-1"></i> {{!empty($job->branches)?$job->branches->name:''}}</p>
                            @endif

                            <a href="{{route('job.apply',[$job->code,$currantLang])}}" class="btn btn-primary rounded">{{__('Apply now')}} <i class="ti ti-send ms-2"></i> </a>
                        </div>
                        <h3>{{__('Requirements')}}</h3>
                        <p>{!! $job->requirement !!}</p>

                        <hr>
                        <h3>{{__('Description')}}</h3><br>
                        {!! $job->description !!}
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
    <script src="{{ asset('js/site.core.js') }}"></script>
    <script src="{{ asset('js/site.js') }}"></script>
    <script src="{{ asset('js/demo.js') }} "></script>
</body>

@if($get_cookie['enable_cookie'] == 'on')
    @include('layouts.cookie_consent')
@endif


</html>
