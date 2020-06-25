@extends('layouts.app')
@section('title')
    @if(isset($title) && $title !="")
        <title>{{$title}} - {{trans('lang_data.softtechover_com_label')}}</title>
    @else
        <title>{{trans('lang_data.welcome_to_softtechover_com')}}</title>
    @endif 
@endsection
@section('metaData')
    <meta property="og:description" content="{{$getBlogDetail->seo_description}}" />
    <meta property="og:url" content="{{\URL::current()}}" />
    <meta property="og:title" content="{{$getBlogDetail->seo_title}}" />
    <meta property="og:image:url" content="{{$getBlogDetail->getBlogImageUrl()}}" />
    <meta name="title" content="{{$getBlogDetail->seo_title}}"/>
    <meta name="description" content="{{$getBlogDetail->seo_description}}"/>
    <meta name="keywords" content="{{$getBlogDetail->seo_keyword}}"/>
    <link rel="canonical" href="{{\URL::current()}}" />
@endsection
@section('content')
<div id="divider"></div>

<div class="container">
     <div class="row justify-content-center">
        <div class="col-12">
            <div class="post-details-content">
                <div class="blog-content">
                    <div class="post-content mt-0">
                        <h1>{{$getBlogDetail->name}}</h1>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="post-details-area mb-80">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-xs-12">    
                <div class="row">
                    <div class="col-12">
                        <div class="post-details-thumb mb-50">
                            <div class="d-flex justify-content-between mb-30">
                                <div class="post-meta align-items-center">
                                    <a href="#" class="post-author"> <i class="fa fa-user"></i> {{$getBlogDetail->createdBy->name}} </a><a href="#" class="post-date"><i class="fa fa-calendar"></i> {{date('M-d-Y',strtotime($getBlogDetail->created_at))}} </a>
                                    <a href="#"><i class="fa fa-eye"></i> {{ thousandsCurrencyFormat($getBlogDetail->total_visitor)}} </a>
                                    @if(!$getBlogDetail->multipleBlogCategory->isEmpty())
                                      <div id="category_detail">
                                          Category: 
                                          @foreach($getBlogDetail->multipleBlogCategory as $key=>$v )
                                          <a href="{{route('front.category.category_single',$v->category->slug)}}" class="post-cata cata-sm">{{$v->category->name}}</a>
                                          @endforeach
                                      </div>
                                    @endif
                                </div>
                            </div>
                            <img src="{{$getBlogDetail->getBlogImageUrl()}}" alt="{{$getBlogDetail->name}}">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="post-details-content">
                            <div class="blog-content">

                               {!! $getBlogDetail->short_description !!}

                               {!! $getBlogDetail->long_description !!}
                               @if($getBlogDetail->is_demo == 1 && $getBlogDetail->demo_url !="")   
                                  <div class="soft-demo">
                                    <center>
                                      <a href="{{$getBlogDetail->demo_url}}" target="_blank"><button class="btn btn-primary"><strong>View Demo</strong></button></a>
                                    </center>
                                  </div>
                               @endif

                                <div class="vizew-post-author d-flex align-items-center" id="p_index">
                                    <div class="post-author-thumb">
                                        <img src="{{$settingData->getsettineAuthorImgDynamic()}}" alt="{{ $settingData->author_name ? $settingData->author_name : ''}}">
                                    </div>
                                    <div class="post-author-desc pl-4">
                                        <a href="javascript:void(0)" class="author-name">{{ $settingData->author_name ? $settingData->author_name : ''}}</a>
                                        <p>{{ $settingData->author_description_one ? $settingData->author_description_one : ""}}</p>
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
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12">
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


<script async src="https://platform-api.sharethis.com/js/sharethis.js#property=5ece7228606f5b0012eb58ed&product=sticky-share-buttons"></script>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId=496195211181651&autoLogAppEvents=1">
</script>
<?php  
    $url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
?>

<div class="fb-comments" data-href="{{$url}}" data-width="100%" data-numposts="5">
</div>
</section>
@endsection
@section('javascript')
<link rel="stylesheet" href="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/css/prism.css">
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/js/prism.js"></script>
<script>
  var blog_id = "{{\Crypt::encrypt($getBlogDetail->id)}}";
  $.ajax({
      type: 'post',
      url: '{{route("front.blog.total_view_count")}}',
      data: {
       "_token": "{{ csrf_token() }}",blog_id:blog_id,
      },
      success: function (response) {

      }
  });
</script>
@endsection
