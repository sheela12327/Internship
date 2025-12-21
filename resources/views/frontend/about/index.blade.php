@extends('template.template')

@section('pagecontent')

<style>
.about-page {
  background: #fbf7ef;
  padding: 80px 0;
}
.about-container {
  max-width: 1200px;
  margin: auto;
  padding: 0 20px;
}
.about-section {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 60px;
  align-items: center;
  margin-bottom: 100px;
}
.about-section img {
  width: 100%;
  border-radius: 20px;
}
@media (max-width: 768px) {
  .about-section {
    grid-template-columns: 1fr;
  }
}
</style>

<div class="about-page">
  <div class="about-container">

    @foreach($abouts as $index => $about)

      <div class="about-section">

        {{-- Alternate image position --}}
        @if($index % 2 == 0)
          <div>
            <h1>{{ $about->heading }}</h1>
            <p>{{ $about->description }}</p>
          </div>
          <div>
            <img src="{{ asset('uploads/about/'.$about->image) }}">
          </div>
        @else
          <div>
            <img src="{{ asset('uploads/about/'.$about->image) }}">
          </div>
          <div>
            <h1>{{ $about->heading }}</h1>
            <p>{{ $about->description }}</p>
          </div>
        @endif

      </div>

    @endforeach

  </div>
</div>

@endsection
