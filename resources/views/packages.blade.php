@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')


<div class="pageTitle">  
  <div class="container">
      <div class="row">         
          <div class="col-md-3 col-sm-3">
              <h1 class="page-heading">Membership Plans</h1>
          </div>
       </div>
  </div> 
</div>

@php
    // Check if the user is authenticated
    $user = Auth::user();

    if ($user) {
        $package = $user->getPackage();

        // if ($package) {
        // If the user has a package, filter packages based on conditions
        //   $packages = App\Package::where('package_for', 'like', 'job_seeker')
        //     ->where('id', '<>', $package->id)
        //    ->where('package_price', '>=', $package->package_price)
        //    ->get();
        //}
    }

    // If the user is not authenticated or has no package, retrieve all packages for job seekers
    if (!isset($packages)) {
        $packages = App\Package::where('package_for', 'like', 'job_seeker')->get();
    }
    

@endphp
 

<div class="paypackages"> 
  <!---four-paln-->
  <div class="four-plan mb-4 mt-4">
      <h3>Our Packages</h3>
      <div class="row">
          @foreach($packages as $package)
          <div class="col-md-4 col-sm-6 col-xs-12">
              <ul class="boxes">
                  <li class="plan-name">{{$package->package_title}}</li>
                  <li>
                      <div class="main-plan">
                          <div class="plan-price1-1">$</div>
                          <div class="plan-price1-2">{{$package->package_price}}</div>
                          <div class="clearfix"></div>
                      </div>
                  </li>
                  <li class="plan-pages">{{__('Can apply on jobs')}} : Unlimited</li>
                  <!-- <li class="plan-pages">{{__('Can apply on jobs')}} : {{$package->package_num_listings}}</li> -->
                  <li class="plan-pages">{{__('Package Duration')}} : {{$package->package_num_days}} Days</li>
                  
                  @if($package->package_price > 0)
                      @if((bool)$siteSetting->is_paypal_active)
                      <li class="order paypal"><a href="{{route('order.package', $package->id)}}"> <i class="fa fa-cc-paypal" aria-hidden="true"></i> {{__('pay with paypal')}}</a></li>
                      @endif
                      @if((bool)$siteSetting->is_stripe_active)
                      <li class="order"><a href="{{route('stripe.order.form', [$package->id, 'new'])}}" data-turbolinks="false"><i class="fa fa-cc-stripe" aria-hidden="true"></i> {{__('pay with stripe')}}</a></li>
                      @endif   
                      @if((bool)$siteSetting->is_payu_active)
                     <li class="order payu"><a href="{{route('payu.order.package', ['package_id='.$package->id, 'type=new'])}}">{{__('pay with PayU')}}</a></li>
                  @endif                   
                  @else
                  <li class="order paypal"><a href="{{route('order.free.package', $package->id)}}">{{__('Subscribe Free Package')}}</a></li>
                  @endif
                  
              </ul>
          </div>
          @endforeach
      </div>
  </div>
  <!---end four-paln--> 
</div>

@endsection