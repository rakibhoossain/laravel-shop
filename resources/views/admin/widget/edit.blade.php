@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Edit widget</h5>
  <div class="card-body">
    <form method="post" action="{{ route('admin.widget.update', $widget->id) }}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="form-group">
        <label for="title" class="col-form-label">Title</label>
        <input id="title" type="text" name="title" class="form-control" value="{{$widget->title}}">
      </div>

      <div class="form-group">
        <label for="inputDescription">Content</label>
        <textarea class="form-control" id="inputDescription" name="content" rows="3">{{$widget->content}}</textarea>
      </div>



      <div class="form-row">
        <div class="form-group col-md-4">
          <select class="form-control" name="position">
            <option value="">Display area</option>
            @foreach(Helper::widget_areas() as $k => $val)
              <option {{ ( $k == $widget->position) ? 'selected' : '' }} value="{{$k}}">{{$val}}</option>
            @endforeach
          </select>
        </div>
      </div>


      <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">Reset</button> <button class="btn btn-primary" type="submit">Update</button>
      </div>
    </form>
  </div>
</div>
@endsection