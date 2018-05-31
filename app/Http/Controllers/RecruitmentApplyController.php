<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;
// use Illuminate\Routing\Router;
use App\Models\RecruitmentApply;
class RecruitmentApplyController extends Controller
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
    public function recruitment_apply_save(Request $request){
        $this->validate($request,[
            'name'       => 'required',
            'article_id' => 'required',
            'phone'      => 'required',
            'sex'        => 'required',
            'email'      => 'required|email',
            'origin'     => 'required',
            'profession' => 'required',
        ],[],[
            'name'       =>"姓名",
            'phone'      =>"联系方式",
            'email'      =>"邮箱",
            'address'    =>"地址",
            'code'       =>"性别",
            'origin'     =>"籍贯",
            'profession' =>"专业",
            'article_id' =>"应聘岗位",
        ]);

        $resume_file = '';
        if($request['resume_file']){
            $resume_file = upload_file($request['resume_file']);
        }
        
        $info = RecruitmentApply::RecruitmentApplySave([
            'resume_file'            =>$resume_file,
            'article_id'             =>$request['article_id'],
            'name'                   =>$request['name'],
            'sex'                    =>$request['sex'],
            'marriage'               =>$request['marriage'],
            'email'                  =>$request['email'],
            'nation'                 =>$request['nation'],
            'age'                    =>$request['age'],
            'political_status'       =>$request['political_status'],
            'origin'                 =>$request['origin'],
            'education_level'        =>$request['education_level'],
            'graduated_school'       =>$request['graduated_school'],
            'profession'             =>$request['profession'],
            'graduated_time'         =>$request['graduated_time'],
            'foreign_language_level' =>$request['foreign_language_level'],
            'position'               =>$request['position'],
            'phone'                  =>$request['phone'],
            'resume_file'            =>$resume_file,
            'resume'                 =>$request['resume'],
        ]);

        return render("提交成功",200,$info);
    }
}
