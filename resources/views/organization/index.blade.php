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
              <li class="breadcrumb-item active" aria-current="page">組織を登録</li>
            </ol>
          </nav>
        </div>

        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="{{ route('organization.store') }}">
          {{ csrf_field() }}
            <!-- 年数 -->
            <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
              <label for="year" class="col-md-2 control-label">年数</label>
              <div class="col-md-8">
                <select id="year" class="form-control" name="year" required>
                  @foreach (range('2017', date("Y")) as $element)
                  @if ( (int)$data['year']  === (int)$element)
                  <option value="{{ $element }}" selected>{{ $element }}</option>
                  @else
                  <option value="{{ $element }}">{{ $element }}</option>
                  @endif
                  @endforeach
                </select>
                @if ($errors->has('year'))
                  <span class="help-block">
                    <strong>{{ $errors->first('year') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <!-- 名前 -->
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name" class="col-md-2 control-label">名前</label>
              <div class="col-md-8">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                @if ($errors->has('name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <!-- 説明 -->
            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
              <label for="description" class="col-md-2 control-label">説明</label>
              <div class="col-md-8">
                <textarea id="description" class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
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

          <!-- 表示 -->
          <div class="table-responsive">
            <table class="table table-sm">
              <tr>
                <th class="text-center">ID</th>
                <th class="text-center">年度</th>
                <th class="text-left">名前</th>
                <th class="text-left">説明</th>
                <th class="text-center">操作</th>
              </tr>
              @foreach ($organizations as $element)
              <tr>
                <td class="text-center">
                  <span>{{ $element->id }}</span>
                </td>
                <td class="text-center">
                  <span>{{ $element->year }}</span>
                </td>
                <td class="text-left">
                  <span>{{ $element->name }}</span>
                </td>
                <td class="text-left">
                  <span>{{ $element->description }}</span>
                </td>
                <td class="text-center">
                  <span><a href="{{ route('organization.destroy', ['id' => $element->id]) }}">削除</a></span>
                </td>
              </tr>
              @endforeach
            </table>
          </div>
          
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
