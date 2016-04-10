
@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">个人信息</div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/info') }}">
            {!! csrf_field() !!}

            @if($user->active==false)
            尽快激活
            @endif
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">Name</label>

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
              <label class="col-md-4 control-label">入学年份</label>

              <div class="col-md-6">
                <input type="text" class="form-control" name="admission_year" value="{{$user->admission_year}}">

                @if ($errors->has('admission_year'))
                <span class="help-block">
                  <strong>{{ $errors->first('admission_year') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <label >性别</label>
            <div>
              <label class="checkbox-inline">
                <input type="radio" name="sex" 
                                    value="female" {{$user->sex=='female'?'checked':''}}> 女
              </label>
              <label class="checkbox-inline">
                <input type="radio" name="sex"  
                                    value="male" {{$user->sex=='male'?'checked':''}}> 男 
              </label>
            </div>

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





            <div class="form-group{{ $errors->has('class') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">班级</label>

              <div class="col-md-6">
                <input type="text" class="form-control" name="class" value="{{$user->class}} " >

                @if ($errors->has('class'))
                <span class="help-block">
                  <strong>{{ $errors->first('class') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('group') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">小组 </label>

              <div class="col-md-6">
                <input type="text" class="form-control" name="group" value="{{$user->group}}" >

                @if ($errors->has('group'))
                <span class="help-block">
                  <strong>{{ $errors->first('group') }}</strong>
                </span>
                @endif
              </div>
            </div>


            <div class="form-group{{ $errors->has('company ') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">公司</label>

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
              <label class="col-md-4 control-label">职位</label>

              <div class="col-md-6">
                <input type="text" class="form-control" name="position" value="{{$user->position}}" >

                @if ($errors->has('position'))
                <span class="help-block">
                  <strong>{{ $errors->first('position') }}</strong>
                </span>
                @endif
              </div>
            </div><label for="name"> 选择私有信息，这些信息不会被协会成员查询到</label>
            <div>
              <label class="checkbox-inline">
                <input type="checkbox" name="address_authority"  value="0" {{ $user->address_authority==false?'checked':'' }}> 家庭住址
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" name="tel_authority" value="0" {{ $user->tel_authority==false?'checked':''}}> 电话
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" name="class_authority" value="0" {{ $user->class_authority==false?'checked':''}}> 班级 
              </label>
              @if($user->status=='graduate')
              <label class="checkbox-inline">
                <input type="checkbox" name="company_authority" value="0" {{ $user->company_authority==false?'checked':''}}> 公司 
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" name="position_authority" value="0" {{ $user->position_authority==false?'checked':''}}> 职位
              </label>
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

