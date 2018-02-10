@extends('layouts.app')

@section('content')
<div class="container">

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">

        <div class="panel-heading">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">ユーザー</li>
            </ol>
          </nav>
        </div>

        <div class="panel-body">
          <!-- 表示 -->
          <ul class="list-inline">
            @foreach ($data['user'] as $element)
            <li>
              <span>{{ $element->name }}</span>
            </li>
            @endforeach
          </ul>
          
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
