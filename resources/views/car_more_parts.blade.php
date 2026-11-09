
@extends('layouts.app')


 

@section('content')

@include('inc.showcase_searchby')

<!-- By Model -->
<section class="by_model">
  <div class="container">
    

    <div class="row">
      @include('inc.makes')

      <div class="col-md-10 by_model_right">

        @include('inc.messages')
        @include('inc.more_parts')

      </div>
    </div>
  </div>
</section>

<!-- Flash Deals -->
@include('inc.flash_deals')


@endsection
    
  