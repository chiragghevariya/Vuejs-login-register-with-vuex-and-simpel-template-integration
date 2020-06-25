@extends('layouts.app')
@section('title')
    @if(isset($title) && $title !="")
        <title>{{$title}} - {{trans('lang_data.softtechover_com_label')}}</title>
    @else
        <title>{{trans('lang_data.welcome_to_softtechover_com')}}</title>
    @endif 
@endsection
@section('style')
<link href="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/img/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
@endsection
@section('content')
<div id="divider"></div>
<section class="vizew-post-area mb-50">
    <div class="container">
        <section id="portfolio" class="portfolio">
      <div class="container" data-aos="fade-up">
        
        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">Portfolio</li>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
          @if(isset($portfolio) && !$portfolio->isEmpty())
            @foreach($portfolio as $key=>$value)
                <div class="col-lg-6 col-md-6 portfolio-item filter-card">
                  <div class="portfolio-wrap">
                    <img src="{{$value->getPortfolioImageUrl()}}" class="img-fluid" alt="">
                    <div class="portfolio-info">
                      <div class="centerclass">
                        <h4>{{$value->title}}</h4>
                        @if($value->long_description)
                          <div class="detail_portfolio" id="showHide_{{$key}}" style="display:none">{!! $value->long_description !!}</div>
                        @endif
                        <div class="portfolio-links">
                          <a href="javascript:void(0)" class="plusIconClick" data-key="{{$key}}" data-gall="portfolioGallery" class="venobox" title="{{$value->title}}"><i class="bx bx-plus"></i></a>
                          @if(!empty($value->url))
                            <a target="_blank" href="{{$value->url}}" data-gall="portfolioDetailsGallery" data-vbtype="iframe" class="venobox" title="{{$value->title}} Website"><i class="bx bx-link"></i></a>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach  
          @endif
        </div>
      </div>
    </section>
    </div>
</section>
@endsection
@section('javascript')
<script>
  $(document).ready(function(){

    $(document).on("click",".plusIconClick",function(){
            
        var idAtt = $(this).attr("data-key");
        if ($("#showHide_"+idAtt).is(":hidden")) {
          
          $("#showHide_"+idAtt).show('slow');

        }else{

          $("#showHide_"+idAtt).hide('slow');
        }
    })

  })  
</script>

@endsection
