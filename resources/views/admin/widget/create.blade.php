@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Add widget</h5>
  <div class="card-body">
    <form method="post" action="{{ route('admin.widget.store') }}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="form-group">
        <label for="title" class="col-form-label">Title</label>
        <input id="title" type="text" name="title" class="form-control">
      </div>
      <div class="form-group">
        <label for="inputDescription">Content</label>
        <textarea class="form-control" id="inputDescription" name="content" rows="3"></textarea>
      </div>

      <div class="form-row">
        <div class="form-group col-md-4">
          <select class="form-control" name="position">
            <option value="">Display area</option>
            @foreach(Helper::widget_areas() as $k => $val)
              <option value="{{$k}}">{{$val}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">Reset</button> <button class="btn btn-primary" type="submit">Add widget</button>
      </div>
    </form>
  </div>
</div>
@endsection