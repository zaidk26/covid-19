@extends('layouts.app')
@section('content')
      <welcome-component 
            :news-sa="{{$newsSa}}" 
            :news-world="{{$newsWorld}}"
            :historical-data="{{ $historicalData }}"            
            :sa-provinces="{{$saProvinces}}"
      ></welcome-component>
@endsection