@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">填上你有的友链 完全的 url 形式</div >
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/init/four') }}">
            {!! csrf_field() !!}

@foreach( $social_url_connects as $key  => $var )
            <div class="form-group{{ $errors->has($key) ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">{{$var['aliases']}}  </label>

              <div class="col-md-6">
                <input type="url" class="form-control" name="{{$key}}" value="{{old($key)}}">

                @if ($errors->has($key) )
                <span class="help-block">
                  <strong>{{ $errors->first($key) }}</strong>
                </span>
                @endif
              </div>
            </div>
@endforeach


            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-btn fa-user"></i>提交
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

