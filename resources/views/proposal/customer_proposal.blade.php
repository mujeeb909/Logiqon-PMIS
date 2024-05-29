@php
    // $logo=asset(Storage::url('uploads/logo/'));
     $logo=\App\Models\Utility::get_file('uploads/logo');
     $company_favicon=Utility::companyData($proposal->created_by,'company_favicon');
     $setting = \App\Models\Utility::colorset();
     $color = (!empty($setting['color'])) ? $setting['color'] : 'theme-3';
     $company_setting=\App\Models\Utility::settingsById($proposal->created_by);

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
   <meta charset="UTF-8">
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
   <title>{{(Utility::companyData($proposal->created_by,'title_text')) ? Utility::companyData($proposal->created_by,'title_text') : config('app.name', 'ERPGO')}} - {{__('Proposal')}}</title>

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


     <link rel="icon" href="{{$logo.'/'.(isset($company_favicon) && !empty($company_favicon)?$company_favicon:'favicon.png')}}" type="image" sizes="16x16">
     <link rel="stylesheet" href="{{ asset('assets/css/plugins/main.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/css/plugins/style.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/css/plugins/animate.min.css') }}">

     <!-- font css -->
     <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">

     <!-- vendor css -->
     <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
     <link rel="stylesheet" href="{{ asset('assets/css/customizer.css') }}">
     <link rel="stylesheet" href="{{ asset('css/custom.css') }}" id="main-style-link">
     <link rel="stylesheet" href="{{ asset('assets/css/plugins/bootstrap-switch-button.min.css') }}">

     @stack('css-page')

     <meta name="csrf-token" content="{{ csrf_token() }}">
     <style>
         #card-element {
             border: 1px solid #a3afbb !important;
             border-radius: 10px !important;
             padding: 10px !important;
         }
     </style>
 </head>

 <body class="{{ $color }}">
 <header class="header header-transparent" id="header-main">

 </header>

 <div class="main-content container">
     <div class="row justify-content-between align-items-center mb-3">
         <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
             <div class="all-button-box mx-2">
                 <a href="{{ route('proposal.pdf', Crypt::encrypt($proposal->id))}}" target="_blank" class="btn btn-primary mt-3">
                     {{__('Download')}}
                 </a>
             </div>
         </div>
     </div>
     <div class="row">
         <div class="col-12">
             <div class="card">
                 <div class="card-body">
                     <div class="proposal">
                         <div class="proposal-print">
                             <div class="row invoice-title mt-2">
                                 <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12">
                                     <h2>{{__('Proposal')}}</h2>
                                 </div>
                                 <div class="col-12">
                                     <hr>
                                 </div>
                             </div>
                             <div class="row">
                                 @if(!empty($customer->billing_name))
                                     <div class="col">
                                         <small class="font-style">
                                             <strong>{{__('Billed To')}} :</strong><br>
                                             {{!empty($customer->billing_name)?$customer->billing_name:''}}<br>
                                             {{!empty($customer->billing_phone)?$customer->billing_phone:''}}<br>
                                             {{!empty($customer->billing_address)?$customer->billing_address:''}}<br>
                                             {{!empty($customer->billing_zip)?$customer->billing_zip:''}}<br>
                                             {{!empty($customer->billing_city)?$customer->billing_city:'' .', '}} {{!empty($customer->billing_state)?$customer->billing_state:'',', '}} {{!empty($customer->billing_country)?$customer->billing_country:''}}
                                         </small>
                                     </div>
                                 @endif
                                 @if(\Utility::companyData($proposal->created_by,'shipping_display')=='on')
                                     <div class="col">
                                         <small>
                                             <strong>{{__('Shipped To')}} :</strong><br>
                                             {{!empty($customer->shipping_name)?$customer->shipping_name:''}}<br>
                                             {{!empty($customer->shipping_phone)?$customer->shipping_phone:''}}<br>
                                             {{!empty($customer->shipping_address)?$customer->shipping_address:''}}<br>
                                             {{!empty($customer->shipping_zip)?$customer->shipping_zip:''}}<br>
                                             {{!empty($customer->shipping_city)?$customer->shipping_city:'' . ', '}} {{!empty($customer->shipping_state)?$customer->shipping_state:'' .', '}},{{!empty($customer->shipping_country)?$customer->shipping_country:''}}
                                         </small>
                                     </div>
                                 @endif
                                 <div class="col">
                                     <div class="float-end mt-3">
                                         {!! DNS2D::getBarcodeHTML(route('proposal.link.copy',\Illuminate\Support\Facades\Crypt::encrypt($proposal->id)), "QRCODE",2,2) !!}
                                     </div>
                                 </div>

                             </div>
                             <div class="row mt-3">
                                 <div class="col">
                                     <small>
                                         <strong>{{__('Status')}} :</strong><br>
                                         @if($proposal->status == 0)
                                             <span class="badge badge-pill badge-primary">{{ __(\App\Models\Proposal::$statues[$proposal->status]) }}</span>
                                         @elseif($proposal->status == 1)
                                             <span class="badge badge-pill badge-info">{{ __(\App\Models\Proposal::$statues[$proposal->status]) }}</span>
                                         @elseif($proposal->status == 2)
                                             <span class="badge badge-pill badge-success">{{ __(\App\Models\Proposal::$statues[$proposal->status]) }}</span>
                                         @elseif($proposal->status == 3)
                                             <span class="badge badge-pill badge-warning">{{ __(\App\Models\Proposal::$statues[$proposal->status]) }}</span>
                                         @elseif($proposal->status == 4)
                                             <span class="badge badge-pill badge-danger">{{ __(\App\Models\Proposal::$statues[$proposal->status]) }}</span>
                                         @endif
                                     </small>
                                 </div>

                                 <div class="row">
                                     <div class="col text-end">
                                         <div class="d-flex align-items-center justify-content-end">
                                             <div class="me-4">
                                                 <small>
                                                     <strong>{{__('Issue Date')}} :</strong><br>
                                                     {{$user->dateFormat($proposal->issue_date)}}<br><br>
                                                 </small>
                                             </div>
                                         </div>
                                     </div>
                                 </div>

                             @if(!empty($customFields) && count($proposal->customField)>0)
                                     @foreach($customFields as $field)
                                         <div class="col text-md-right">
                                             <small>
                                                 <strong>{{$field->name}} :</strong><br>
                                                 {{!empty($proposal->customField)?$proposal->customField[$field->id]:'-'}}
                                                 <br><br>
                                             </small>
                                         </div>
                                     @endforeach
                                 @endif
                             </div>
                             <div class="row mt-4">
                                 <div class="col-md-12">
                                     <div class="font-weight-bold">{{__('Product Summary')}}</div>
                                     <small>{{__('All items here cannot be deleted.')}}</small>
                                     <div class="table-responsive mt-2">
                                         <table class="table mb-0 table-striped">
                                             <tr>
                                                 <th class="text-dark" data-width="40">#</th>
                                                 <th class="text-dark">{{__('Product')}}</th>
                                                 <th class="text-dark">{{__('Quantity')}}</th>
                                                 <th class="text-dark">{{__('Rate')}}</th>
                                                 <th class="text-dark">{{__('Tax')}}</th>
                                                 <th class="text-dark"> {{__('Discount')}}</th>
                                                 <th class="text-dark">{{__('Description')}}</th>
                                                 <th class="text-end text-dark" width="12%">{{__('Price')}}<br>
                                                     <small class="text-danger font-weight-bold">{{__('after tax & discount')}}</small>
                                                 </th>
                                             </tr>
                                             @php
                                                 $totalQuantity=0;
                                                 $totalRate=0;
                                                 $totalTaxPrice=0;
                                                 $totalDiscount=0;
                                                 $taxesData=[];
                                            @endphp

                                            @foreach($iteams as $key =>$iteam)
                                                @if(!empty($iteam->tax))
                                                    @php
                                                        $taxes=\Utility::tax($iteam->tax);
                                                        $totalQuantity+=$iteam->quantity;
                                                        $totalRate+=$iteam->price;
                                                        $totalDiscount+=$iteam->discount;
                                                        foreach($taxes as $taxe){
                                                            $taxDataPrice=\Utility::taxRate($taxe->rate,$iteam->price,$iteam->quantity);
                                                            if (array_key_exists($taxe->name,$taxesData))
                                                            {
                                                                $taxesData[$taxe->name] = $taxesData[$taxe->name]+$taxDataPrice;
                                                            }
                                                            else
                                                            {
                                                                $taxesData[$taxe->name] = $taxDataPrice;
                                                            }
                                                        }
                                                    @endphp
                                                @endif
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{!empty($iteam->product)?$iteam->product->name:''}}</td>
                                                    <td>{{$iteam->quantity}}</td>
                                                    <td>{{$user->priceFormat($iteam->price)}}</td>
                                                    <td>
                                                        @if(!empty($iteam->tax))
                                                            <table>
                                                                @php $totalTaxRate = 0;@endphp
                                                                @foreach($taxes as $tax)
                                                                    @php
                                                                        $taxPrice=\Utility::taxRate($tax->rate,$iteam->price,$iteam->quantity);
                                                                        $totalTaxPrice+=$taxPrice;
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{$tax->name .' ('.$tax->rate .'%)'}}</td>
                                                                        <td>{{$user->priceFormat($taxPrice)}}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>{{$user->priceFormat($iteam->discount)}}</td>
                                                    <td>{{!empty($iteam->description)?$iteam->description:'-'}}</td>
                                                    <td class="text-end">{{$user->priceFormat(($iteam->price*$iteam->quantity))}}</td>
                                                </tr>
                                            @endforeach
                                            <tfoot>
                                            <tr>
                                                <td></td>
                                                <td><b>{{__('Total')}}</b></td>
                                                <td><b>{{$totalQuantity}}</b></td>
                                                <td><b>{{$user->priceFormat($totalRate)}}</b></td>
                                                <td><b>{{$user->priceFormat($totalTaxPrice)}}</b></td>
                                                <td><b>{{$user->priceFormat($totalDiscount)}}</b></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"></td>
                                                <td class="text-end"><b>{{__('Sub Total')}}</b></td>
                                                <td class="text-end">{{$user->priceFormat($proposal->getSubTotal())}}</td>
                                            </tr>
                                            <tr>
                                                    <td colspan="6"></td>
                                                    <td class="text-end"><b>{{__('Discount')}}</b></td>
                                                    <td class="text-end">{{$user->priceFormat($proposal->getTotalDiscount())}}</td>
                                                </tr>

                                            @if(!empty($taxesData))
                                                @foreach($taxesData as $taxName => $taxPrice)
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-end"><b>{{$taxName}}</b></td>
                                                        <td class="text-end">{{ $user->priceFormat($taxPrice) }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            <tr>
                                                <td colspan="6"></td>
                                                <td class="blue-text text-end"><b>{{__('Total')}}</b></td>
                                                <td class="blue-text text-end">{{$user->priceFormat($proposal->getTotal())}}</td>
                                            </tr>
                                            </tfoot>
                                        </table>
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

<footer id="footer-main">
    <div class="footer-dark">
        <div class="container">
            <div class="row align-items-center justify-content-md-between py-4 mt-4 delimiter-top">
                <div class="col-md-6">
                    <div class="copyright text-sm font-weight-bold text-center text-md-left">
                        {{!empty($companySettings['footer_text']) ? $companySettings['footer_text']->value : ''}}
                    </div>
                </div>
                <div class="col-md-6">
                    <ul class="nav justify-content-center justify-content-md-end mt-3 mt-md-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#" target="_blank">
                                <i class="fab fa-dribbble"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" target="_blank">
                                <i class="fab fa-github"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" target="_blank">
                                <i class="fab fa-facebook"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/dash.js') }}"></script>

<script src="{{ asset('assets/js/plugins/bootstrap-switch-button.min.js') }}"></script>

<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/simple-datatables.js') }}"></script>

<!-- Apex Chart -->
<script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/main.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/choices.min.js') }}"></script>


<script src="{{ asset('js/jscolor.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

@if($message = Session::get('success'))
    <script>
        show_toastr('success', '{!! $message !!}');
    </script>
@endif
@if($message = Session::get('error'))
    <script>
        show_toastr('error', '{!! $message !!}');
    </script>
@endif

@if($get_cookie['enable_cookie'] == 'on')
    @include('layouts.cookie_consent')
@endif





