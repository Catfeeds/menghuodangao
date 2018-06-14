<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
    	// if(isMobile()){
    	//     if(Request::server('HTTP_HOST')!=env('IS_MOBILE_URL')){
    	//     	redirect()->away(env('MOBILE_URL').Request::getRequestUri())->send();
    	//     }
    	// }else{
    	// 	if(Request::server('HTTP_HOST')!=env('IS_HOME_URL')){
    	// 		redirect()->away(env('HOME_URL').Request::getRequestUri())->send();
    	// 	}
    	// }

    }
}
