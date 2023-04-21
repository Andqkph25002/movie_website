@extends('layout')
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs"><span><span><a href="">{{ $cate_slug->title }}</a> » <span class="breadcrumb_last" aria-current="page">2021</span></span></span></div>
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
             <h1 class="section-title"><span>{{ $cate_slug->title }}</span></h1>
          </div>
          <div class="section-bar clearfix">
              <div class="row">
              <form action="{{ route('filter.movie') }}" method="GET">
           
               <div class="col-md-2">
                  <div class="form-group">
                     <select name="order" id="" class="form-control">
                          <option value="">Sắp xếp</option>
                          <option value="date">Ngày đăng</option>
                          <option value="year_release">Năm sản xuất</option>
                          <option value="name_a_z">Tên phim</option>
                          <option value="watch_view">Lượt xem</option>
                     </select>
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="form-group">
                     <select name="genre" id="" class="form-control">
                        <option value="">Thể loại</option>
                        @foreach ($genre as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                        @endforeach
                          
                     </select>
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="form-group">
                     <select name="country" id="" class="form-control">
                        <option value="">Quốc gia</option>
                        @foreach ($country as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="form-group">
                       {!! Form::selectYear('year_locphim' , 2010 , 2024 , '',['class'=>'form-control' ,'placeholder'=>'Năm']) !!}
                  </div>
               </div>
                   
                   <input type="submit" value="Lọc phim" class="btn btn-sm btn-defult">
              </form>
              </div>
          </div>
       
          <div class="halim_box">

@foreach ($movie as $item)
    

             <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-27021">
                <div class="halim-item">
                   <a class="halim-thumb" href="{{ route('movie' , $item->slug) }}" title="{{ $item->title }}">
                      <figure><img class="lazy img-responsive" src="{{ asset($item->image) }}" alt="{{ $item->title }}" title="{{ $item->title }}"></figure>
                      <span class="status"> @if ($item->resolution == 0)
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
                - SS {{ $item->season }}
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
