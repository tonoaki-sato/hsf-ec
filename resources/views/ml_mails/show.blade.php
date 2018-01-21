@extends('layouts.app')

@section('content')
<div class="container">

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">

        <div class="panel-heading">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('ml_mails') }}">メーリングリスト</a></li>
              <li class="breadcrumb-item active" aria-current="page">メールを読む</li>
            </ol>
          </nav>
        </div>

        <div class="panel-body">
          <div class="form-horizontal">
          
          <!-- タイトル -->
          <div class="form-group{{ $errors->has('h_subject') ? ' has-error' : '' }}">
            <label for="h_subject" class="col-md-2 control-label">件名</label>
            <div class="col-md-8">
              {{ $item->h_subject }}
            </div>
          </div>

          <!-- 日付 -->
          <div class="form-group{{ $errors->has('h_date') ? ' has-error' : '' }}">
            <label for="h_date" class="col-md-2 control-label">日時</label>
            <div class="col-md-8">
              {{ date("Y年m月d日 H:i:s", strtotime($item->h_date)) }}
            </div>
          </div>

          <!-- 差出人 -->
          <div class="form-group{{ $errors->has('h_from') ? ' has-error' : '' }}">
            <label for="h_from" class="col-md-2 control-label">差出人</label>
            <div class="col-md-8">
              {{ $item->h_from }}
            </div>
          </div>

          @if (empty($attachments) === false)
          <!-- 添付ファイル -->
          <div class="form-group">
            <label for="attachments" class="col-md-2 control-label">添付ファイル</label>
            <div class="col-md-8">
              @foreach ($attachments as $element)
                  <div><a href="{{ route('ml_mails.download', ['id' => $element->id]) }}">{{ $element->outer_name }}</a></div>
              @endforeach
            </div>
          </div>
          @endif

          <!-- 内容 -->
          <div class="form-group{{ $errors->has('contents') ? ' has-error' : '' }}">
            <label for="contents" class="col-md-2 control-label">内容</label>
            <div class="col-md-8">
              {!! nl2br($item->contents) !!}
            </div>
          </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
