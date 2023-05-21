@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end -->

<!-- Inner Page Title start -->

<div class="pageTitle">
    
    <div class="container">
        <div class="row">
            
            <div class="col-md-12 col-sm-12">
                <h1 class="page-heading">Our Latest News</h1>
                <p class="page_header_paragraph">News is information about current events. This may be provided through many different media: word of mouth, printing, postal systems, broadcasting, electronic communication, or through the testimony of observers and witnesses to events.</p>
            </div>
        </div>
    </div>
</div>

<!-- Inner Page Title end -->

<div class="listpgWraper">
<section id="blog-content">
    <div class="container">

        <!-- Blog start -->
        <div class="row">
            <div class="col-lg-9">
                <!-- Blog List start -->
                <div class="blogwrapper">
                    <ul class="jobslist row">
                       @if(null!==($blogs))
                                    <?php
                                    $count = 1;
                                    ?>
                                    @foreach($blogs as $blog)
                                    <?php
                                    $cate_ids = explode(",", $blog->cate_id);
                                    $data = DB::table('blog_categories')->whereIn('id', $cate_ids)->get();
                                    $cate_array = array();
                                    foreach ($data as $cat) {
                                        $cate_array[] = "<a href='" . url('/blog/category/') . "/" . $cat->slug . "'>$cat->heading</a>";
                                    }
                                    ?>
                                    <li class="col-lg-6 mt-0">
                                        <div class="bloginner">
                                            <div class="postimg">
                                                @if(null!==($blog->image) && $blog->image!="")

                                                <img src="{{asset('uploads/blogs/'.$blog->image)}}"
                                                    alt="{{$blog->heading}}" class="our_blog_main_image">
                                                @else
                                                <img src="{{asset('images/blog/1.jpg')}}"
                                                    alt="{{$blog->heading}}" class="our_blog_main_image">
                                                @endif
                                            </div>

                                            <div class="post-header">
                                                <h4><a href="{{route('blog-detail',$blog->slug)}}">{{$blog->heading}}</a></h4>
                                                <div class="postmeta">Category : {!!implode(', ',$cate_array)!!}
                                                </div>
                                            </div>
                                            <p class="blig_paragraph">
                                                {{$blog->content}}
                                                <!-- {!! \Illuminate\Support\Str::limit($blog->content, $limit = 150, $end = '...') !!} -->
                                            </p>

                                        </div>
                                    </li>

                                    
                                    <?php $count++; ?>
                                    @endforeach
                                    @endif
                    </ul>
                </div>

                <!-- Pagination -->
                <div class="pagiWrap">
                    <nav aria-label="Page navigation example">
                        @if(isset($blogs) && count($blogs))
                        {{ $blogs->appends(request()->query())->links() }} @endif
                    </nav>
                </div>
            </div>
			 <div class="col-lg-3">
				 
				 <div class="sidebar"> 
          <!-- Search -->
          <div class="widget">
            <h5 class="widget-title">Search</h5>
            <div class="search">
              <form action="{{route('blog-search')}}" method="GET">
                <input type="text" class="form-control" placeholder="Search" name="search">
                <button type="submit" class="btn"><i class="fa fa-search"></i></button>
              </form>
            </div>
          </div>
          <!-- Categories -->
          @if(null!==($categories))
          <div class="widget">
            <h5 class="widget-title">Categories</h5>
            <ul class="categories">
            @foreach($categories as $category)
              <li><a href="{{url('/blog/category/').'/'.$category->slug}}">{{$category->heading}}</a></li>
            @endforeach
            </ul>
          </div>
          @endif
        </div>
			</div>
        </div>
    </div>
</section>

</div>


@include('includes.footer')
@endsection
@push('styles')
<style>
.plus-minus-input {
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
}

.plus-minus-input .input-group-field {
    text-align: center;
    margin-left: 0.5rem;
    margin-right: 0.5rem;
    padding: 0rem;
}

.plus-minus-input .input-group-field::-webkit-inner-spin-button,
.plus-minus-input .input-group-field ::-webkit-outer-spin-button {
    -webkit-appearance: none;
    appearance: none;
}

.plus-minus-input .input-group-button .circle {
    border-radius: 50%;
    padding: 0.25em 0.8em;
}
</style>
@endpush
@push('scripts')
@include('includes.immediate_available_btn')
<script>
</script>
@endpush