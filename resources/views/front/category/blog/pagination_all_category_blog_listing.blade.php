<div class="vizew-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('front.home')}}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$categoryDetail->name}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-7 col-lg-8">
        @if(isset($blogDataCategoryWise) && !$blogDataCategoryWise->isEmpty())
            <div class="all-posts-area">
                @foreach($blogDataCategoryWise as $key=>$blog)
                    <div class="single-post-area mb-30">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-6">
                                <a  href="{{route('front.blog.details',$blog->slug)}}">
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
                                    <p class="mb-2">{!! \Str::limit($blog->short_description, $limit = 150, $end = '...') !!}</p>
                                    <div class="post-meta d-flex align-items-center mb-2">
                                        <span>
                                            <i class="fa fa-user"></i> <strong>{{$blog->createdBy->name}}</strong>
                                           | <i class="fa fa-calendar"></i> <strong>{{ date('M-d-Y',strtotime($blog->created_at))}}
                                            </strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
                <div id="category_pagination_bottom">
                    {!! $blogDataCategoryWise->links() !!}
                </div>    
            </div>
        @endif
    </div>
    <div class="col-12 col-md-5 col-lg-4">
        @if(isset($popularPost) && !$popularPost->isEmpty())
          <div class="single-widget youtube-channel-widget mb-50">
              <div class="section-heading style-2 mb-30">
                  <h4>Popular Posts</h4>
                  <div class="line"></div>
              </div>
              <div class="single-youtube-channel d-flex align-items-center">
                <ul class="recent_post_detail">
              @foreach($popularPost as $key=>$c)
                <li><a href="{{route('front.blog.details',$c->slug)}}" class="channel-title"><i class="fa fa-hand-o-right" style="font-size: 23px" aria-hidden="true"></i> {{$c->name}}</a></li>
              @endforeach    
                </ul>
              </div>
          </div>
        @endif
        @if(isset($categoryListing) && !$categoryListing->isEmpty())
          <div class="single-widget youtube-channel-widget mb-50">
              <div class="section-heading style-2 mb-30">
                  <h4>Categories</h4>
                  <div class="line"></div>
              </div>
              <div class="single-youtube-channel d-flex align-items-center">
                <ul>
              @foreach($categoryListing as $key=>$c)
                  <li><a href="{{route('front.category.category_single',$c->slug)}}" class="channel-title">{{$c->name}} <span>{{$c->multiple_category_status_count}}</span></a></li>
              @endforeach    
                </ul>
              </div>
          </div>
        @endif
        @if(isset($topSectionHighLight) && !$topSectionHighLight->isEmpty())
          <div class="single-widget youtube-channel-widget mb-50">
              <div class="section-heading style-2 mb-30">
                  <h4>Latest Posts</h4>
                  <div class="line"></div>
              </div>
              <div class="single-youtube-channel d-flex align-items-center">
                <ul class="recent_post_detail">
              @foreach($topSectionHighLight as $key=>$c)
                <li><a href="{{route('front.blog.details',$c->slug)}}" class="channel-title"><i class="fa fa-hand-o-right" style="font-size: 23px" aria-hidden="true"></i> {{$c->name}}</a></li>
              @endforeach    
                </ul>
              </div>
          </div>
        @endif
    </div>
</div>
<hr>
 <div class="row">
    <div class="col-12 col-md-7 col-lg-8">
        <div class="vizew-post-author d-flex align-items-center" id="p_index">
          <div class="post-author-thumb">
              <img src="{{$settingData->getsettineAuthorImgDynamic()}}" alt="{{ $settingData->author_name ? $settingData->author_name : ''}}">
          </div>
          <div class="post-author-desc pl-4">
              <a href="javascript:void(0)" class="author-name">{{ $settingData->author_name ? $settingData->author_name : ""}}</a>
              <p>{{ $settingData->author_description_two ? $settingData->author_description_two : ""}}</p>
              <div class="post-author-social-info">
                  @if(isset($socialMediaContent) && !$socialMediaContent->isEmpty())
                      @foreach($socialMediaContent as $key=>$s)
                          <a target="_blank" href="{{$s->url}}"><i class="fa {{$s->font_awesome}}"></i></a>
                      @endforeach
                  @endif
              </div>
          </div>
        </div>
    </div>
</div>        