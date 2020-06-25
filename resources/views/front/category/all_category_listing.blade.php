@extends('layouts.app')
@section('title')
    @if(isset($title) && $title !="")
        <title>{{$title}} - {{trans('lang_data.softtechover_com_label')}}</title>
    @else
        <title>{{trans('lang_data.welcome_to_softtechover_com')}}</title>
    @endif 
@endsection
@section('content')
<div class="vizew-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-12">
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
            </div>
        </div>
    </div>
</div>


@endsection
@section('javascript')
@endsection
