@extends('layouts.app')

@section('content')
<div class="container">

    @if (Session::has('is_first') === true)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
            <div class="text-success"><strong>利用登録が完了しました。</strong></div>
            ホームページの機能を利用する場合は上のメニューの「ダッシュボード」をクリックしてください。<br />
            操作を終了する場合は上のメニューの「{{ $user->name }}」をクリックして、ログアウトをクリックしてください。<br />
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">プロフィール</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <!-- ユーザーID -->
                        <input id="id" type="hidden" name="id" value="{{ $user->id }}">
                        <!-- 名前 -->
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">名前（フルネーム）</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" disabled>
                            </div>
                        </div>
                        <!-- メールアドレス -->
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">メールアドレス</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" disabled>
                            </div>
                        </div>
                        <!-- 役割区分 -->
                        <div class="form-group">
                            <label for="role" class="col-md-4 control-label">役割区分</label>
                            <div class="col-md-6">
                                <select id="role" class="form-control" name="role" disabled>
                                  <option value="general" @if($user->role === 'general') selected @endif>general</option>
                                  <option value="secretary" @if($user->role === 'secretary') selected @endif>secretary</option>
                                </select>
                            </div>
                        </div>
                        <!-- 編集ボタン -->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" disabled>
                                    編集する
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
