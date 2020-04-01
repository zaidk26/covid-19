@extends('layouts.app')
@section('content')
      <welcome-component 
            :news-sa="{{$newsSa}}" 
            :news-world="{{$newsWorld}}"
            :historical-data="{{ $historicalData }}"
            :sa-corona-update="{{$saCoronaUpdate}}"
      ></welcome-component>
@endsection