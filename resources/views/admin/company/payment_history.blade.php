@extends('admin.layouts.admin_layout')

@section('content')

<style type="text/css">

    .table td, .table th {

        font-size: 12px;

        line-height: 2.42857 !important;

    }	

</style>

<div class="page-content-wrapper"> 

    <!-- BEGIN CONTENT BODY -->

    <div class="page-content"> 

        <!-- BEGIN PAGE HEADER--> 

        <!-- BEGIN PAGE BAR -->

        <div class="page-bar">

            <ul class="page-breadcrumb">

                <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>

                <li> <span>Payment History</span> </li>

            </ul>

        </div>

        <!-- END PAGE BAR --> 

        <!-- BEGIN PAGE TITLE-->

        <h3 class="page-title">Manage Companies <small>Payment History</small> </h3>

        <!-- END PAGE TITLE--> 

        <!-- END PAGE HEADER-->

        <div class="row">

            <div class="col-md-12"> 

                <!-- Begin: life time stats -->

                <div class="portlet light portlet-fit portlet-datatable bordered">

                    <div class="portlet-title">

                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Payment History</span> </div>

                        

                    </div>

                    <div class="portlet-body">

                        <div class="table-container">

                            <form method="post" role="form" id="datatable-search-form">

                                <table class="table table-striped table-bordered table-hover"  id="companyDatatableAjax">

                                    <thead>

                                        <tr role="row" class="filter">

                                            <td><input type="text" class="form-control" name="name" id="name" autocomplete="off" placeholder="Company Name"></td>

                                            <td>{!! Form::select('package', [''=>'Select Package']+$packages, null, array('class'=>'form-control', 'id'=>'package', 'required'=>'required')) !!}</td>

                                            <td></td>

                                            <td></td>

                                            <td></td>

                                        </tr>

                                        <tr role="row" class="heading">

                                            <th>Name</th>

                                            <th>Package Title</th>

                                            <th>Payment Method</th>

                                            <th>Package Start Date</th>

                                            <th>Package End Date</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                    </tbody>

                                </table>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- END CONTENT BODY --> 

</div>

@endsection

@push('scripts') 

<script>

    $(function () {

        var oTable = $('#companyDatatableAjax').DataTable({

            processing: true,

            serverSide: true,

            stateSave: true,

            searching: false,

            /*		

             "order": [[1, "asc"]],            

             paging: true,

             info: true,

             */

            ajax: {

                url: '{!! route('fetch.data.companiesHistory') !!}',

                data: function (d) {

                    d.name = $('#name').val();

                    d.package = $('#package').val();

                }

            }, columns: [

                {data: 'name', name: 'name'},

                {data: 'package', name: 'package'},

                {data: 'payment_method', name: 'payment_method'},

                {data: 'package_start_date', name: 'package_start_date'},

                {data: 'package_end_date', name: 'package_end_date'}

            ]

        });

        $('#datatable-search-form').on('submit', function (e) {

            oTable.draw();

            e.preventDefault();

        });

        $('#name').on('keyup', function (e) {

            oTable.draw();

            e.preventDefault();

        });

        $('#email').on('keyup', function (e) {

            oTable.draw();

            e.preventDefault();

        });

        $('#package').on('change', function (e) {

            oTable.draw();

            e.preventDefault();

        });

        $('#is_featured').on('change', function (e) {

            oTable.draw();

            e.preventDefault();

        });

    });

    function deleteCompany(id) {

        var msg = 'Are you sure?';

        if (confirm(msg)) {

            $.post("{{ route('delete.company') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})

                    .done(function (response) {

                        if (response == 'ok')

                        {

                            var table = $('#companyDatatableAjax').DataTable();

                            table.row('companyDtRow' + id).remove().draw(false);

                        } else

                        {

                            alert('Request Failed!');

                        }

                    });

        }

    }

    function makeActive(id) {

        $.post("{{ route('make.active.company') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})

                .done(function (response) {

                    if (response == 'ok')

                    {

                        var table = $('#companyDatatableAjax').DataTable();

                        table.row('companyDtRow' + id).remove().draw(false);

                    } else

                    {

                        alert('Request Failed!');

                    }

                });

    }

    function makeNotActive(id) {

        $.post("{{ route('make.not.active.company') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})

                .done(function (response) {

                    if (response == 'ok')

                    {

                        var table = $('#companyDatatableAjax').DataTable();

                        table.row('companyDtRow' + id).remove().draw(false);

                    } else

                    {

                        alert('Request Failed!');

                    }

                });

    }

    function makeFeatured(id) {

        $.post("{{ route('make.featured.company') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})

                .done(function (response) {

                    if (response == 'ok')

                    {

                        var table = $('#companyDatatableAjax').DataTable();

                        table.row('companyDtRow' + id).remove().draw(false);

                    } else

                    {

                        alert('Request Failed!');

                    }

                });

    }

    function makeNotFeatured(id) {

        $.post("{{ route('make.not.featured.company') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})

                .done(function (response) {

                    if (response == 'ok')

                    {

                        var table = $('#companyDatatableAjax').DataTable();

                        table.row('companyDtRow' + id).remove().draw(false);

                    } else

                    {

                        alert('Request Failed!');

                    }

                });

    }

</script> 

@endpush