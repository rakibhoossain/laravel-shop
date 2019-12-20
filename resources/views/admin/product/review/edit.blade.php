@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Edit review</h5>
  <div class="card-body">
    @if($review)

    <form method="post" action="{{ route('admin.product.reviews.update',$review->id) }}">
      {{csrf_field()}}


    @if($review->name)
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="inputName" class="col-form-label">Name</label>
          <input id="inputName" type="text" name="name" value="{{$review->name}}" class="form-control">
        </div>
        <div class="form-group col-md-4">
          <label for="inputEmail" class="col-form-label">Email</label>
          <input id="inputEmail" type="text" name="email" value="{{$review->email}}" class="form-control">
        </div>
        <div class="form-group col-md-4">
          <label for="inputWebsite" class="col-form-label">Website</label>
          <input id="inputWebsite" type="text" name="website" value="{{$review->website}}" class="form-control">
        </div>
        <div class="form-group col-md-4">
          <label for="inputPhone" class="col-form-label">Phone Number</label>
          <input id="inputPhone" type="text" name="phone" value="{{$review->phone}}" class="form-control">
        </div>
      </div>
    @else
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="inputTitle" class="col-form-label">Name</label>
          <input id="inputTitle" type="text" class="form-control" disabled value="{{$review->user->name}}">
        </div>
      </div>
    @endif

      <div class="form-group">
        <label for="inputDescription">Body</label>
        <textarea class="form-control" id="inputDescription" name="body" rows="3">{{$review->body}}</textarea>
      </div>

      <div class="form-group">

        <div class="rating_box">
   <p>Rating:</p>                     
    <div class="star-rating">
      <div class="star-rating__wrap">
        <input class="star-rating__input" id="star-rating-5" @if($review->rating == 5) checked @endif type="radio" name="rating" value="5">
        <label class="star-rating__ico far fa-star" for="star-rating-5" title="5 out of 5 stars"></label>
        <input class="star-rating__input" id="star-rating-4" @if($review->rating == 4) checked @endif  type="radio" name="rating" value="4">
        <label class="star-rating__ico far fa-star" for="star-rating-4" title="4 out of 5 stars"></label>
        <input class="star-rating__input" id="star-rating-3" @if($review->rating == 3) checked @endif  type="radio" name="rating" value="3">
        <label class="star-rating__ico far fa-star" for="star-rating-3" title="3 out of 5 stars"></label>
        <input class="star-rating__input" id="star-rating-2" @if($review->rating == 2) checked @endif  type="radio" name="rating" value="2">
        <label class="star-rating__ico far fa-star" for="star-rating-2" title="2 out of 5 stars"></label>
        <input class="star-rating__input" id="star-rating-1" @if($review->rating == 1) checked @endif  type="radio" name="rating" value="1">
        <label class="star-rating__ico far fa-star" for="star-rating-1" title="1 out of 5 stars"></label>
      </div>
    </div>
</div>
      </div>



        <div class="form-group">
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" value="1" @if($review->status == '1') checked @endif name="status">Aproved
            </label>
          </div>
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" value="0" @if($review->status == '0') checked @endif name="status">Pending
            </label>
          </div>
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" value="spam" @if($review->status == 'spam') checked @endif name="status">Spam
            </label>
          </div>
        </div>


      <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">Reset</button> <button class="btn btn-primary" type="submit">Update</button>
      </div>
    </form>









    @else
      <h2>review Empty!</h2>
    @endif
  </div>
</div>
@endsection