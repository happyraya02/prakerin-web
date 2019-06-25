@extends('layout.back')
@section('content')

<div class="container">
  <div class="row">
    <div class="cool-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>

        <div class="panel-body">
          @if (session('status'))
              <div class="alert-alert-succsess">
                {{ session('status') }}
              </div>
          @endif

          Welcome!!!
        </div>
      </div>
    </div>
  </div>
</div>

@endsection