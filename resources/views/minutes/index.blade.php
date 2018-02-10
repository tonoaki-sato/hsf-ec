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
              <li class="breadcrumb-item active" aria-current="page">議事録</li>
            </ol>
          </nav>
        </div>

        <div class="panel-body">
          <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <a href="{{ route('minutes.create') }}">議事録を作る</a>
            </li>
            @foreach ($minutes as $element)
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>{{ $element->title }}</div>
              <nav class="nav">
                <a class="nav-link" href="{{ route('minutes.show', ['id' => $element->id]) }}">読む</a>
              </nav>
            </li>
            @endforeach
          </ul>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
