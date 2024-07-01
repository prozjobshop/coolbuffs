@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end -->
<!-- Inner Page Title start -->
@include('includes.inner_page_title', ['page_title'=>__('Cvs Search Packages')])
<!-- Inner Page Title end -->
<?php $company = Auth::guard('company')->user(); ?>
<div class="listpgWraper">
    <div class="container">@include('flash::message')
        <div class="row"> @include('includes.company_dashboard_menu')
            <div class="col-md-9 col-sm-8">
                @if(null!==($success_package) && !empty($success_package))
                <div class="instoretxt">
                <div class="credit">{{__('Your Package is')}}: <strong>{{$success_package->package_title}} - {{ $siteSetting->default_currency_code }}{{$success_package->package_price}}</strong></div>
                <div class="credit">{{__('Package Duration')}} : <strong>{{Carbon\Carbon::parse($company->cvs_package_start_date)->format('d M, Y')}}</strong> - <strong>{{Carbon\Carbon::parse($company->cvs_package_end_date)->format('d M, Y')}}</strong></div>
                <div class="credit">{{__('Availed quota')}} : <strong>{{Auth::guard('company')->user()->availed_cvs_quota}}</strong> / <strong>{{Auth::guard('company')->user()->cvs_quota}}</strong></div>
                <!-- <div class="credit">{{__('Availed quota')}} : <strong>{{$company->availed_cvs_quota}}</strong> - <strong>{{$company->cvs_quota}}</strong></div> -->


            </div>
            @endif
                
                        <div class="paypackages">
    <!---four-paln-->
    <?php 
        $package = Auth::guard('company')->user()->cvs_getPackage();
     ?>
     @if(null!==($package))
       <div class="four-plan">
        <h3>{{__('Upgrade Package')}}</h3>
        <div class="row"> @foreach($packages as $package)
            <div class="col-md-4 col-sm-6 col-xs-12">
                <ul class="boxes">
                    <li class="icon"><i class="fa fa-paper-plane" aria-hidden="true"></i></li>
                    <li class="plan-name">{{$package->package_title}}</li>
                    <li>
                        <div class="main-plan">
                            <div class="plan-price1-1">$</div>
                            <div class="plan-price1-2">{{$package->package_price}}</div>
                            <div class="clearfix"></div>
                        </div>
                    </li>
                    @if($package->package_for=='cv_search')
                    <li class="plan-pages">{{__('Can search seekers')}} : {{$package->package_num_listings}}</li>
                    @else
                    <li class="plan-pages">{{__('Can post jobs')}} : {{$package->package_num_listings}}</li>
                    @endif

                    <li class="plan-pages">{{__('Package Duration')}} : {{$package->package_num_days}} {{__('Days')}}</li>
                    @if((bool)$siteSetting->is_paypal_active)
                    <li class="order paypal"><a href="{{route('order.upgrade.package', $package->id)}}"><i class="fa fa-cc-paypal" aria-hidden="true"></i> {{__('pay with paypal')}}</a></li>
                    @endif
                    @if((bool)$siteSetting->is_stripe_active)
                    <li class="order"><a href="{{route('stripe.order.form', [$package->id, 'upgrade'])}}"><i class="fa fa-cc-stripe" aria-hidden="true"></i> {{__('pay with stripe')}}</a></li>
                    @endif
                    @if((bool)$siteSetting->is_payu_active)
                       <li class="order payu"><a href="{{route('payu.order.cvsearch.package', ['package_id='.$package->id, 'type=upgrade'])}}">{{__('pay with PayU')}}</a></li>
                    @endif

                </ul>
            </div>
            @endforeach </div>
    </div>
     @else  
    <div class="four-plan">
        <h3>{{__('Our Cvs Search Packages')}}</h3>
        <div class="row"> @foreach($packages as $package)
            <div class="col-md-4 col-sm-6 col-xs-12">
                <ul class="boxes">
                    <li class="icon"><i class="fa fa-paper-plane" aria-hidden="true"></i></li>
                    <li class="plan-name">{{$package->package_title}}</li>
                    <li>
                        <div class="main-plan">
                            <div class="plan-price1-1">{{ $siteSetting->default_currency_code }}</div>
                            <div class="plan-price1-2">{{$package->package_price}}</div>
                            <div class="clearfix"></div>
                        </div>
                    </li>
                    @if($package->package_for == 'cv_search')
                    <li class="plan-pages">{{__('Can search seekers')}} : {{$package->package_num_listings}}</li>
                    @else
                    <li class="plan-pages">{{__('Can post jobs')}} : {{$package->package_num_listings}}</li>
                    @endif
                    <li class="plan-pages">{{__('Package Duration')}} : {{$package->package_num_days}} {{__('Days')}}</li>
                    @if($package->package_price > 0)
                    @if((bool)$siteSetting->is_paypal_active)
                    <li class="order paypal"><a href="{{route('order.package', $package->id)}}"><i class="fa fa-cc-paypal" aria-hidden="true"></i> {{__('pay with paypal')}}</a></li>
                    @endif
                    @if((bool)$siteSetting->is_stripe_active)
                    <li class="order"><a href="{{route('stripe.order.form', [$package->id, 'new'])}}"><i class="fa fa-cc-stripe" aria-hidden="true"></i> {{__('pay with stripe')}}</a></li>
                    @endif

                    @if((bool)$siteSetting->is_payu_active)
                       <li class="order payu"><a href="{{route('payu.order.cvsearch.package', ['package_id='.$package->id, 'type=new'])}}">{{__('pay with PayU')}}</a></li>
                    @endif

                    @else
                    <li class="order paypal"><a href="{{route('order.free.package', $package->id)}}"> {{__('Subscribe Free Package')}}</a></li>
                    @endif
                </ul>
            </div>
            @endforeach </div>
    </div>
    @endif
    <!---end four-paln-->
</div>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection
@push('scripts')
@include('includes.immediate_available_btn')
@endpush