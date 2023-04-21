@extends('admin.admin_master')
@section('admin')


 <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Danh sách tập phim</h4>



                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

    <a href="{{ route('episode.add') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fas fa-plus-circle"> Thêm tập phim </i> </a> <br>  <br>               

                    <h4 class="card-title">Danh sách</h4>


                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Movie Name</th> 
                            <th>Image</th>
                            <th>Episode</th>
                            <th>Link Movie</th>
                            <th>Action</th>

                        </thead>


                        <tbody>

                        	@foreach($list_episode as $key => $item)
                           
                                 
                          
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td>{{ $item->movie->title }}</td>
                            <td><img src="{{ asset($item->movie->image) }}" width="150" height="200" alt=""></td>
                            <td>{{ $item->episode }}</td>
                            <td>{!! $item->linkphim !!}</td>
                            
                            <td>
   <a href="{{ route('episode.edit',$item->id) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>

     <a href="{{ route('episode.delete',$item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>

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