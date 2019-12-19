@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Widgets</h5>
  <div class="card-body">
    @if(count($widgets)>0)
    <table class="table table-striped table-hover admin-table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Position</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($widgets as $widget)

        <tr>
          <td scope="row">{{$loop->index +1 }}</td>
          <td>{{$widget->title}}</td>
          <td>{{$widget->position}}</td>
          <td>
            <a class="btn btn-primary" href="{{ route('admin.widget.edit', $widget->id )}}">Edit</a>
            <a class="btn btn-danger" data-toggle="modal" href="#delModal{{$widget->id}}">Delete</a>
          </td>

          <!-- Modal {{$loop->index +1 }} -->
          <div class="modal fade" id="delModal{{$widget->id}}" tabindex="-1" role="dialog" aria-labelledby="#delModal{{$widget->id}}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="#delModal{{$widget->id}}Label">Delete widget</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="{{ route('admin.widget.destroy',$widget->id) }}">
                  {{csrf_field()}}
                    <button type="submit" class="btn btn-danger">Parmanent delete widget</button>
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
      <h2>No widget found <a href="{{route('admin.widget.create')}}">Add widget</a></h2>
    @endif
  </div>
</div>
@endsection