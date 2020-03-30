@extends('layouts.app')
@section('content-no-vue')
  <div class="container">
    <div class="row">
      <div class="col-lg-4 mt-5">
        <div class="card">
          <div class="card-header">
           <h4 class="m-0"> Reddit </h4>
          </div>
          <div class="card-body p-0 overflow-hidden">
            <script src='https://redditjs.com/subreddit.js' data-subreddit="Coronavirus" data-width="300" data-height="300"></script>
          </div>
        </div>
        
      </div>
    </div>
  </div>
@endsection