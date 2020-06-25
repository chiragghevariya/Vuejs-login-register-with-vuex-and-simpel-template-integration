@extends('layouts.app')
@section('title')
    @if(isset($title) && $title !="")
        <title>{{$title}} - {{trans('lang_data.softtechover_com_label')}}</title>
    @else
        <title>{{trans('lang_data.welcome_to_softtechover_com')}}</title>
    @endif 
@endsection
@section('style')
<style>
    li.main_menu a {
        color: #17b4b8;
        
        margin-bottom: 5px;
    }
    li.sub_menu_site_map {
        margin-left: 13px;
        margin-bottom: 5px;
    }
    li.sub_menu_site_map a {
        margin-left: 13px;
        color: black !important;
        /*font-size: 15px;*/
    }
</style>
@endsection
@section('content')
<div class="vizew-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('front.home')}}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$cmsPageDetail->name}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container">
      <div class="col-12 col-sm-6 col-xl-3">
        <div class="footer-widget mb-70">
                <div class="single--twitter-slide">
                   <div class="td">
                    <?php 
                        $getAll = false;
                        $category = ALL_CATEGORY_LISTING($getAll);
                    ?>
                        <ul>
                            <li class="main_menu"><a href="{{route('front.home')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> &nbsp;Home</a></li>
                            @if(isset($category) && !$category->isEmpty())
                                <li class="main_menu"><a href="{{route('front.category.get_all_category')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> &nbsp;Categories</a>
                                    <ul>
                                        @foreach($category as $key=>$v)
                                        <li class="sub_menu_site_map"><a href="{{route('front.category.category_single',$v->slug)}}"><i class="fa fa-angle-right" aria-hidden="true"></i> &nbsp;{{$v->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                            @if(isset($cmsPages) && !$cmsPages->isEmpty())
                                @foreach($cmsPages as $key=>$v)
                                    @if($v->id != \App\Models\Cms::SITE_MAP_CONSTANT)
                                        <li class="main_menu"><a href="{{route('front.cms.details',$v->slug)}}"><i class="fa fa-angle-right" aria-hidden="true"></i> &nbsp;{{$v->name}}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
        </div>
    </div>
</div>
@include('layouts.flashmessage')
@endsection
@section('javascript')
@endsection
