<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;

use App\Service\SocialUrlConnect;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminSocialUrlController extends Controller
{
    private $socialUrlConnect;
    public function __struct(SocialUrlConnect $socialUrlConnect)
    {
      /* $this->socialUrlConnect = $socialUrlConnect; */
      $this->socialUrlConnect = new SocialUrlConnect();
      

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      /* $var = $this->socialUrlConnect->allConnects(); */
      $var = $this->socialUrlConnect;
      return view('test.test')->withVar($var);
      
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
