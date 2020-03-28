@extends('layouts.app')
@section('content')
      <welcome-component :news-sa="{{$newsSa}}" :news-world="{{$newsWorld}}"></welcome-component>
@endsection