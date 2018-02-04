@extends('layouts.app')

@section('content')
<div class="container">

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">

        <div class="panel-heading">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('orgcharts') }}">組織図</a></li>
              <li class="breadcrumb-item"><a href="{{ route('organization') }}">組織を登録</a></li>
              <li class="breadcrumb-item active" aria-current="page">編集</li>
            </ol>
          </nav>
        </div>

        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="{{ route('organization.update') }}">
          {{ csrf_field() }}
            <!-- ID -->
            <input type="hidden" id="Organization-id" name="Organization[id]" value="{{ $data->id }}">
            <!-- 年数 -->
            <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
              <label for="year" class="col-md-2 control-label">年数</label>
              <div class="col-md-8">
                {{ $data->year }}
              </div>
            </div>

            <!-- 名前 -->
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name" class="col-md-2 control-label">名前</label>
              <div class="col-md-8">
                {{ $data->name }}
              </div>
            </div>

            <!-- 説明 -->
            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
              <label for="description" class="col-md-2 control-label">説明</label>
              <div class="col-md-8">
                <textarea id="Oraganization-description" class="form-control" name="Organization[description]" rows="3">{{ $data->description }}</textarea>
                @if ($errors->has('description'))
                  <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8 col-md-offset-2">
                <button type="submit" class="btn btn-primary">
                  登録する
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
