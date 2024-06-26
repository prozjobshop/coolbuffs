<div class="pageTitle">
    
    <div class="container">
        <div class="row">
            
            <div class="col-md-3 col-sm-3">
                <h1 class="page-heading">{{$page_title}}</h1>
            </div>

            @if(@$page_title == 'Job Seekers' || $page_title == 'Dashboard')
            <div class="col-md-9 col-sm-9">
                @if(Auth::guard('company')->check())
                <form action="{{route('job.seeker.list')}}" method="get">
                    <div class="searchform row custom_top_margin_second_header">
                        <div class="col-lg-9">
                            <input type="text" name="search" value="{{Request::get('search', '')}}" class="form-control functional_find" placeholder="{{__('Search Role...')}}" />
                        </div>

                        <div class="col-lg-3">
                            <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i> {{__('Search')}}</button>
                        </div>
                    </div>
                </form>
                @else
                <form action="{{route('company.listing')}}" method="get">
                    <div class="searchform row custom_top_margin_second_header">
                        <div class="col-lg-9">
                            <input type="text" name="search" value="{{Request::get('search', '')}}" class="form-control typeahead typeahead_company" placeholder="{{__('Enter Skills, job title or Location')}}" />
                        </div>

                        <div class="col-lg-3">
                            <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i> {{__('Search Jobs')}}</button>
                        </div>
                    </div>
                </form>
                @endif
            </div>
            @endif
        </div>
    </div>
    
</div>