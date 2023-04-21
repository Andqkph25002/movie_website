@extends('layout')
@section('content')
    

<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs"><span><span><a href="{{ route('category' , [$movie->category->slug]) }}">{{ $movie->category->title }}</a> » <span><a href="{{ route('country' , [$movie->country->slug]) }}">{{ $movie->country->title }}</a> » <span class="breadcrumb_last" aria-current="page">{{ $movie->title }}</span></span></span></span></div>
             </div>
          </div>
       </div>
       <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
          <div class="ajax"></div>
       </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
       <section id="content" class="test">
          <div class="clearfix wrap-content">
            
             <div class="halim-movie-wrapper">
                <div class="title-block">
                   <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                      <div class="halim-pulse-ring"></div>
                   </div>
                   <div class="title-wrapper" style="font-weight: bold;">
                      Bookmark
                   </div>
                </div>
                <div class="movie_info col-xs-12">
                   <div class="movie-poster col-md-3">
                      <img class="movie-thumb" src="{{ asset($movie->image) }}" alt="{{ $movie->title }}">
                      @if ($movie->resolution != 4)
                      @if ($episode_current_list_count > 0)
                      <div class="bwa-content">
                        <div class="loader"></div>
                        <a href="{{ url('/xem-phim/'.$movie->slug.'/tap-' . $episode_tapdau->episode) }}" class="bwac-btn">
                           {{-- {{ route('watch' , ['slug' => $movie->slug , 'episode' => $episode_tapdau->episode]) }} --}}
                        <i class="fa fa-play"></i>
                        </a>
                     </div>
                      @endif
                    
                     @else
                     <a href="#watch_trailer" style="display:block" class="btn btn-primary ">Xem trailer</a>
                      @endif
                      
                   </div>
                   <div class="film-poster col-md-9">
                      <h1 class="movie-title title-1" style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">{{ $movie->title }}</h1>
                      <h2 class="movie-title title-2" style="font-size: 12px;">{{ $movie->title }}</h2>
                      <ul class="list-info-group">
                         <li class="list-info-group-item"><span>Trạng Thái</span> : <span class="quality"> @if ($movie->resolution == 0)
                           HD
                       @elseif($movie->resolution == 1)
                           SD
                       @elseif($movie->resolution == 2)
                           HD Cam
                 
                       @elseif($movie->resolution == 3)
                       FULL HD
                       @elseif($movie->resolution == 4)
                       Trailer
                       @endif
                     </span>
                       
                       @if ($movie->resolution != 4)
                       <span class="episode">
                        @if ($movie->phude == 0)
                       Phụ đề
                   @elseif($movie->phude == 1)
                       Thuyết minh
                   @endif</span>
                       @endif
                       </li>
                         <li class="list-info-group-item"><span>Điểm IMDb</span> : <span class="imdb">7.2</span></li>
                         <li class="list-info-group-item"><span>Thời lượng</span> : {{ $movie->thoi_luong }} phút</li>
                         @if ($movie->season != 0)
                         <li class="list-info-group-item"><span>Season</span> : {{ $movie->season }}  </li>
                         @endif
                       @if ($movie->episode >= 1)
                       <li class="list-info-group-item"><span>Episode</span> : 
                        @if ($movie->thuocphim == 'phimbo')
                        {{ $episode_current_list_count }}/{{ $movie->episode }} - 
                        @if ($episode_current_list_count == $movie->episode)
                            Hoàn thành
                           @else
                           Đang cập nhật
                        @endif
                        @else
                          Phim lẻ
                        @endif
                        </li>
                       @endif

                       @if ($movie->thuocphim == 'phimbo')
                       <li class="list-info-group-item"><span>Tập phim mới nhất</span> : 
                        @foreach ($episode as $item)
                        <a href="{{ url('/xem-phim/'.$movie->slug.'/tap-' . $item->episode) }}" rel="tag">{{ $item->episode }}</a>
                        @endforeach
                        
                        </li>
                       @endif
                       
                         <li class="list-info-group-item"><span>Thể loại</span> :
                            @foreach ($movie->movie_genre as $item)
                                 <a href="{{ route('genre' , $item->slug) }}"> {{ $item->title }}</a>
                            @endforeach
                           </li>
                         <li class="list-info-group-item"><span>Danh mục </span> : <a href="{{ route('category' , [$movie->category->slug]) }}" rel="category tag">{{ $movie->genre->title }}</a></li>
                         <li class="list-info-group-item"><span>Quốc gia</span> : <a href="{{ route('country' , [$movie->country->slug]) }}" rel="tag">{{ $movie->country->title }}</a></li>
                         <li class="list-info-group-item"><span>Đạo diễn</span> : <a class="director" rel="nofollow" href="https://phimhay.co/dao-dien/cate-shortland" title="Cate Shortland">Cate Shortland</a></li>
                         <li class="list-info-group-item last-item" style="-overflow: hidden;-display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-flex: 1;-webkit-box-orient: vertical;"><span>Diễn viên</span> : <a href="" rel="nofollow" title="C.C. Smiff">C.C. Smiff</a>, <a href="" rel="nofollow" title="David Harbour">David Harbour</a>, <a href="" rel="nofollow" title="Erin Jameson">Erin Jameson</a>, <a href="" rel="nofollow" title="Ever Anderson">Ever Anderson</a>, <a href="" rel="nofollow" title="Florence Pugh">Florence Pugh</a>, <a href="" rel="nofollow" title="Lewis Young">Lewis Young</a>, <a href="" rel="nofollow" title="Liani Samuel">Liani Samuel</a>, <a href="" rel="nofollow" title="Michelle Lee">Michelle Lee</a>, <a href="" rel="nofollow" title="Nanna Blondell">Nanna Blondell</a>, <a href="" rel="nofollow" title="O-T Fagbenle">O-T Fagbenle</a></li>
                      </ul>
                      <div class="movie-trailer hidden"></div>
                   </div>
                </div>
             </div>
             <div class="clearfix"></div>
             <div id="halim_trailer"></div>
             <div class="clearfix"></div>
             <div class="section-bar clearfix">
                <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
             </div>
             <div class="entry-content htmlwrap clearfix">
                <div class="video-item halim-entry-box">
                   <article id="post-38424" class="item-content">
                     
                      <p>{{ $movie->description }}</p>
                      
                   </article>
                </div>
             </div>
             <div class="clearfix"></div>
             <div class="section-bar clearfix">
                <h2 class="section-title"><span style="color:#ffed4d">Tags</span></h2>
             </div>
             <div class="entry-content htmlwrap clearfix">
                <div class="video-item halim-entry-box">
                   <article id="post-38424" class="item-content">
                     @if ($movie->tags != NULL)
                         
                    
                     @php
                         $tags = [];
                         $tags = explode(',' , $movie->tags);
                  
                     @endphp
                     @foreach ($tags as $key =>  $tag)
                         <a href="{{ route('movie.tag' , $tag) }}">{{ $tag }}</a>
                     @endforeach

                     @else
                     {{ $movie->title }}
                     @endif
                      
                   </article>
                </div>
             </div>
             <div class="clearfix"></div>
             <div class="section-bar clearfix">
                <h2 class="section-title"><span style="color:#ffed4d">Trailer</span></h2>
             </div>
             <div class="entry-content htmlwrap clearfix">
               <div class="video-item halim-entry-box" id="watch_trailer">
                  <article id="post-38424" class="item-content">
                     <iframe width="100%" height="400" src="https://www.youtube.com/embed/{{ $movie->trailer }}"
                      title="YouTube video player" frameborder="0"
                       allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                  </article>
               </div>
            </div>
            <div class="clearfix"></div>
             <div class="section-bar clearfix">
                <h2 class="section-title"><span style="color:#ffed4d">Bình luận</span></h2>
             </div>
             <div class="entry-content htmlwrap clearfix">
               <div class="video-item halim-entry-box" id="watch_trailer">
                  @php
                      $url_movie = Request::url();
                  
                  @endphp
                  <article id="post-38424" class="item-content">
                     <div class="fb-comments" data-href="{{ $url_movie }}"
                      data-width="100%" data-numposts="20"></div>
                  </article>
               </div>
            </div>
          </div>
       </section>
       <section class="related-movies">
          <div id="halim_related_movies-2xx" class="wrap-slider">
             <div class="section-bar clearfix">
                <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
             </div>
             <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
               @foreach ($movie_related as $item)
                   
               
                <article class="thumb grid-item post-38498">
                   <div class="halim-item">
                      <a class="halim-thumb" href="" title="{{ $item->title }}">
                         <figure><img class="lazy img-responsive" src="{{ asset($item->image) }}" alt="{{ $item->title }}" title="{{ $item->title }}"></figure>
                         <span class="status">HD</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>Vietsub</span> 
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
             <script>
                jQuery(document).ready(function($) {				
                var owl = $('#halim_related_movies-2');
                owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 4}}})});
             </script>
          </div>
       </section>
    </main>
    @include('pages.include.sidebar')
 </div>

 @endsection