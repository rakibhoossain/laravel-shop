@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Shippings</h5>
  <div class="card-body">
    @if(count($shippings)>0)
    <table class="table table-striped table-hover admin-table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Type</th>
          <th scope="col">Charge</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($shippings as $shipping)
        <tr>
          <td scope="row">{{$loop->index +1 }}</td>
          <td>{{$shipping->type}}</td>
          <td>{{$shipping->price}}</td>
          <td>
            <a class="btn btn-primary" href="{{ route('admin.shipping.edit', $shipping->id )}}">Edit</a>
            <a class="btn btn-danger" data-toggle="modal" href="#delModal{{$shipping->id}}">Delete</a>
          </td>

          <!-- Modal {{$loop->index +1 }} -->
          <div class="modal fade" id="delModal{{$shipping->id}}" tabindex="-1" role="dialog" aria-labelledby="#delModal{{$shipping->id}}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="#delModal{{$shipping->id}}Label">Delete shipping</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="{{ route('admin.shipping.destroy',$shipping->id) }}">
                  {{csrf_field()}}
                    <button type="submit" class="btn btn-danger">Parmanent delete shipping</button>
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
      <h2>No shipping found <a href="{{route('admin.shipping.create')}}">Add shipping</a></h2>
    @endif
  </div>
</div>
@endsection