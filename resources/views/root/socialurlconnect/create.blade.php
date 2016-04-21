@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">创建一个新的 url 类型的属性 </div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/socialurl/') }}">
            {!! csrf_field() !!}

            <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label"> Key 值 [不可与其他属性重复]</label>

              <div class="col-md-6">
                <input  class="form-control" name="key" value="{{ old('key') }}">

                @if ($errors->has('key'))
                <span class="help-block">
                  <strong>{{ $errors->first('key') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('aliases') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">别名 [提供给普通用户使用的名字，可以与 key 值一致 ]</label>

              <div class="col-md-6">
                <input  class="form-control" name="aliases">

                @if ($errors->has('aliases'))
                <span class="help-block">
                  <strong>{{ $errors->first('aliases') }}</strong>
                </span>
                @endif
              </div>
            </div>


            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  创建 
                </button>
              </div>
            </div>

          </form>

        </div>
      </div>
    </div>
    @endsection
