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
              <li class="breadcrumb-item active" aria-current="page">議事録を作る</li>
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
              <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
              @if ($errors->has('title'))
                <span class="help-block">
                  <strong>{{ $errors->first('title') }}</strong>
                </span>
              @endif
            </div>
          </div>

        <div class="form-row">
          <!-- 日時 -->
          <div class="form-group col-md-6{{ $errors->has('start_at') ? ' has-error' : '' }}">
            <label for="start_at" class="col-md-4 control-label">日時</label>
            <div class="col-md-8">
              <input id="start_at" type="datetime-local" class="form-control" name="start_at" value="{{ old('start_at') }}" required>
              @if ($errors->has('start_at'))
                <span class="help-block">
                  <strong>{{ $errors->first('start_at') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <!-- 参加人数 -->
          <div class="form-group col-md-6{{ $errors->has('attendees') ? ' has-error' : '' }}">
            <label for="attendees" class="col-md-4 control-label">参加人数</label>
            <div class="col-md-6">
              <input id="attendees" type="number" class="form-control" name="attendees" value="{{ old('attendees') }}" required>
              @if ($errors->has('attendees'))
                <span class="help-block">
                  <strong>{{ $errors->first('attendees') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>

          <!-- 場所 -->
          <div class="form-group{{ $errors->has('place') ? ' has-error' : '' }}">
            <label for="place" class="col-md-2 control-label">場所</label>
            <div class="col-md-8">
              <input id="place" type="text" class="form-control" name="place" value="{{ old('place') }}" required>
              @if ($errors->has('place'))
                <span class="help-block">
                  <strong>{{ $errors->first('place') }}</strong>
                </span>
              @endif
            </div>
          </div>

        <div class="form-row">
          <!-- 議長 -->
          <div class="form-group col-md-6{{ $errors->has('chairman') ? ' has-error' : '' }}">
            <label for="chairman" class="col-md-4 control-label">議長</label>
            <div class="col-md-6">
              <select id="chairman" class="form-control" name="chairman" value="{{ old('chairman')  }}" required>
                @foreach ($users as $element)
                <option value="{{ $element->id }}">{{ $element->name }}</option>
                @endforeach
              </select>
              @if ($errors->has('chairman'))
                <span class="help-block">
                  <strong>{{ $errors->first('chairman') }}</strong>
                </span>
              @endif
            </div>
          </div>
          <!-- 書記 -->
          <div class="form-group col-md-6{{ $errors->has('secretary') ? ' has-error' : '' }}">
            <label for="secretary" class="col-md-4 control-label">書記</label>
            <div class="col-md-6">
              <select id="secretary" class="form-control" name="secretary" value="{{ old('secretary')  }}" required>
                @foreach ($users as $element)
                <option value="{{ $element->id }}">{{ $element->name }}</option>
                @endforeach
              </select>
              @if ($errors->has('secretary'))
                <span class="help-block">
                  <strong>{{ $errors->first('secretary') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>

          <!-- 内容 -->
          <div class="form-group{{ $errors->has('contents') ? ' has-error' : '' }}">
            <label for="contents" class="col-md-2 control-label">内容</label>
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
                作成する
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
