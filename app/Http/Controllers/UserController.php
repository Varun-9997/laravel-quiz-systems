<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

use App\Models\Category;
use App\Models\Quiz;
use App\Models\Mcq;
use App\Models\User;


use Illuminate\Http\Request;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{
    //
    function welcome(){
        $categories = Category::withCount('quizzes')->get();
        return view('welcome',['categories'=>$categories]);
    }

    function userQuizList($id, $category){
        $quizData = Quiz::withCount('Mcq')->where('category_id', $id)->get();
        return view('userQuizList',["quizData"=> $quizData, "category"=> $category]);
    }

    function userSignup(Request $request){
        $validation = $request->validate([
        "name"=>"required | min:3",
        "email"=>"required | email | unique:users",
        "password"=>"required | min:3 | confirmed",
    ]);
    $user = User::create([
        "name"=>$request->name,
        "email"=>$request->email,
        "password"=>Hash::make($request->password),
    ]);

    if($user){
        Session::put('user',$user);
        if(Session::has('quizUrl')){
            $url = Session::get('quizUrl');
            Session::forget('quizUrl');
            return redirect($url);
        }
        return redirect('/');
    }
    }
    
    function startQuiz($id, $name){
        $quizCount =Mcq::where('quiz_id',$id)->count();
        $mcqs =Mcq::where('quiz_id',$id)->get();
        $quizName =$name;
        return view('startQuiz',['quizName'=>$quizName,'quizCount'=>$quizCount]);
    }

    function userLogout(){
        Session::forget('user');
        return redirect('/');
    }
    
    function userSignupQuiz(){
        Session::put('quizUrl',url()->previous());
        return view('userSignup');
    }

}
