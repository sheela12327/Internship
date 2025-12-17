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

/* SECTION 1 */
.about-hero {
  display: grid;
  grid-template-columns: 1fr 1fr;
  align-items: center;
  gap: 60px;
  margin-bottom: 100px;
}

.about-hero h1 {
  font-size: 48px;
  font-family: Georgia, serif;
  margin-bottom: 20px;
}

.about-hero p {
  font-size: 18px;
  color: #444;
  line-height: 1.7;
}

.about-hero img {
  width: 100%;
  border-radius: 20px;
}

/* SECTION 2 */
.about-mission {
  display: grid;
  grid-template-columns: 1fr 1fr;
  align-items: center;
  gap: 60px;
}

.about-mission img {
  width: 100%;
  border-radius: 20px;
}

.about-mission h2 {
  font-size: 36px;
  margin-bottom: 20px;
}

.about-mission p {
  font-size: 17px;
  color: #444;
  line-height: 1.7;
}

/* RESPONSIVE */
@media (max-width: 768px) {
  .about-hero,
  .about-mission {
    grid-template-columns: 1fr;
  }

  .about-hero h1 {
    font-size: 36px;
  }
}
</style>

<div class="about-page">
  <div class="about-container">

    <!-- ABOUT HERO -->
    <div class="about-hero">
      <div>
        <h1>About Us</h1>
        <p>
          HubSpot’s company and culture are a lot like our product.
          They’re crafted, not cobbled, for a delightful experience.
        </p>
      </div>

      <div>
        <img  height="300px" width="300px" src="{{ asset('frontend/img/product02.png') }}" alt="Team Image">
      </div>
    </div>

    <!-- MISSION SECTION -->
    <div class="about-mission">
      <div>
        <img  height="300px" width="300px" src="{{ asset('frontend/img/product02.png') }}" alt="Office Image">
      </div>

      <div>
        <h2>Our Mission: Helping Millions of Organizations Grow Better</h2>
        <p>
          We believe not just in growing bigger, but in growing better.
          And growing better means aligning the success of your own business
          with the success of your customers. Win-win!
        </p>
      </div>
    </div>

  </div>
</div>





@endsection

