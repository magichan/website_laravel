<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;

use App\Service\SocialUrlConnect;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminSocialUrlController extends Controller
{
    private $socialUrlConnect;
    public function __construct(SocialUrlConnect $socialUrlConnect)
    {
      $this->socialUrlConnect = $socialUrlConnect;
      $this->socialUrlConnect->init();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $connects = $this->socialUrlConnect->allConnects();
      return view('root.socialurlconnect.index')->withConnects($connects);
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('root.socialurlconnect.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
        'key'=>'required',
        'aliases'=>'required'
      ]);

      $key = $request->input('key');
      $aliases = $request->input('aliases');

      $flag = $this->socialUrlConnect->addUrlConnect($key,$aliases); // 将属性添加其中

      if($flag){
        // 成功返回前一页面
        return redirect('admin/socialurl');
      }else{
        // 失败，返回一个错误页面，但这地方可以自定义一个 validate 规则，用于处理这个返回错误，但太耗费时间了，就没有做
        return redirect('error');
      }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($type)
    {
      $flag =   $this->socialUrlConnect->deleteConnect($type);
       return $flag==true?redirect('admin/socialurl'):redirect('error');
    }
}
