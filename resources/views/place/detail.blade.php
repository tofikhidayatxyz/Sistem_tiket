@extends('layouts/app')

<style>
  .banner-image {
    height: 650px;
    object-fit: cover;
  }

  .card-image {
    height: 200px;
    width: 100%;
  }
  .card-image img {
    object-fit: cover;
    height: 100%;
    width: 100%;
  }
  .carousel-item img {
    width: 100%;
    height: 670px;
    object-fit: cover;
  }
</style>


@section('content')     
  
  <section class="banner mt-5">
    <div class="container">
      @error
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          @foreach($banner as $key => $itm)
          <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
            <img src="{{ $itm->image }}" class="d-block w-100" alt="...">
          </div>
          @endForeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    </div>
  </section>
  <section class="list mt-5 pb-5">
    <div class="container">
      <h1 class="fw-bold">{{ $place->name }}</h1>
      <p>Oleh : {{ $place->user->name }}</p>
      <p>{{ $place->description }}</p>
      <table class="table" style="max-width:500px">
        <tr>
          <td class="px-0">Jumlah Kamar :</td>
          <td class="px-0">{{ count((array)$rooms) }}</td>
        </tr>
        <tr>
          <td class="px-0">Kontak :</td>
          <td class="px-0">{{ $place->contact }}</td>
        </tr>
        <tr>
          <td class="px-0">Alamat :</td>
          <td class="px-0">{{ $place->address }}</td>
        </tr>
      </table>
      <h3 class="text-left py-5">Kamar Di <span class="text-primary fw-bold">{{ $place->name }}</span></h3>
      <div class="row">
        @foreach ($rooms as $key => $room )
          <div class="col-md-4">
            <a href="/rooms/{{ $room->id }}" class="text-decoration-none  ation-none">
              <div class="card rounded-0">
                <div class="card-image">
                  <img src="{{ $room->image }}" alt="">
                </div>
                <div class="card-content">
                  <div class="container-fluid py-3">
                    <h4 class="text-dark fw-bold">{{ $room->name }}</h4>
                    <h5 class="text-warning">IDR {{ $room->price_monthly }}</h5>
                    <p class="text-body">{{ limitText($room->description) }}</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection