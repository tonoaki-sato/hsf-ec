@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ダッシュボード</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                      <a href="#" class="stech_btn">議事録
                      </a>
                    </div>
                    You are logged in!<br />
                    ・議事録（一覧、読む、作る）<br />
                    ・メーリングリスト（一覧、読む）<br />
                    ・スケジュール（一覧、見る、作る）<br />
                    ・組織図（見る、作る）
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
