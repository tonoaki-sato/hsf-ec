@extends('layouts.app')
@push('style')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis.min.css" integrity="sha256-iq5ygGJ7021Pi7H5S+QAUXCPUfaBzfqeplbg/KlEssg=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis-network.min.css" integrity="sha256-tTIVWrgsLDcekkoaiqePYP86joMAiyp4KqEswPMmTfQ=" crossorigin="anonymous" />
  <link rel="stylesheet" href="{{ asset('css/vis-network.orgchart.css') }}">
@endpush
@push('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis.min.js" integrity="sha256-JuQeAGbk9rG/EoRMixuy5X8syzICcvB0dj3KindZkY0=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis-network.min.js" integrity="sha256-z4uJf4qxa6fOwudp++XaHza5NiKuOkELRsT6DaF/2n0=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/vis-network.util.js') }}"></script>
  <script src="{{ asset('js/vis-network.orgchart.js') }}"></script>
  <script type="text/javascript">
    $(function(){
        //
        $.ajax({
            url: '/api/orgcharts/get',
            type: 'get',
        })
        .done(function(data){
            init(data);
        })
        .fail(function(data){
            console.log('error');
        });
    });
  </script>
@endpush
@section('content')
<div class="container">

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">

        <div class="panel-heading">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page">組織図</li>
            </ol>
          </nav>
        </div>

        <div class="panel-body">
          <div id="mynetwork"></div>
        </div>

      </div>
    </div>
  </div>

  <div id="network-popUp">
    <span id="operation">node</span> <br>
    <table style="margin:auto;">
      <tr>
        <td>id</td>
        <td><input id="node-id" value="new value" /></td>
      </tr>
      <tr>
        <td>label</td><td><input id="node-label" value="new value" /></td>
      </tr>
    </table>
    <input type="button" value="save" id="saveButton" />
    <input type="button" value="cancel" id="cancelButton" />
  </div>

</div>
@endsection
