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
                      <a href="{{ route('minutes') }}">議事録
                      </a>
                    </div>
                    <div>
                      <a href="{{ route('ml_mails') }}">メーリングリスト
                      </a>
                    </div>
                    <br />
                    ・スケジュール（一覧、見る、作る）<br />
                    ・組織図（見る、作る）
                </div>
                <div>
                  <a class="twitter-timeline" width="320px" height="400px" data-border-color="#000000" data-chrome="noheader nofooter" href="https://twitter.com/shukubakun?ref_src=twsrc%5Etfw">Tweets by shukubakun</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
