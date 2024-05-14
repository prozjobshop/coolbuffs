@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<!-- Inner Page Title start --> 
@include('includes.inner_page_title', ['page_title'=>__('Invoice Details')]) 
<!-- Inner Page Title end -->
<style>
    .pe-none{
        pointer-events:none;
    }
</style>
<div class="listpgWraper">
    <div class="container">
        @include('flash::message')
        <div class="row"> 
            @if(Auth::guard('company')->check())
            @include('includes.company_dashboard_menu')
            @else
            @include('includes.user_dashboard_menu')
            @endif
            <div class="col-md-9 col-sm-8">
                <div class="userccount">
                 {{-- <div class="row">
                    <div class="col-md-5">
                            <img src="https://proztec.datumcrm.com/sitesetting_images/thumb/jobs-portal-1659424761-460.png" alt="" />
                            <div class="strippckinfo">
                                <h5>{{__('Invoice Details')}}</h5>
                                <div class="pkginfo">{{__('Package')}}: <strong>{{ $package->package_title }}</strong></div>
                                <div class="pkginfo">{{__('Price')}}: <strong>${{ $package->package_price }}</strong></div>
                               <div class="pkginfo">{{__('Can apply on jobs')}}: <strong>{{ $package->package_num_listings }}</strong></div> 
                                <div class="pkginfo">{{__('Package Duration')}}: <strong>{{ $package->package_num_days }} {{__('Days')}}</strong></div>
                            </div>
                        </div> 
                    
                    </div>
                </div> --}}

                <div class="row">
                    <div class="col-md-6">
                        <img src="https://proztec.datumcrm.com/sitesetting_images/thumb/jobs-portal-1659424761-460.png" alt="">
                        <div class="strippckinfo">
                            <br>
                            <h4>Customer Details</h4>
                        <div class="pkginfo mt-4">Name: <strong>{{ $user->name }}</strong></div>
                        <div class="pkginfo">Email: <strong>{{ $user->email }}</strong></div>
                        <div class="pkginfo">Address: <strong>{{ $user->street_address }}</strong></div>
                        <div class="pkginfo d-none">Package Duration: <strong>30 Days</strong></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="strippckinfo">
                            <h3>Invoice Details</h3>
                            <h6 style="font-size: 14px">Congratulations you subscribed <strong style="color: red">{{ $package->package_title }}</strong></h6><strong style="color: red">
                            <div class="pkginfo mt-4">Package: <strong>{{ $package->package_title }}</strong></div>
                            <div class="pkginfo">Price: <strong>${{ $package->package_price }}</strong></div>
                            <div class="pkginfo">Can apply on jobs: <strong>{{ $package->package_num_listings }}</strong></div>
                            <div class="pkginfo">Package Duration: <strong>{{ $package->package_num_days }}</strong></div>
                            <div class="pkginfo">Transction ID: <strong>{{ $user->transaction }} </strong></div>

                            

                    
                        </strong></div><strong style="color: red">

                        </strong></div><strong style="color: red">
                       



                    </strong></div>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection
@push('styles')
<style type="text/css">
    .userccount p{ text-align:left !important;}
</style>
@endpush
@push('scripts') 
<script type="text/javascript" src="https://js.stripe.com/v2/"></script> 
<script type="text/javascript">
Stripe.setPublishableKey('{{Config::get('stripe.stripe_key')}}');
var $form = $('#stripe-form');
$form.submit(function (event) {
    $('#error_div').hide();
    $form.find('button').addClass('pe-none');
    $form.find('button').prop('disabled', true);
    Stripe.card.createToken({
        number: $('#card_no').val(),
        cvc: $('#cvvNumber').val(),
        exp_month: $('#ccExpiryMonth').val(),
        exp_year: $('#ccExpiryYear').val(),
        name: $('#card_name').val()
    }, stripeResponseHandler);
    return false;
});
function stripeResponseHandler(status, response) {
    if (response.error) {
        $('#error_div').show();
        $('#error_div').text(response.error.message);
        $form.find('button').prop('disabled', false);
    } else {
        var token = response.id;
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));
        // Submit the form:
        $form.get(0).submit();
    }
}
</script> 
@endpush