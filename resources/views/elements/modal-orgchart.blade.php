
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
                  <select id="orgchartMember[member_id]" class="form-control" name="orgchartMember[member_id]" value="{{ old('member_id')  }}" requird>
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
            <ul class="modal-member list-inline">
            </ul>
          </div>
          
        </div>
      </div>
    </div>
  </div>
@push('script')
<script>
$(function(){
    $(document).on("click", ".member-name", function(){
        $(this).find("input").prop("disabled", false);
        $(".member-id").find("select").val("").prop("disabled", true);
    });
    $(document).on("click", ".member-id", function(){
        $(this).find("select").prop("disabled", false);
        $(".member-name").find("input").val("").prop("disabled", true);
    });
    $(document).on("click", ".btn-submit", function(){
        var data = {};
        var formObj = $(this).closest("form");
        $(formObj).find("input,select").each(function(idx, obj){
            var key = $(obj).attr("name");
            var val = $(obj).val();
            data[key] = val;
        });
        $.ajax({
            url: '/api/orgcharts/add_member',
            type: 'post',
            data: data
        })
        .done(function(data){
            // メンバーをリストに追記
            $(".modal-member").append("\
              <li>\
                <span>" + data.name + "</span>\
              </li>\
            ");
            // セレクトボックスから登録されたメンバーを削除
        })
        .fail(function(data){
            console.log('error');
        });
    });
});
</script>

@endpush
