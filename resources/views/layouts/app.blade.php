<?php
// dd($countries);
if (!isset($seo)) {

    $seo = (object)array('seo_title' => $siteSetting->site_name, 'seo_description' => $siteSetting->site_name, 'seo_keywords' => $siteSetting->site_name, 'seo_other' => '');

}

?>

<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" class="{{ (session('localeDir', 'ltr'))}}" dir="{{ (session('localeDir', 'ltr'))}}">



<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{__($seo->seo_title) }}</title>

    <meta name="Description" content="{!! $seo->seo_description !!}">

    <meta name="Keywords" content="{!! $seo->seo_keywords !!}">

    {!! $seo->seo_other !!}

    <!-- Fav Icon -->

    <link rel="shortcut icon" href="{{asset('/')}}favicon.ico">

    <!-- Slider -->

    <link href="{{asset('/')}}js/revolution-slider/css/settings.css" rel="stylesheet">
    <!-- AJAX STYLING -->

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="../../css/search.css">

    <!-- Owl carousel -->

    <link href="{{asset('/')}}css/owl.carousel.css" rel="stylesheet">

    <!-- Bootstrap -->

    <link href="{{asset('/')}}css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->

    <link href="{{asset('/')}}css/font-awesome.css" rel="stylesheet">

    <!-- Custom Style -->

    <!-- <link href="{{asset('/')}}css/main.css" rel="stylesheet"> -->
    <link href="{{asset('/')}}css/main_customized.css" rel="stylesheet">

    <link href="{{asset('/')}}css/custom.css" rel="stylesheet">

    @if((session('localeDir', 'ltr') == 'rtl'))

    <!-- Rtl Style -->

    <link href="{{asset('/')}}css/rtl-style.css" rel="stylesheet">

    @endif

    <link href="{{ asset('/') }}admin_assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />

    <link href="{{ asset('/') }}admin_assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

    <link href="{{ asset('/') }}admin_assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="{{asset('/')}}css/media_queries_custom.css" rel="stylesheet">
    <link href="{{asset('/')}}css/countrySelect.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>

          <script src="{{asset('/')}}js/html5shiv.min.js"></script>

          <script src="{{asset('/')}}js/respond.min.js"></script>

        <![endif]-->

    @stack('styles')



    {!! $siteSetting->ganalytics !!}

    {!! $siteSetting->google_tag_manager_for_head !!}

        
</head>



<body>

    @yield('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/turbolinks/5.0.0/turbolinks.min.js" data-turbolinks-eval="false" data-turbo-eval="false"></script>
    <!-- Bootstrap's JavaScript -->

    <script src="{{asset('/')}}js/jquery.min.js"></script>

    <script src="{{asset('/')}}js/bootstrap.min.js"></script>

    <script src="{{asset('/')}}js/popper.js"></script>

    <!-- Owl carousel -->

    <script src="{{asset('/')}}js/owl.carousel.js"></script>

    <script src="{{ asset('/') }}admin_assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>

    <script src="{{ asset('/') }}admin_assets/global/plugins/Bootstrap-3-Typeahead/bootstrap3-typeahead.min.js" type="text/javascript"></script>

    <!-- END PAGE LEVEL PLUGINS -->

    <script src="{{ asset('/') }}admin_assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

    <script src="{{ asset('/') }}admin_assets/global/plugins/jquery.scrollTo.min.js" type="text/javascript"></script>

    <!-- Revolution Slider -->

    <script type="text/javascript" src="{{ asset('/') }}js/revolution-slider/js/jquery.themepunch.tools.min.js"></script>

    <script type="text/javascript" src="{{ asset('/') }}js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

    <!-- Bootstrap's JavaScript -->

    <script src="{{asset('/')}}js/typeahead/typeahead.bundle.js"></script>



    {!! NoCaptcha::renderJs() !!}

    @stack('scripts')

    <!-- Custom js -->
    <script src="{{asset('/')}}js/script.js"></script>
    <script src="{{asset('/')}}js/countrySelect.js"></script>

    <script type="text/JavaScript">
        var allCountries = $.each(
            [ 
                <?php
                    if(isset($country_details) && isset($countries) ) {
                        ?>
                        {
                            n: "All Countries",
                            i: "all",
                            d: "0",
                        },
                        <?php
                        foreach ($countries as $key => $country_name) {?>
                            {
                                n: "<?php echo $country_name;?>",
                                i: "<?php echo strtolower(@$country_details[$key-1]->sort_name);?>",
                                d: "<?php echo $key;?>",
                            },
                        <?php
                        }
                    }
                ?>
            ], function(i, c) {
                c.name = c.n;
                c.iso2 = c.i;
                delete c.n;
                delete c.i;
        });

        function select_country_id(idd) {
            document.getElementById("country_id").value = idd
        }
        $(document).ready(function(){
            $("#country_selector").countrySelect({
                // defaultCountry: "qa",
                // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
                // responsiveDropdown: true,
                // preferredCountries: ['qa']
            });

            $(document).scrollTo('.has-error', 2000);

            });

            function showProcessingForm(btn_id){		

            $("#"+btn_id).val( 'Processing .....' );

            $("#"+btn_id).attr('disabled','disabled');		

            }

		

		setInterval("hide_savedAlert()",7000);

        function hide_savedAlert(){

          $(document).find('.svjobalert').hide();

        }



        $(document).ready(function(){

            $.ajax({

                type: 'get',

                url: "{{route('check-time')}}",

                success: function(res) {

                        $('.notification').html(res);

                   

                }

            });

        });

        /**************Typeahead for Job Title****************/
		$(document).ready(function() {
            setTimeout(() => {
                    // ----------Type head for origion location----------//
                var list_airport_class = $('#job_page_typehead');
                var listAirport = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('airport_name'),
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
            
                    prefetch: {
                        url: "{{ url('filter-job-title') }}",
                        // cache: true, //depends on localstorage size
                    },
                    remote: {
                        url: "{{ url('filter-job-title') }}"+"/"+'%QUERY',
                        wildcard: '%QUERY',
                    },
                });
                
                list_airport_class.typeahead({
                    hint: true,
                    highlight: true
                },
                {
                    name: 'list_airport',
                    display: function (listAirport) {
                        return listAirport.title;
                    },
                    source: listAirport,
                    limit: 15,
                    templates: {
                        empty: [
                            '<div class="empty-message">',
                            'No record found',
                            '</div>'
                        ].join('\n'),
                        suggestion: function(data) {
                            return '<p>' + data.title +'</p>';
                        }
                    }
                });
                list_airport_class.bind('typeahead:select', function(ev, suggestion) {
                    // console.log(suggestion.title);
                    $('#jbsearch').val(suggestion.title);
                });
            }, 2000);
        });
        /**************Typeahead for Company Title****************/
		$(document).ready(function() {
            setTimeout(() => {
                    // ----------Type head for origion location----------//
                var list_airport_class = $('#company_page_typehead');
                var listAirport = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('airport_name'),
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
            
                    prefetch: {
                        url: "{{ url('filter-company-name') }}",
                        // cache: true, //depends on localstorage size
                    },
                    remote: {
                        url: "{{ url('filter-company-name') }}"+"/"+'%QUERY',
                        wildcard: '%QUERY',
                    },
                });
                
                list_airport_class.typeahead({
                    hint: true,
                    highlight: true
                },
                {
                    name: 'list_airport',
                    display: function (listAirport) {
                        return listAirport.name;
                    },
                    source: listAirport,
                    limit: 15,
                    templates: {
                        empty: [
                            '<div class="empty-message">',
                            'No record found',
                            '</div>'
                        ].join('\n'),
                        suggestion: function(data) {
                            return '<p>' + data.name +'</p>';
                        }
                    }
                });
                list_airport_class.bind('typeahead:select', function(ev, suggestion) {
                    // console.log(suggestion.name);
                    $('#jbsearch').val(suggestion.name);
                });
            }, 2000);
        });
        /**************Typeahead for Company Title****************/
		$(document).ready(function() {
            setTimeout(() => {
                    // ----------Type head for origion location----------//
                var list_airport_class = $('.typeahead.typeahead_user');
                var listTypeHead = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('airport_name'),
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
            
                    prefetch: {
                        url: "{{ url('filter-user-name') }}",
                        // cache: true, //depends on localstorage size
                    },
                    remote: {
                        url: "{{ url('filter-user-name') }}"+"/"+'%QUERY',
                        wildcard: '%QUERY',
                    },
                });
                
                list_airport_class.typeahead({
                    hint: true,
                    highlight: true
                },
                {
                    name: 'list_airport',
                    display: function (listTypeHead) {
                        return listTypeHead.first_name+' '+listTypeHead.last_name;
                    },
                    source: listTypeHead,
                    limit: 15,
                    templates: {
                        empty: [
                            '<div class="empty-message">',
                            'No record found',
                            '</div>'
                        ].join('\n'),
                        suggestion: function(data) {
                            return '<p>' + data.first_name+' '+ data.last_name +'</p>';
                        }
                    }
                });
                list_airport_class.bind('typeahead:select', function(ev, suggestion) {
                    // console.log(suggestion.first_name);
                    $('#jbsearch').val(suggestion.first_name+' '+suggestion.last_name);
                });
            }, 2000);
        });

    </script>

</body>



</html>