<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Routing\Router;
use App\Models\Apply;
class ApplyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
        // $this->middleware('auth');
    }

    /**
     * 申请提交
     *
     * @return \Illuminate\Http\Response
     */
    public function apply_save(Request $request){
        $this->validate($request,[
            'name'    => 'required',
            'phone'   => 'required',
            'code'    => 'sometimes|required|captcha',
        ],[],[
            'name'=>"姓名",
            'phone'=>"联系方式",
            'address'=>"地址",
            'code'=>"验证码",
        ]);

        $info = Apply::ApplySave([
            'name'=>$request['name'],
            'phone'=>$request['phone'],
            'address'=>$request['address'],
            'age'=>$request['age'],
            'years'=>$request['years'],
            'cate_id'=>$request['cate_id'],
        ]);

        // $mail = Mail::send("emails.emails",['info'=>$info],function ($message) use ($info) {
        //     $message->to(['75531120@qq.com','715783591@qq.com'])->subject("加盟申请");
        // });

        return render("提交成功",200,$info);
    }
}
