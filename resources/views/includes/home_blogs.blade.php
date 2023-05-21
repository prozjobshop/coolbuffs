<div class="userloginbox our_blog_container">
    <div class="container-fluid latest_blogs">

        <div class="section howitwrap our_blog_post">
        <!-- title start -->
        <div class="titleTop">
            <h3 class="w-100 custom_padding_latest_news_heading">Our Latest News</h3>
            <p class="text-left w-100 custom_padding_latest_news_heading">News is information about current events. This may be provided through many different media: word of mouth, printing, postal systems, broadcasting, electronic communication, or through the testimony of observers and witnesses to events.</p>
        </div>
        <!-- title end -->

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
                        <li class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
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
                                    <!-- {{$blog->content}} -->
                                    {!! \Illuminate\Support\Str::limit($blog->content, $limit = 400, $end = '...') !!}
                                </p>

                            </div>
                        </li>

                        
                        <?php $count++; ?>
                        @endforeach
                        @endif
        </ul>
      
    </div>
</div>