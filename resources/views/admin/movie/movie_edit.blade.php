@extends('admin.admin_master')
@section('admin')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Sửa phim</h4><br><br>



 <form method="post" action="{{ route('movie.update') }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
            <input type="hidden" name="id"  value="{{ $editMovie->id }}">
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                <div class="form-group col-sm-10">
                    <input name="title" value="{{ $editMovie->title }}" required class="form-control" id="slug" onkeyup=" ChangeToSlug()" type="text">
                </div>
            </div>
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">English title</label>
                <div class="form-group col-sm-10">
                    <input name="english_title" value="{{ $editMovie->english_title }}" required class="form-control" type="text">
                </div>
            </div>
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Slug</label>
                <div class="form-group col-sm-10">
                    <input name="slug" value="{{ $editMovie->slug  }}" required class="form-control" id="convert_slug" type="text">
                </div>
            </div>
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
                <div class="form-group col-sm-10">
                    <textarea required name="description" cols="30" rows="10" class="form-control">{{ $editMovie->description }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Tags</label>
                <div class="form-group col-sm-10">
                    <textarea required name="tags" cols="30" rows="10" class="form-control">{{ $editMovie->tags }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Year</label>
                <div class="form-group col-sm-10">
                    <input name="year" value="{{ $editMovie->year }}" required class="form-control" type="text">
                </div>
            </div>
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Time</label>
                <div class="form-group col-sm-10">
                    <input name="thoi_luong" value="{{ $editMovie->thoi_luong }}"  required class="form-control" type="text">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Category</label>
                 <div class="col-sm-10">
                 <select name="category_id" class="form-select" aria-label="Default select example">
                    <option value="" selected disabled>Chọn danh mục phim</option>
                    @foreach ($category as $item) 
                    <option @if ($editMovie->category_id == $item->id)
                        selected
                    @endif
                     value="{{ $item->id }}">{{ $item->title }}</option>
                    @endforeach
             
                  </select>
                    </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Genre</label>
                 <div class="col-sm-10">
               
                  @foreach ($genre  as $key =>  $item)
                  <input type="checkbox" name="genre_id[]" value="{{ $item->id }}" style="padding: 10px">
                  <label for="genre">{{ $item->title }}</label>
              @endforeach
                    </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Country</label>
                 <div class="col-sm-10">
                 <select name="country_id" class="form-select" aria-label="Default select example">
                    <option value="" selected disabled>Chọn quốc gia</option>
                            @foreach ($country as $item) 
                                <option @if ($editMovie->country_id == $item->id)
                                    selected
                                @endif
                                 value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
             
                  </select>
                    </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Movie properties</label>
                 <div class="col-sm-10">
                 <select name="thuocphim" class="form-select" aria-label="Default select example">
                       <option value="phimle" @if ($editMovie->thuocphim == 'phimle')
                           selected
                       @endif>Phim lẻ</option>
                       <option value="phimbo" @if ($editMovie->thuocphim == 'phimbo')
                           selected
                       @endif>Phim bộ</option>
                  </select>
                    </div>
            </div>

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Image</label>
                <div class="form-group col-sm-10">
                    <input name="image" class="form-control" type="file">
                </div>
            </div>
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Trailer</label>
                <div class="form-group col-sm-10">
                    <input name="trailer" value="{{ $editMovie->trailer }}" required class="form-control" type="text">
                </div>
            </div>
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Image</label>
                    <div class="form-group col-sm-10">
                        <img src="{{ asset($editMovie->image) }}" width="150" height="170" alt="">
                    </div>
            </div>


            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Hot Movie</label>
                 <div class="col-sm-10">
                 <select name="phim_hot" class="form-select" aria-label="Default select example">
                  <option @if ($editMovie->phim_hot == 1)
                      selected
                  @endif value="1">Hiển thị</option>
                  <option
                  @if ($editMovie->phim_hot == 0)
                  selected
              @endif
                   value="0">Không hiển thị</option>
             
                </select>
                    </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Resolution</label>
                 <div class="col-sm-10">
                 <select name="resolution" class="form-select" required aria-label="Default select example">
                    <option value="" selected disabled>Chọn độ phân giải</option>
                    <option @if ($editMovie->resolution == 0)
                        selected
                    @endif value="0">HD</option>
                    <option @if ($editMovie->resolution == 1)
                        selected
                    @endif value="1">SD</option>
                    <option @if ($editMovie->resolution == 2)
                        selected
                    @endif value="2">HD Cam</option>
                 
                    <option @if ($editMovie->resolution == 3)
                        selected
                    @endif value="3">Full HD</option>
                    <option @if ($editMovie->resolution == 4)
                        selected
                    @endif value="4">Trailer</option>
                </select>
                    </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Subtitle</label>
                 <div class="col-sm-10">
                 <select name="phude" class="form-select" required aria-label="Default select example">
                    <option value="" selected disabled>Chọn phụ đề</option>
                    <option @if ($editMovie->phude == 0)
                        selected
                    @endif value="0">Phụ đề</option>
                    <option @if ($editMovie->phude == 1)
                        selected
                    @endif value="1">Thuyết minh</option>
                    
                </select>
                    </div>
            </div>
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Episode Number</label>
                <div class="form-group col-sm-10">
                    <input name="episode" value="{{ $editMovie->episode }}" required class="form-control"  type="number">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Active</label>
                 <div class="col-sm-10">
                 <select name="status" class="form-select" aria-label="Default select example">
                  <option  @if ($editMovie->status == 1)
                    selected
                @endif
                   value="1">Hiển thị</option>
                  <option
                  @if ($editMovie->status == 0)
                  selected
              @endif
                   value="0">Không hiển thị</option>
             
                </select>
                    </div>
            </div>

           



  <!-- end row -->

      {{-- <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Unit Name </label>
        <div class="col-sm-10">
            <select name="unit_id" class="form-select" aria-label="Default select example">
                <option selected="">Choose Unit</option>
              
                <option value=""></option>
        
                </select>
        </div>
    </div>
  <!-- end row -->



      <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Category Name </label>
        <div class="col-sm-10">
            <select name="category_id" class="form-select" aria-label="Default select example">
                <option selected="">Choose Category</option>
            
                <option value=""></option>
        
                </select>
        </div>
    </div>
  <!-- end row --> --}}


<input type="submit" class="btn btn-info waves-effect waves-light" value="Sửa phim">
            </form>



        </div>
    </div>
</div> <!-- end col -->
</div>



</div>
</div>




@endsection 