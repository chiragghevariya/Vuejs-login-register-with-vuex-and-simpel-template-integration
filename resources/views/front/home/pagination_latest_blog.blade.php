@if(isset($blogList) && !$blogList->isEmpty())
 <div class="all-posts-area">
    <div class="section-heading style-2">
        @if(isset($searchKeyword) && $searchKeyword !="")
            <h4>Your search result for <span class="search-result">'{{$searchKeyword}}'</span></h4>
        @elseif(isset($routeDemo) && $routeDemo == true)
            <h4>Demo Post</h4>    
        @else
            <h4>Latest Post</h4>
        @endif
        <div class="line"></div>
    </div>
    @foreach($blogList as $key=>$blog)
        <div class="single-post-area mb-30">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6">
                    <a href="{{route('front.blog.details',$blog->slug)}}">
                        <div class="post-thumbnail">
                            <img style="height: 225px;width: 400px" src="{{ $blog->getBlogImageUrl()}}" alt="{{$blog->name}}">
                            <span class="video-duration"><i class="fa fa-eye" aria-hidden="true"></i> {{ thousandsCurrencyFormat($blog->total_visitor)}}</span>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="post-content mt-0">
                        @if(isset($blog->multipleBlogCategory) && !$blog->multipleBlogCategory->isEmpty())
                            @foreach($blog->multipleBlogCategory as $key2=>$v2)
                                @if(isset($v2->category) && $v2->category !=null)
                                    <a href="{{route('front.category.category_single',$v2->category->slug)}}" class="post-cata cata-sm" >{{$v2->category->name}}</a>
                                @endif
                            @endforeach
                        @endif
                        <a href="{{route('front.blog.details',$blog->slug)}}" class="post-title mb-2">{{$blog->name}}</a>
                        <p class="mb-2">{!! \Str::limit($blog->short_description, $limit = 225, $end = '...') !!}</p>
                        <div class="post-meta d-flex align-items-center mb-2">
                            <span>
                                <i class="fa fa-user"></i> {{$blog->createdBy->name}}
                               | <i class="fa fa-calendar"></i> {{ date('M-d-Y',strtotime($blog->created_at))}}
                                
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    @endforeach
    <div id="category_pagination_bottom">
        {!! $blogList->links() !!}
    </div>    
</div>
@endif