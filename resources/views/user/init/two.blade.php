@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">选择只能被管理员看到的信息</div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/init/two') }}">
            {!! csrf_field() !!}

<div class="checkbox">
  <label>
    <input type="checkbox" name="private_choice[]" value="tel" {{$user->tel_authority==0?'checked':''}} >
电话
  </label>
</div>
<div class="checkbox">
  <label>
    <input type="checkbox" name="private_choice[]" value="address" {{$user->address_authority==0?'checked':''}} >
地址
  </label>
</div>

<div class="checkbox">
  <label>
    <input type="checkbox" name="private_choice[]" value="company" {{$user->company_authority==0?'checked':''}} >
公司
  </label>
</div>

<div class="checkbox">
  <label>
    <input type="checkbox" name="private_choice[]"  value="position" {{$user->position_authority==0?'checked':''}}  >
职业
  </label>
</div>

 

<div class="checkbox">
  <label>
    <input type="checkbox"  name="private_choice[]"  value="gender" {{$user->gender_authority==0?'checked':''}}>
性别
  </label>
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

