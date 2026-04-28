<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Mcq;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    public function welcome()
    {
        $categories = Category::withCount('quizzes')->get();

        return view('welcome', ['categories' => $categories]);
    }

    public function userQuizList($id, $category)
    {
        $quizData = Quiz::withCount('Mcq')->where('category_id', $id)->get();

        return view('userQuizList', ['quizData' => $quizData, 'category' => $category]);
    }

    public function userSignup(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required | min:3',
            'email' => 'required | email | unique:users',
            'password' => 'required | min:3 | confirmed',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            Session::put('user', $user);
            if (Session::has('quizUrl')) {
                $url = Session::get('quizUrl');
                Session::forget('quizUrl');

                return redirect($url);
            }

            return redirect('/');
        }
    }

    public function startQuiz($id, $name)
    {
        $quizCount = Mcq::where('quiz_id', $id)->count();
        $firstMcq = Mcq::where('quiz_id', $id)->first();

        if (! $firstMcq) {
            return 'No questions found.';
        }

        Session::put('firstMcq', $firstMcq);

        $quizName = $name;

        return view('startQuiz', ['quizName' => $quizName, 'quizCount' => $quizCount]);
    }

    public function userLogout()
    {
        Session::forget('user');

        return redirect('/');
    }

    public function userSignupQuiz()
    {
        Session::put('quizUrl', url()->previous());

        return view('userSignup');
    }

    public function userLogin(Request $request)
    {
        $validation = $request->validate([
            'email' => 'required | email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return 'User not valid, please check email and password again.';
        }

        if ($user) {
            Session::put('user', $user);
            if (Session::has('quizUrl')) {
                $url = Session::get('quizUrl');
                Session::forget('quizUrl');

            return redirect('/');
            }

            return redirect('/');
        }
    }

    public function userLoginQuiz()
    {
        Session::put('quizUrl', url()->previous());

        return view('userLogin');
    }

    public function mcq($id, $name)
    {
        $currentQuiz = [];
        $currentQuiz['totalMcq']= Mcq::where('quiz_id', Session::get('firstMcq')['quiz_id'])->count();
        $currentQuiz['currentMcq'] = 1;
        $currentQuiz['quizName']= $name;
        $currentQuiz['quizId']= Session::get('firstMcq')['quiz_id'];
        Session::put('currentQuiz',$currentQuiz);
        $mcqData = Mcq::find($id);
        return view('mcqPage', ['quizName'=>$name, 'mcqData'=>$mcqData]);
    }

    function submitAndNext($id){
        $currentQuiz = Session::get('currentQuiz');
        $currentQuiz['currentMcq'] += 1;
        $mcqData = Mcq::where([
            ['id','>',$id],
            ['quiz_id','=',$currentQuiz['quizId']]
        ])->first();

        Session::put('currentQuiz', $currentQuiz);

        if($mcqData){
            return view('mcqPage', ['quizName'=>$currentQuiz['quizName'], 'mcqData'=>$mcqData]);
        }

        return 'result Page';
    }
}
