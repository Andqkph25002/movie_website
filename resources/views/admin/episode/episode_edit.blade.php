@extends('admin.admin_master')
@section('admin')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Sửa tập phim</h4><br><br>
<form action="{{ route('episode.update') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $episode->id }}">
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Chọn phim</label>
         <div class="col-sm-10">
         <select name="movie_id" class="form-select select-movie" aria-label="Default select example" required>
            <option value="" selected disabled>Chọn bộ phim</option>
            @foreach ($list_movie as $item) 
            <option value="{{ $item->id }}" @if ($item->id == $episode->movie_id)
                     selected
            @endif>{{ $item->title }}</option>
            @endforeach
     
          </select> 

            </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Link phim</label>
         <div class="col-sm-10">
       <input name="linkphim" value="{{ $episode->linkphim }}" class="form-control" type="text" required>

            </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Tập phim</label>
         <div class="col-sm-10">
        <input type="text" name="episode" value="{{ $episode->episode }}" class="form-control" readonly>
            </div>
    </div>




    <input type="submit" class="btn btn-info waves-effect waves-light" value="Sửa tập phim">
</form>




        </div>
    </div>
</div> <!-- end col -->
</div>



</div>
</div>




@endsection 