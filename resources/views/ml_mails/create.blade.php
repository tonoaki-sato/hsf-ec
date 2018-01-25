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
              <li class="breadcrumb-item active" aria-current="page">メールを書く</li>
            </ol>
          </nav>
        </div>

        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="{{ route('ml_mails.send') }}">
          {{ csrf_field() }}
          
          <!-- 宛先 -->
          <div class="form-group{{ $errors->has('to') ? ' has-error' : '' }}">
            <label for="title" class="col-md-2 control-label">宛先</label>
            <div class="col-md-8">
              <select id="to" class="form-control" name="to" value="{{ old('to')  }}" required>
                @foreach ($ml as $element)
                <option value="{{ $element }}@syukuba.net">{{ $element }}</option>
                @endforeach
              </select>
              @if ($errors->has('to'))
                <span class="help-block">
                  <strong>{{ $errors->first('to') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <!-- 件名 -->
          <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
            <label for="subject" class="col-md-2 control-label">件名</label>
            <div class="col-md-8">
              <input id="subject" type="text" class="form-control" name="subject" value="{{ old('subject') }}" required>
              @if ($errors->has('subject'))
                <span class="help-block">
                  <strong>{{ $errors->first('subject') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <!-- 本文 -->
          <div class="form-group{{ $errors->has('contents') ? ' has-error' : '' }}">
            <label for="contents" class="col-md-2 control-label">本文</label>
            <div class="col-md-8">
              <textarea id="contents" class="form-control" name="contents" rows="20" required>{{ old('contents') }}</textarea>
              @if ($errors->has('contents'))
                <span class="help-block">
                  <strong>{{ $errors->first('contents') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-8 col-md-offset-2">
              <button type="submit" class="btn btn-primary">
                送信する
              </button>
            </div>
          </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
