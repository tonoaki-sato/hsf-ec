
  <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title"></h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="min-height: 360px;">
          <!-- メンバー登録 -->
          <div class="modal-form">
            @if ($role === \Config::get('const.role_of_secretary'))
            <form class="form-horizontal" method="POST" action="{{ route('orgcharts.add_member') }}">
            {{ csrf_field() }}
            
              <input type="hidden" name="orgchartMember[orgchart_node_id]" value="">
              <!-- メンバー選択 -->
              <div class="form-group{{ $errors->has('orgchartMember[member_id]') ? ' has-error' : '' }} member-id">
                <label for="orgchartMember[member_id]" class="col-md-2 control-label">メンバー</label>
                <div class="col-md-8">
                  <select id="orgchartMember[member_id]" class="form-control" name="orgchartMember[member_id]" value="{{ old('member_id')  }}" required>
                  </select>
                  @if ($errors->has('orgchartMember[member_id]'))
                    <span class="help-block">
                      <strong>{{ $errors->first('orgchartMember[member_id]') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <!-- メンバー登録 -->
              <div class="form-group{{ $errors->has('member[name]') ? ' has-error' : '' }} member-name">
                <label for="member[name]" class="col-md-2 control-label">名前</label>
                <div class="col-md-8">
                  <input id="memberName" type="text" class="form-control" name="member[name]" value="{{ old('member[name]') }}" disabled>
                  @if ($errors->has('member[name]'))
                    <span class="help-block">
                      <strong>{{ $errors->first('member[name]') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-8 col-md-offset-2">
                  <button type="button" class="btn btn-primary btn-submit">
                    登録
                  </button>
                </div>
              </div>
            </form>
            @endif
          </div>
            
          <!-- メンバー表示 -->
          <div class="col-md-8 col-md-offset-2">
            <ul class="modal-member list-inline" data-user-role="{{ $role }}">
            </ul>
          </div>
          
        </div>
      </div>
    </div>
  </div>
@push('script')
<script>
$(function(){
    // グローバル変数
    var role = $(".modal-member").data("userRole");

    // テキストフォームクリック
    $(document).on("click", ".member-name", function(){
        // 入力可能にする
        $(this).find("input").prop("disabled", false);
        // 必須属性を付与する
        $(this).find("input").prop("required", true);
        // セレクトボックスを入力不可にする
        $(".member-id").find("select").val("").prop("disabled", true);
        $(".member-id").find("select").prop("required", false);
    });
    // セレクトボックスクリック
    $(document).on("click", ".member-id", function(){
        // 入力可能にする
        $(this).find("select").prop("disabled", false);
        // 必須属性を付与する
        $(this).find("select").prop("required", true);
        // テキストフォームを入力不可にする
        $(".member-name").find("input").val("").prop("disabled", true);
        $(".member-name").find("input").prop("required", false);
    });
    // 「x」リンククリック
    $(document).on("click", ".orgchart-member-delete", function(){
        // 処理実行確認
        var do_delete = confirm("登録を取り消しますか？");
        if (do_delete === false) {
            return false;
        }
        // ajax処理のため自オブジェクトをコピー
        var self = this;
        // orgchart_membersのid取得
        var orgchart_member_id = $(this).data("orgchartMemberId");
        // メンバー削除
        $.ajax({
            url: '/api/orgcharts/delete_member',
            type: 'post',
            data: {id: orgchart_member_id}
        })
        .done(function(data){
            // 自オブジェクトを削除
            $(self).closest("li").remove();
        })
        .fail(function(data){
            console.log('error');
        });
    });
    // 登録ボタンクリック
    $(document).on("click", ".btn-submit", function(){
        var valid = true;
        var data = {};
        var formObj = $(this).closest("form");
        $(formObj).find("input,select").each(function(idx, obj){
            // disabled属性のフォームは飛ばす
            if ($(obj).prop("disabled") === true) {
                return true;
            }
            // キーと値を取得
            var key = $(obj).attr("name");
            var val = $(obj).val();
            // 必須項目チェック
            if ($(obj).prop("required") === true && val === "") {
                valid = false;
                return false;
            }
            data[key] = val;
        });
        // 必須エラー
        if (valid === false) {
            confirm("メンバーを選択してください。");
            return false;
        }
        $.ajax({
            url: '/api/orgcharts/add_member',
            type: 'post',
            data: data
        })
        .done(function(data){
            // メンバーをリストに追記
            if (role === 'secretary') {
                $(".modal-member").append('\
                  <li>\
                    <span class="orgchart-member">' + data.name + '</span>\
                    <span>\
                      <a href="javascript:void(0);" class="orgchart-member-delete" data-orgchart-member-id="' + data.orgchart_member_id + '">x</a>\
                    </span>\
                  </li>\
                ');
            } else {
                $(".modal-member").append('\
                  <li>\
                    <span class="orgchart-member">' + data.name + '</span>\
                  </li>\
                ');
            }
            // フォームの状態を初期化
            $(".member-id").find("select").val("");
            $(".member-name").find("input").val("");
            // セレクトボックスから登録されたメンバーを削除
            $(".member-id").find("option").each(function(ind, obj){
                // オプションの値と登録メンバーのIDが一致
                if (parseInt(data.id) === parseInt($(obj).val())) {
                    $(obj).remove();
                }
            });
        })
        .fail(function(data){
            console.log('error');
        });
    });
});
</script>

@endpush
