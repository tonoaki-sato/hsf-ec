@extends('layouts.app')

@section('content')
<div class="container">

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">

        <div class="panel-heading">議事録</div>

        <div class="panel-body">
          <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <a href="{{ route('minutes.create') }}">議事録を作る</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <a href="#">Cras justo odio</a>
              <span class="badge badge-primary">14</span>
              <a href="#">Cras justo odio</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <span class="badge badge-primary badge-pill">2</span>
              Dapibus ac facilisis in
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <span class="badge badge-primary badge-pill">1</span>
              Morbi leo risus
            </li>
          </ul>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
