@extends('layouts.admin')

@section('title')
Admin
@endsection

@section('content')
<section class="bg-primary">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="d-flex align-items-center py-3">
          <h2 class="h3 font-weight-semibold text-white mb-0 mr-auto">Master</h2>
          <a class="btn btn-dark btn-shadow" href="forum-create.html" role="button">Add new topic</a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection