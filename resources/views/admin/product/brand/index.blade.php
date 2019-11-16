@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Brands</h5>
  <div class="card-body">
    @if(count($brands)>0)
    <table class="table table-striped table-hover admin-table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Image</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($brands as $brand)

        <tr>
          <td scope="row">{{$loop->index +1 }}</td>
          <td>{{$brand->name}}</td>
          <td>
            <img class="rounded float-left" src="{{asset('images/brand/'.$brand->image)}}" alt="{{$brand->name}}" width="40" height="40"/>
          </td>
          <td>
            <a class="btn btn-primary" href="{{ route('admin.product.brand.edit', $brand->id )}}">Edit</a>
            <a class="btn btn-danger" data-toggle="modal" href="#delModal{{$brand->id}}">Delete</a>
          </td>

          <!-- Modal {{$loop->index +1 }} -->
          <div class="modal fade" id="delModal{{$brand->id}}" tabindex="-1" role="dialog" aria-labelledby="#delModal{{$brand->id}}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="#delModal{{$brand->id}}Label">Delete brand</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="{{ route('admin.product.brand.destroy',$brand->id) }}">
                  {{csrf_field()}}
                    <button type="submit" class="btn btn-danger">Parmanent delete brand</button>
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
      <h2>No brand found <a href="{{route('admin.product.brand.create')}}">Add brand</a></h2>
    @endif
  </div>
</div>
@endsection