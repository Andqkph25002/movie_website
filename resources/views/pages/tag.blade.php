@extends('layout')
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs"><span><span><a href="">Phim theo tag</a> » <span class="breadcrumb_last" aria-current="page">{{ $tag }}</span></span></span></div>
             </div>
          </div>
       </div>
       <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
          <div class="ajax"></div>
       </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
       <section>
          <div class="section-bar clearfix">
             <h1 class="section-title"><span>Tag : {{ $tag }}</span></h1>
          </div>
          <div class="halim_box">

@foreach ($movie as $item)
    

             <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-27021">
                <div class="halim-item">
                   <a class="halim-thumb" href="{{ route('movie' , $item->slug) }}" title="{{ $item->title }}">
                      <figure><img class="lazy img-responsive" src="{{ asset($item->image) }}" alt="{{ $item->title }}" title="{{ $item->title }}"></figure>
                      <span class="status">@if ($item->resolution == 0)
                        HD
                    @elseif($item->resolution == 1)
                        SD
                    @elseif($item->resolution == 2)
                        HD Cam
                    @elseif($item->resolution == 3)
                       Full HD
                       @elseif($item->resolution == 4)
                       Trailer
                    @endif</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>   @if ($item->phude == 0)
                     Phụ đề
                    
                 @elseif($item->phude == 1)
                     Thuyết minh
                 @endif   @if ($item->season != 0)
                - Ss {{ $item->season }}
             @endif</span> 
                      <div class="icon_overlay"></div>
                      <div class="halim-post-title-box">
                         <div class="halim-post-title ">
                            <p class="entry-title">{{ $item->title }}</p>
                            <p class="original_title">{{ $item->english_title }}</p>
                         </div>
                      </div>
                   </a>
                </div>
             </article>
@endforeach
         
          </div>
          <div class="clearfix"></div>
          <div class="text-center">
             {{-- <ul class='page-numbers'>
                <li><span aria-current="page" class="page-numbers current">1</span></li>
                <li><a class="page-numbers" href="">2</a></li>
                <li><a class="page-numbers" href="">3</a></li>
                <li><span class="page-numbers dots">&hellip;</span></li>
                <li><a class="page-numbers" href="">55</a></li>
                <li><a class="next page-numbers" href=""><i class="hl-down-open rotate-right"></i></a></li>
             </ul> --}}
             {!! $movie->links("pagination::bootstrap-4") !!}
          </div>
       </section>
    </main>
    @include('pages.include.sidebar')
 </div>
@endsection
