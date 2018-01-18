@extends('layouts.app')

@section('content')
<div class="container">

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">

        <div class="panel-heading">メーリングリスト</div>

        <div class="panel-body">
          <ul class="list-group">
            @foreach ($mails as $element)
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>{{ $element->h_subject }}</div>
              <nav class="nav">
                <a class="nav-link" href="{{ route('ml_mails.show', ['id' => $element->id]) }}">読む</a>
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
