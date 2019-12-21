@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Currencies</h5>
  <div class="card-body">
    @if(count($currencies)>0)
    <table class="table table-striped table-hover admin-table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Code</th>
          <th scope="col">Symbol</th>
          <th scope="col">Exchange rate</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($currencies as $currency)
        <tr>
          <td scope="row">{{$loop->index +1 }}</td>
          <td>{{$currency->name}}</td>
          <td>{{$currency->code}}</td>
          <td>{{$currency->symbol}}</td>
          <td>{{$currency->exchange_rate}}</td>
          <td>
            <a class="btn btn-primary" href="{{ route('admin.currency.edit', $currency->id )}}">Edit</a>
            <a class="btn btn-danger" data-toggle="modal" href="#delModal{{$currency->id}}">Delete</a>
          </td>

          <!-- Modal {{$loop->index +1 }} -->
          <div class="modal fade" id="delModal{{$currency->id}}" tabindex="-1" role="dialog" aria-labelledby="#delModal{{$currency->id}}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="#delModal{{$currency->id}}Label">Delete currency</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="{{ route('admin.currency.destroy',$currency->id) }}">
                  {{csrf_field()}}
                    <button type="submit" class="btn btn-danger">Parmanent delete currency</button>
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
      <h2>No currency found <a href="{{route('admin.currency.create')}}">Add currency</a></h2>
    @endif
  </div>
</div>
@endsection