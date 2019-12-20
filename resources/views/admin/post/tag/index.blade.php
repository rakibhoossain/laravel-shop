@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Tags</h5>
  <div class="card-body">
    @if(count($tags)>0)
    <table class="table table-striped table-hover admin-table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tags as $tag)
        <tr>
          <td scope="row">{{$loop->index +1 }}</td>
          <td>{{$tag->name}}</td>
          <td>
            <a class="btn btn-primary" href="{{ route('admin.post.tag.edit', $tag->id )}}">Edit</a>
            <a class="btn btn-danger" data-toggle="modal" href="#delModal{{$tag->id}}">Delete</a>
          </td>

          <!-- Modal {{$loop->index +1 }} -->
          <div class="modal fade" id="delModal{{$tag->id}}" tabindex="-1" role="dialog" aria-labelledby="#delModal{{$tag->id}}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="#delModal{{$tag->id}}Label">Delete tag</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="{{ route('admin.post.tag.destroy',$tag->id) }}">
                  {{csrf_field()}}
                    <button type="submit" class="btn btn-danger">Parmanent delete tag</button>
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
      <h2>No tag found <a href="{{route('admin.post.tag.create')}}">Add tag</a></h2>
    @endif
  </div>
</div>
@endsection