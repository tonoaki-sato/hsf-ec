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
              <li class="breadcrumb-item active" aria-current="page">ML</li>
              <li class="breadcrumb-item"><a href="{{ route('ml_mails.create') }}">メールを書く</a></li>
            </ol>
          </nav>
        </div>

        <div class="panel-body">
          <ul class="list-group">
            @foreach ($mails as $element)
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>{{ $element->h_subject }}</div>
              <nav class="nav">
                <div>
                {{ str_replace("<" . env('MAIL_FROM_ADDRESS') . ">", "", $element->h_from) }}
                <span style="padding-left: 5px; font-size: 12px;">{{ date("Y年m月d日 H:i:s", strtotime($element->h_date)) }}</span>
                </div>
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
