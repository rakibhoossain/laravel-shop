@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Categories</h5>
  <div class="card-body">
    @if(count($categories)>0)
    <table class="table table-striped table-hover admin-table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Parent ID</th>
          <th scope="col">Image</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr>
          <td scope="row">{{$loop->index +1 }}</td>
          <td>{{$category->name}}</td>
          <td>{{$category->parent_id}}</td>
          <td>
            <img class="rounded float-left" src="{{asset('images/category/'.$category->image)}}" alt="{{$category->name}}" width="40" height="40"/>
          </td>
          <td>
            <a class="btn btn-primary" href="{{ route('admin.post.category.edit', $category->id )}}">Edit</a>
            <a class="btn btn-danger" data-toggle="modal" href="#delModal{{$category->id}}">Delete</a>
          </td>

          <!-- Modal {{$loop->index +1 }} -->
          <div class="modal fade" id="delModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="#delModal{{$category->id}}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="#delModal{{$category->id}}Label">Delete category</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="{{ route('admin.post.category.destroy',$category->id) }}">
                  {{csrf_field()}}
                    <button type="submit" class="btn btn-danger">Parmanent delete category</button>
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
      <h2>No category found <a href="{{route('admin.post.category.create')}}">Add category</a></h2>
    @endif
  </div>
</div>
@endsection