@extends('layouts.app')
@section('content')
      <welcome-component 
            :news-sa="{{$newsSa}}" 
            :news-world="{{$newsWorld}}"
            :historical-data="{{ $historicalData }}"
      ></welcome-component>
@endsection