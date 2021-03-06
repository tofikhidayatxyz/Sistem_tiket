@extends('layouts.seller')


<style>
  .card-image {
    height: 200px;
    width: 100%;
  }
  .card-image img {
    object-fit: cover;
    height: 100%;
    width: 100%;
  }
</style>


@section('content')
  <div class="w-100">
    <h2 class="text-dark fw-bold">Rooms On place {{ isset($place->name) ? $place->name : '-' }}</h2>
  </div>
  <div class="w-100 mt-3">
    <div class="w-100 mb-3 d-flex border-bottom align-items-center pb-3">
      <h5>10 Rooms</h5>
      <a href="/seller/room/create" class="btn btn-primary ms-auto">Add New</a>
    </div>
    @error
    @success
    <div class="row">
      @foreach ($rooms as $room)
        <div class="col-md-6 mb-3">
          <a href="" class="text-decoration-none">
            <div class="card rounded-0">
              <div class="card-image">
                <img src="{{ $room->image }}" alt="">
              </div>
              <div class="card-content">
                <div class="container-fluid py-3">
                  <h4 class="text-dark fw-bold">{{ $room->name }}</h4>
                  <h5 class="text-warning">{{ $room->price_monthly }}k</h5>
                  @if($room->is_available)
                  <span class="badge bg-success">Available</span>
                  @endif
                  <p class="text-body mt-2">
                    {{ limitText($room->description) }}
                  </p>
                </div>
              </div>
            </div>
          </a>
          <div class="w-100 mt-3">
            <div class="row w-100 justify-content-center">
              <div class="col-auto">
                <a href="/rooms/{{ $room->id }}" class="btn btn-info text-white">View</a>
              </div>
              <div class="col-auto">
                <a href="/seller/room/{{ $room->id }}" class="btn btn-warning text-white">Edit</a>
              </div>
              <div class="col-auto">
                <form action="/seller/room/{{ $room->id }}" method="POST">
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
              </div>
              
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

@endSection