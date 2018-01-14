@extends('layouts.app')

@section('content')
<div class="container">

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">

        <div class="panel-heading">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('minutes') }}">議事録</a></li>
              <li class="breadcrumb-item active" aria-current="page">議事録を見る</li>
            </ol>
          </nav>
        </div>

        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="{{ route('minutes.store') }}">
          {{ csrf_field() }}
          
          <!-- タイトル -->
          <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label for="title" class="col-md-2 control-label">タイトル</label>
            <div class="col-md-8">
              {{ $minute->title }}
            </div>
          </div>

        <div class="form-row">
          <!-- 日時 -->
          <div class="form-group col-md-6{{ $errors->has('start_at') ? ' has-error' : '' }}">
            <label for="start_at" class="col-md-4 control-label">日時</label>
            <div class="col-md-8">
              {{ date("Y年m月d日 H:i ～", strtotime($minute->start_at)) }}
            </div>
          </div>

          <!-- 参加人数 -->
          <div class="form-group col-md-6{{ $errors->has('attendees') ? ' has-error' : '' }}">
            <label for="attendees" class="col-md-4 control-label">参加人数</label>
            <div class="col-md-6">
              {{ $minute->attendees }} 人
            </div>
          </div>
        </div>

          <!-- 場所 -->
          <div class="form-group{{ $errors->has('place') ? ' has-error' : '' }}">
            <label for="place" class="col-md-2 control-label">場所</label>
            <div class="col-md-8">
              {{ $minute->place }}
            </div>
          </div>

        <div class="form-row">
          <!-- 議長 -->
          <div class="form-group col-md-6{{ $errors->has('chairman') ? ' has-error' : '' }}">
            <label for="chairman" class="col-md-4 control-label">議長</label>
            <div class="col-md-6">
              {{ $minute->chairman_name }}
            </div>
          </div>
          <!-- 書記 -->
          <div class="form-group col-md-6{{ $errors->has('secretary') ? ' has-error' : '' }}">
            <label for="secretary" class="col-md-4 control-label">書記</label>
            <div class="col-md-6">
              {{ $minute->secretary_name }}
            </div>
          </div>
        </div>

          <!-- 内容 -->
          <div class="form-group{{ $errors->has('contents') ? ' has-error' : '' }}">
            <label for="contents" class="col-md-2 control-label">内容</label>
            <div class="col-md-8 contents">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-8 col-md-offset-2">
              <a class="btn btn-primary" href="{{ route('minutes.edit', ['id' => $minute->id]) }}" role="button">編集する</a>
            </div>
          </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/markdown-it/8.4.0/markdown-it.min.js" integrity="sha256-6YhPRj11jVWKrz5aBXa9FqGrmmCoZwNiCtIe1lhgm+M=" crossorigin="anonymous"></script>
<script>
$(function(){
	var md = window.markdownit();
	$(".contents")
		.empty()
		.append(md.render("{{ $minute->contents }}"));
});
</script>
@endpush
