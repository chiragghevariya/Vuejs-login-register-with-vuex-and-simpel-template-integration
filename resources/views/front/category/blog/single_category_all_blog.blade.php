@extends('layouts.app')
@section('title')
    @if(isset($title) && $title !="")
        <title>{{$title}} - {{trans('lang_data.softtechover_com_label')}}</title>
    @else
        <title>{{trans('lang_data.welcome_to_softtechover_com')}}</title>
    @endif 
@endsection
@section('content')
<div id="divider"></div>
<section class="vizew-post-area mb-50">
    <div class="container">
      <div id="all_blog_single_category"></div>
    </div>
</section>
@endsection
@section('javascript')
<script>
$(document).ready(function(){
    fetch_data(1);
    $(document).on('click', '.pagination a', function(event){
      event.preventDefault(); 
      var page = $(this).attr('href').split('page=')[1];
      fetch_data(page);
      $('html, body').animate({scrollTop:50}, 'slow');
        
    });

    function fetch_data(page)
    {   
      var categorySlug = "{{$categorySlug}}";
      $.ajax({
       url:"{{route('front.category.single_pagination_all_blog')}}?page="+page,
       data:{"_token": "{{ csrf_token() }}",categorySlug:categorySlug},
       success:function(data)
       {
        $('#all_blog_single_category').html(data);
       }
      });
    }
});

</script>
@endsection
