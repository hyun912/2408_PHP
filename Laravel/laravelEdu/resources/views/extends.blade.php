{{-- 상속 --}}
@extends('layout.layout')

{{-- @section : 부모탬플릿에 해당하는 yield에 삽입 --}}
@section('title', '자식')

@section('main')
  <h2>메인 영역</h2>
@endsection

@section('show', '자식식 Show')

<hr>

{{-- 조건문 --}}
@if ($data[0]['gender'] == 'F')
  <span>요자</span>
@elseif($data[0]['gender'] == 'M')
  <span>냥자</span>
@else
  <span>뭐냐</span>
@endif

<hr>

{{-- 반복문 --}}
@for ($i = 2; $i < 10; $i++)
  {{ $i.' ' }} 
@endfor

@foreach ($data as $item)
  <div style="{{ $loop->odd ? 'color: red' : ''; }}">
    <span>{{ $item['name'] }}</span>
    <span>{{ $item['gender'] }}</span>
    {{-- <span>남은 루프 횟수 : {{ $loop->remaining }}</span> --}}
  </div>
@endforeach

<br>

{{-- 배열값 하나라도 있으면 여기 --}}
@forelse ($data2 as $item)
  <div>{{ $item['name'] }}</div>
  
@empty
  {{-- 배열값 0개면 여기 --}}
  <div>Not data</div>
@endforelse