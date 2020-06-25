@if(isset($popularSection) && !$popularSection->isEmpty())
<div id="divider"></div>
    <section class="trending-posts-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h4>Popular Post</h4>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($popularSection as $key=>$blog)
                    <div class="col-12 col-md-4">
                        <div class="single-post-area mb-80">
                            <a href="{{route('front.blog.details',$blog->slug)}}">
                                <div class="post-thumbnail">
                                    <img style="height: 225px; !important;width: 340px" src="{{$blog->getBlogImageUrl()}}" alt="{{$blog->name}}">
                                    <span class="video-duration"><i class="fa fa-eye" aria-hidden="true"></i> {{ thousandsCurrencyFormat($blog->total_visitor)}}</span>
                                </div>
                            </a>
                            <div class="post-content">
                                <a href="{{route('front.category.category_single',$blog->category->slug)}}" class="post-cata cata-sm">{{$blog->category->name}}</a>
                                <a href="{{route('front.blog.details',$blog->slug)}}" class="post-title">
                                    {!! \Str::limit($blog->name, $limit = 70, $end = '...') !!}
                                  </a>
                            </div>
                        </div>
                    </div>
                @endforeach    
            </div>
        </div>
    </section>
@endif
