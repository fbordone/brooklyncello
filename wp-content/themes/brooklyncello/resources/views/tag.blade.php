@extends('layouts.app')

@section('content')
  {{-- Tags grid section --}}
  @isset($data['grid'])
    @include('modules.grid', ['data' => $data['grid']])
  @endisset
@endsection
