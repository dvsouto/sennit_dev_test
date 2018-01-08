@extends('templates/default')

@section('template')

<div>

  <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#netflix-tab" aria-controls="netflix-tab" role="tab" data-toggle="tab"><i class="fa fa-film" aria-hidden="true"></i> Netflix</a></li>
        <li role="presentation"><a href="#api-tab" aria-controls="api-tab" role="tab" data-toggle="tab"><i class="fa fa-cog" aria-hidden="true"></i> API</a></li>
    </ul>

  <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="netflix-tab" ng-controller="NetflixController">
            @include('main.netflix')
        </div>

        <div role="tabpanel" class="tab-pane fade" id="api-tab">
            @include('main.api')
        </div>
    </div>

</div>

@endsection