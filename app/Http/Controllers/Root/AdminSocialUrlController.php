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
    public function destroy($type)
    {
      $flag =   $this->socialUrlConnect->deleteConnect($type);
       return $flag==true?redirect('admin/socialurl'):redirect('error');
    }
}
