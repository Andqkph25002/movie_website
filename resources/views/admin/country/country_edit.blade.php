@extends('admin.admin_master')
@section('admin')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Sửa quốc gia</h4><br><br>



 <form method="post" action="{{ route('country.update') }}" autocomplete="off" >
                @csrf
<input type="hidden" name="id" value="{{ $editCountry->id }}">
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                <div class="form-group col-sm-10">
                    <input name="title" required value="{{ $editCountry->title }}" class="form-control" id="slug" onkeyup=" ChangeToSlug()" type="text">
                </div>
            </div>
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Slug</label>
                <div class="form-group col-sm-10">
                    <input name="slug" value="{{ $editCountry->slug }}" required class="form-control" id="convert_slug" type="text">
                </div>
            </div>
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
                <div class="form-group col-sm-10">
                    <textarea required name="description" cols="30" rows="10" class="form-control">{{ $editCountry->description }}</textarea>
                </div>
            </div>


            <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Active</label>
        <div class="col-sm-10">
            <select name="status" class="form-select" aria-label="Default select example">
              @if ($editCountry->status == 1)
              <option selected value="1">Hiển thị</option>
              @else
              <option selected value="0">Không hiển thị</option>
              @endif
               
             
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


<input type="submit" class="btn btn-info waves-effect waves-light" value="Sửa quốc gia">
            </form>



        </div>
    </div>
</div> <!-- end col -->
</div>



</div>
</div>




@endsection 