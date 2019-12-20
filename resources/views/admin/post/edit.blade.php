@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Edit Product</h5>
  <div class="card-body">
    @if($post)
    <form method="post" action="{{ route('admin.post.update',$post->id) }}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="form-group">
        <label for="inputTitle" class="col-form-label">Title</label>
        <input id="inputTitle" type="text" name="title" value="{{$post->title}}" class="form-control">
      </div>
      <div class="form-group">
        <label for="inputDescription">Description</label>
        <textarea class="form-control rich-editor" id="inputBody" name="body" rows="3">{{$post->body}}</textarea>
      </div>

      <div class="form-row">
        {{-- multiple korte hobe --}}
        <div class="form-group col-md-4">
          <select class="form-control chosen-select" name="category[]" multiple>
            <option value="" disabled>Post category</option>
            @foreach(Helper::postCategoryList() as $cat)
              <option value="{{$cat->id}}" @if( in_array( $cat->id, Helper::postCategory($post) ) ) selected @endif>{{$cat->name}}</option>
            @endforeach
          </select>
        </div>


        <div class="form-group col-md-4">
          <select class="form-control chosen-select" name="tags[]" multiple>
            <option value="" disabled>Post tags</option>
            @foreach(Helper::postTagList() as $tag)
              <option value="{{$tag->id}}" @if( in_array( $tag->id, Helper::postTags($post) ) ) selected @endif>{{$tag->name}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group col-md-4">

        <div class="custom-file mb-3">
          <input type="file" class="custom-file-input" name="image" id="inputImage" multiple>
          <label class="custom-file-label" for="inputImage">File Input</label>
        </div>
        @if($post->image)
          <img class="rounded float-left" src="{{asset('images/post/'.$post->image)}}" alt="{{$post->title}}" width="200" height="200"/>
        @endif
        </div>
        </div>
      </div>

      <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">Reset</button> <button class="btn btn-primary" type="submit">Update</button>
      </div>
    </form>
    @else
    <h2>Invalid post</h2>
    @endif
  </div>
</div>
@endsection