@extends('layouts.app')
@push('style')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis.min.css" integrity="sha256-iq5ygGJ7021Pi7H5S+QAUXCPUfaBzfqeplbg/KlEssg=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis-timeline-graph2d.min.css" integrity="sha256-ttXXbnaumOzkd0djY9bs4c5n86l4gmYrYo6BBUl6YPA=" crossorigin="anonymous" />
@endpush
@push('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js" integrity="sha256-ABVkpwb9K9PxubvRrHMkk6wmWcIHUE9eBxNZLXYQ84k=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/locale/ja.js" integrity="sha256-UFPkL6yuXAPDFXtevtKmYzOZZdogHrgcHwUe4LzTIRM=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis.min.js" integrity="sha256-JuQeAGbk9rG/EoRMixuy5X8syzICcvB0dj3KindZkY0=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis-timeline-graph2d.min.js" integrity="sha256-v9Qo6pYzFF2g0RUa5jlrK3HO2YfYXnj5aXQzPJJ46wY=" crossorigin="anonymous"></script>
  <script type="text/javascript">

  $.ajax({
      url: '/api/schedules/show',
  })
  .done(function(data){
      // create a data set with groups
      var groups = new vis.DataSet(data['group']);
      // create a dataset with items
      var items = new vis.DataSet(data['item']);
      // options
      var options = data['option'];
      // create visualization
      var container = document.getElementById('visualization');
      //
      var timeline = new vis.Timeline(container);
      timeline.setOptions(options);
      timeline.setGroups(groups);
      timeline.setItems(items);
  })
  .fail(function(data){
      console.log('error');
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
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">スケジュール</li>
            </ol>
          </nav>
        </div>

        <div class="panel-body">
          <div id="visualization" data-role="{{ $user->role }}"></div>
        </div>

      </div>
    </div>
  </div>

</div>
@endsection
