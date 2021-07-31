@extends('layouts.master')

@section('title')
About Us - {{config('app.name')}}
@endsection

@section('header')
<header class="header text-white" style="background-image: url(../assets/img/thumb/14.jpg);" id="about">
  <div class="overlay opacity-75" style="background-image: linear-gradient(-225deg, #8b98fc 30%,  #764ba2 100%);"></div>
  <div class="container text-center">

    <div class="row">
      <div class="col-md-8 mx-auto py-8">

        <h1 class="display-41">About {{config('app.name')}}</h1>
        <p class="lead-2 opacity-901 mt-6">Kami ingin membantu anda untuk menemukan rekomendasi dan inspirasi kado untuk orang tersayang anda.</p>

      </div>
    </div>

  </div>
</header>
@endsection

@section('content')

<main class="main-content">



  <!--
  |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
  | Our Mission
  |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
  !-->
  <section class="section" >
    <div class="container">
      <div class="row gap-y align-items-center">

        <div class="col-md-8 mx-auto">
          <h2>About Us</h2>
          <p class="lead">
            <i>{{config('app.name')}}</i> adalah website untuk menemukan inspirasi ataupun rekomendasi kado yang cocok untuk berbagai kegiatan dari mulai Kado untuk <i>Anniversary, Pernikahan, Ulang Tahun, Wisuda, Persalinan. </i> 
            Dan juga Kado untuk orang orang tersayang seperti : <i>Sahabat, Orang Tua, Anak.</i>
            <br>
            Website ini muncul karena banyak sekali yang bingung pada saat ingin memberikan kado untuk orang tersayang, maka dari itu kami sangat senang jika memang nantinya website <i>{{config('app.name')}}</i> dapat membantu anda dalam menemukan inspirasi kado.</p>

        </div>

      </div>
    </div>
  </section>


  <!--
  |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
  | Team
  |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
  !-->
  <section class="section">
    <div class="container">
      <header class="section-header">
        <small>People</small>
        <h2>The Amazing Team</h2>
        <hr>
        <p class="lead">Mari bertemu dengan tim kecil kami.</p>
      </header>

      <div class="row gap-y">
        <div class="col-md-4 team-2">
          {{-- <a href="#">
            <img src="../assets/img/avatar/1.jpg" alt="...">
          </a>
          <h5>Morgan Guadis</h5>
          <small>Co-Founder & CEO</small>
          <p>Signs you'll a, life itself to in signs seed under fruitful good open behold Our of stars whales forth.</p>
          <br>
          <div class="social social-brand">
            <a class="social-facebook" href="#"><i class="fa fa-facebook"></i></a>
            <a class="social-twitter" href="#"><i class="fa fa-twitter"></i></a>
            <a class="social-gplus" href="#"><i class="fa fa-google-plus"></i></a>
            <a class="social-linkedin" href="#"><i class="fa fa-linkedin"></i></a>
          </div> --}}
        </div>


        <div class="col-md-4 team-2">
          <a href="#">
            <img src="https://masqote.github.io/medhy/assets/img/thumb/Capture.PNG" class="rounded" alt="...">
          </a>
          <h5>Medhy Pradana Putra</h5>
          <small>Founder</small>
          <p>Seseorang yang sangat mencintai Bubur Ayam dan Pemakan Rumput ( Laut )</p>
          <br>
          <div class="social social-brand">
            <a class="social-facebook" href="https://www.facebook.com/medhy.pradana.putra"><i class="fa fa-facebook"></i></a>
            <a class="social-instagram" href="https://www.instagram.com/medhypradana/"><i class="fa fa-instagram"></i></a>
            <a class="social-linkedin" href="https://www.linkedin.com/in/medhy-pradana-93b5aa15a" target="_blank"><i class="fa fa-linkedin"></i></a>
          </div>
        </div>


        <div class="col-md-4 team-2">
          {{-- <a href="#">
            <img src="../assets/img/avatar/3.jpg" alt="...">
          </a>
          <h5>Sandi Hormez</h5>
          <small>Director</small>
          <p>Given of living created living fifth him Give heaven made open day, own land hath one him darkness.</p>
          <br>
          <div class="social social-brand">
            <a class="social-facebook" href="#"><i class="fa fa-facebook"></i></a>
            <a class="social-twitter" href="#"><i class="fa fa-twitter"></i></a>
            <a class="social-gplus" href="#"><i class="fa fa-google-plus"></i></a>
            <a class="social-linkedin" href="#"><i class="fa fa-linkedin"></i></a>
          </div>
        </div> --}}
      </div>

    </div>
  </section>

  <section class="section" id="contact"  style="background-image: url(./assets/img/bg/5.jpg)" data-overlay="8">
    <div class="container">
      <header class="section-header">
        <h2 class="display-2" style="color: white;">Contact Me</h2>
        <hr style="color: white;">
        <p class="lead" style="color: white;">Lets get in touch.</p>
      </header>


      <div class="row gap-y text-center">

        <div class="col-lg-4">
          <div class="card border p-5">
            <h5 class="mb-4"><i class="fa fa-whatsapp" aria-hidden="true"></i> Whatsapp</h5>
            <p class="small-1">You can text me or call me on whatsapp.</p>
            <a href="https://api.whatsapp.com/send/?phone=6281282014215&text&app_absent=0">+62 812 8201 4215</a>
          </div>
        </div>


        <div class="col-lg-4">
          <div class="card border p-5">
            <h5 class="mb-4"><i class="fa fa-phone" aria-hidden="true"></i> Phone Call</h5>
            <p class="small-1">You also can call me</p>
            <a href="tel:081282014215">+62 812 8201 4215</a>
          </div>
        </div>


        <div class="col-lg-4">
          <div class="card border p-5">
            <h5 class="mb-4"><i class="fa fa-envelope" aria-hidden="true"></i> Email</h5>
            <p class="small-1">I will be waiting for an email from you</p>
            <a href="#">masqote@gmail.com</a>
          </div>
        </div>

      </div>


    </div>
  </section>



</main>

@endsection