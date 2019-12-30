@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Sliders</h5>
  <div class="card-body">
    @if(count($sliders)>0)
    <table class="table table-striped table-hover admin-table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($sliders as $slider)
        <tr>
          <td scope="row">{{$loop->index +1 }}</td>
          <td>{{$slider->title}}</td>
          <td>
            <a class="btn btn-primary" href="{{ route('admin.slider.edit', $slider->id )}}">Edit</a>
            <a class="btn btn-danger" data-toggle="modal" href="#delModal{{$slider->id}}">Delete</a>
          </td>

          <!-- Modal {{$loop->index +1 }} -->
          <div class="modal fade" id="delModal{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="#delModal{{$slider->id}}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="#delModal{{$slider->id}}Label">Delete slider</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="{{ route('admin.slider.destroy',$slider->id) }}">
                  {{csrf_field()}}
                    <button type="submit" class="btn btn-danger">Parmanent delete slider</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </tr>
        @endforeach

      </tbody>
    </table>
    @else
      <h2>No slider found <a href="{{route('admin.slider.create')}}">Add slider</a></h2>
    @endif
  </div>
</div>
@endsection