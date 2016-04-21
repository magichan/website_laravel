@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">

        <table class="table table-striped">
          <caption>已有的 url 类型的信息种类</caption>
          <thead>
            <tr>
              <th>类型</th>
              <th>别名</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach( $connects as $key => $connect )
            <tr>
              <td>{{$key}}</td>
              <td>{{$connect['aliases']}}</td>
              <td>
                <form action="{{url('/admin/socialurl',[$key])}}" method="POST" >
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token"  value="{{csrf_token()}}">
                <button type="submit" class="btn btn-primary" > 删除 </button>
                </form>
              </td>

            </tr>

            @endforeach
          </tbody>
        </table>

    </div>
  </div>
</div>
@endsection
