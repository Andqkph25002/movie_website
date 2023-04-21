@extends('admin.admin_master')
@section('admin')


 <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Danh sách phim</h4>



                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

    <a href="{{ route('movie.add') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fas fa-plus-circle"> Thêm phim </i> </a> <br>  <br>               

                    <h4 class="card-title">Danh sách</h4>


                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Title</th>
                            <th>English Title</th>
                            <th>Description</th>
                            <th>Slug</th>
                            <th>Category</th>
                            <th>Genre</th>
                            <th>Country</th>
                            <th>Movie properties</th>
                            <th>Image</th>
                            <th>Movie Hot</th>
                            <th>Top View</th>
                            <th>Resolution</th>
                            <th>Sublite</th>
                            <th>Status</th>
                            <th>Year</th>
                            <th>Time</th>
                            <th>Tags</th>
                            <th>Season</th>
                            <th>Episode</th>
                            <th>Action</th>

                        </thead>


                        <tbody>

                        	@foreach($list as $key => $item)
                        <tr>
                            <td>{{ $key + 1}}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->english_title }}</td>
                                <td>{{ Str::limit($item->description , 80) }}</td>
                                <td>{{ $item->slug }}</td>



                              <td>{{ $item['category']['title'] }}</td> 
{{-- 
<td>
    <select name="category_id" class="category_choose">
    <option value="" selected disabled>Chọn danh mục phim</option>
    @foreach ($category as $cate) 
    <option @if ($item->category_id == $cate->id)
        selected
    @endif value="{{ $cate->id }}">{{ $cate->title }}</option>
    @endforeach

  </select>
 </td> --}}


                                <td>@foreach ($item->movie_genre as $gen)
                                     {{ $gen->title }}
                                @endforeach</td> 
                                {{-- <td>{{ $item->genre_id }}</td> --}}
                                <td>{{ $item['country']['title'] }}</td>
                                <td>@if ($item->thuocphim=='phimle')
                                    Phim lẻ
                                    @else
                                    Phim bộ
                                @endif</td>
                                <td>
                                    <img src="{{ asset($item->image) }}" alt="" width="150" height="150">
                                </td>
                                <td>
                                    @if ($item->phim_hot == 1)
                                        Hiển thị
                                    @else
                                        Không hiển thị
                                    @endif
                                </td>
                                <td>
                                  <form action="{{ route('update.topview') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                      <select name="topview" class="select-topview">
                                        <option @if ($item->topview == 0)
                                              selected
                                        @endif value="0">Ngày</option>
                                        <option @if ($item->topview == 1)
                                            selected
                                        @endif
                                         value="1">Tuần</option>
                                        <option @if ($item->topview == 2)
                                            selected
                                        @endif value="2">Tháng</option>
                                       </select>
                                       <button type="submit" class="btn btn-success">Cập nhật</button>
                                  </form>
                                </td>
                                <td>
                                    @if ($item->resolution == 0)
                                        HD
                                    @elseif($item->resolution == 1)
                                        SD
                                    @elseif($item->resolution == 2)
                                        HD Cam
                                    @elseif($item->resolution == 3)
                                       Full HD
                                       @elseif($item->resolution == 4 )
                                       Trailer
                                    @endif
                                </td>
                                <td>
                                    @if ($item->phude == 0)
                                    Phụ đề
                                @elseif($item->phude == 1)
                                    Thuyết minh
                                @endif
                                </td>
                                <td>
                                    @if ($item->status == 1)
                                        Hiển thị
                                    @else
                                        Không hiển thị
                                    @endif
                                </td>
                                <td>
                                   {{ $item->year }}
                                </td>
                                <td>{{ $item->thoi_luong }}</td>
                                <td>{{ $item->tags }}</td>
                                <td>
                                   <form method="post" action="{{ route('update.season') }}">
                                       @csrf
                                       <input type="hidden" name="id" value="{{ $item->id }}">
                                     {!! Form::selectRange('season' ,0,20, isset($item->season) ? $item->season : '' ,['class'=>'select-season' , 'id'=>$item->id]) !!}  
                                     <button type="submit" class="btn btn-success">Cập nhật</button>
                                   </form>
                                </td>



                                <td>{{ $item->episode }}</td>
                            <td>
   <a href="{{ route('movie.edit',$item->id) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>

     <a href="{{ route('movie.delete',$item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>

                            </td>

                        </tr>
                        @endforeach

                        </tbody>
                    </table>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->



                    </div> <!-- container-fluid -->
                </div>


@endsection

