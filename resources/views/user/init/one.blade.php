

@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">个人信息</div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/init/one') }}">
            {!! csrf_field() !!}


            <div class="form-group{{ $errors->has('real_name') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">您的姓名</label>

              <div class="col-md-6">
                <input type="text" class="form-control" name="real_name" value="{{ $user->real_name }}">

                @if ($errors->has('real_name'))
                <span class="help-block">
                  <strong>{{ $errors->first('real_name') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">用户名</label>

              <div class="col-md-6">
                <input type="text" class="form-control" name="name" value="{{ $user->name }}">

                @if ($errors->has('name'))
                <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
              </div>
            </div>




            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">家庭住址</label>

              <div class="col-md-6">
                <input type="text" class="form-control" name="address" value="{{$user->address}}">

                @if ($errors->has('address'))
                <span class="help-block">
                  <strong>{{ $errors->first('address') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('admission_year') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">入学年份[搞成选择框]</label>

              <div class="col-md-6">
                <input type="text" class="form-control" name="admission_year" value="{{$user->admission_year}}">

                @if ($errors->has('admission_year'))
                <span class="help-block">
                  <strong>{{ $errors->first('admission_year') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
              <label >性别</label>
              <div>
                <label class="checkbox-inline">
                  <input type="radio" name="gender" 
                                      value="female" {{$user->gender=='female'?'checked':''}}> 女
                </label>
                <label class="checkbox-inline">
                  <input type="radio" name="gender"  
                                      value="male" {{$user->gender=='male'?'checked':''}}> 男 
                </label>
              </div>

              @if ($errors->has('gender'))
              <span class="help-block">
                <strong>{{ $errors->first('gender') }}</strong>
              </span>
              @endif
            </div>

            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
            <label >是否毕业</label>
            <div>
              <label class="checkbox-inline">
                <input type="radio" name="status" 
                                    value="student" {{$user->status=='student'?'checked':''}}> 否
              </label>
              <label class="checkbox-inline">
                <input type="radio" name="status"  
                                    value="graduate" {{$user->status=='graduate'?'checked':''}}> 是 
              </label>

            </div>
              @if ($errors->has('status'))
              <span class="help-block">
                <strong>{{ $errors->first('status') }}</strong>
              </span>
              @endif

            </div>

            <div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">电话 </label>

              <div class="col-md-6">
                <input type="text" class="form-control" name="tel" value="{{$user->tel}} " >

                @if ($errors->has('tel'))
                <span class="help-block">
                  <strong>{{ $errors->first('tel') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('group') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">小组[多选] </label>

              <div class="col-md-6">
                <input type="text" class="form-control" name="group" value="{{$user->group}}" >

                @if ($errors->has('group'))
                <span class="help-block">
                  <strong>{{ $errors->first('group') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('self_introduce') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">个人介绍</label>

              <div class="col-md-6">
                <textarea  class="form-control"  rows=5 name="self_introduce" >
                  {{$user->self_introduce}}
                </textarea>

                @if ($errors->has('self_introduce'))
                <span class="help-block">
                  <strong>{{ $errors->first('self_introduce') }}</strong>
                </span>
                @endif
              </div>
            </div>


            <div class="form-group{{ $errors->has('student_id') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">学号{选择 未毕业出现 }</label>

              <div class="col-md-6">
                <input type="text" class="form-control" name="student_id" value="{{$user->student_id}} " >

                @if ($errors->has('student_id'))
                <span class="help-block">
                  <strong>{{ $errors->first('student_id') }}</strong>
                </span>
                @endif
              </div>
            </div>


            <div class="form-group{{ $errors->has('class') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">班级{选择 未毕业出现 }</label>

              <div class="col-md-6">
                <input type="text" class="form-control" name="class" value="{{$user->class}} " >

                @if ($errors->has('class'))
                <span class="help-block">
                  <strong>{{ $errors->first('class') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('company ') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">公司{选择 已毕业 出现}</label>

              <div class="col-md-6">
                <input type="text" class="form-control" name="company" value="{{$user->company}} " >

                @if ($errors->has('company'))
                <span class="help-block">
                  <strong>{{ $errors->first('company') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">职位{选择已毕业出现}</label>

              <div class="col-md-6">
                <input type="text" class="form-control" name="position" value="{{$user->position}}" >

                @if ($errors->has('position'))
                <span class="help-block">
                  <strong>{{ $errors->first('position') }}</strong>
                </span>
                @endif
              </div>




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

