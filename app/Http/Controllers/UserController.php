<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Mcq;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Record;
use App\Models\Mcq_Record;
use App\Mail\verifyUser;
use App\Mail\UserForgotPassword;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Spatie\Browsershot\Browsershot;

class UserController extends Controller
{
    //
    public function welcome()
    {
        $categories = Category::withCount('quizzes')->orderBy('quizzes_count','desc')->take(5)->get();
        $quizData = Quiz::withCount('Records')->orderBy('records_count','desc')->take(5)->get();
        return view('welcome', ['categories' => $categories, 'quizData' => $quizData]);
    }

    function categories(){
        $categories=Category::withCount('quizzes')->orderBy('quizzes_count','desc')->paginate(4);
   return view('category-list',['categories'=>$categories]);
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

        $link = Crypt::encryptString($user->email);
        $link = url('/user-verify'.$link);
        Mail::to($user->email)->send(new verifyUser($link));

        if ($user) {
            Session::put('user', $user);
            if (Session::has('quizUrl')) {
                $url = Session::get('quizUrl');
                Session::forget('quizUrl');

                return redirect($url)->with('message-success', "User registered successfully, Please check email to verify account");
            }

            return redirect('/')->with('message-success', "User registered successfully, Please check email to verify account");
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
            return redirect('userLogin')->with('message-error', "User not valid, Please check email and password again");
        }

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

    public function userLoginQuiz()
    {
        Session::put('quizUrl', url()->previous());

        return view('userLogin');
    }

    public function mcq($id, $name)
    {
        $record = new Record();
        $record->user_id = Session::get('user')['id'];
        $record->quiz_id = Session::get('firstMcq')['quiz_id'];
        $record->status = 1;
        if($record->save()){
            $currentQuiz = [];
        $currentQuiz['totalMcq']= Mcq::where('quiz_id', Session::get('firstMcq')['quiz_id'])->count();
        $currentQuiz['currentMcq'] = 1;
        $currentQuiz['quizName']= $name;
        $currentQuiz['quizId']= Session::get('firstMcq')['quiz_id'];
        $currentQuiz['recordId']= $record->id;
        Session::put('currentQuiz',$currentQuiz);
        $mcqData = Mcq::find($id);
        return view('mcqPage', ['quizName'=>$name, 'mcqData'=>$mcqData]);
        }else{
            return "Something went wrong";
        }

    }

    function submitAndNext(Request $request, $id){
        $currentQuiz = Session::get('currentQuiz');
        $currentQuiz['currentMcq'] += 1;
        $mcqData = Mcq::where([
            ['id','>',$id],
            ['quiz_id','=',$currentQuiz['quizId']]
        ])->first();

        $isExist = Mcq_Record::where([
            ['record_id', '=', $currentQuiz['recordId']],
            ['mcq_id', '=', $request->id],
        ])->get();

        $mcq_record = new Mcq_Record();
        $mcq_record->record_id = $currentQuiz['recordId'];
        $mcq_record->user_id = Session::get('user')['id'];
        $mcq_record->mcq_id = $id;
        $mcq_record->selected_ans = $request->option;

        if($request->option == Mcq::find($request->id)->correct_ans){
            $mcq_record->is_correct = 1;
        }else{
            $mcq_record->is_correct = 0;
        }

        if(!$mcq_record->save()){
            return "Something went wrong";
        }
         
        Session::put('currentQuiz', $currentQuiz);

        if($mcqData){
            return view('mcqPage', ['quizName'=>$currentQuiz['quizName'], 'mcqData'=>$mcqData]);
        }

        $resultData = MCQ_record::WithMCQ()->where('record_id',$currentQuiz['recordId'])->get();
        $correctAnswers = MCQ_record::where([
            ['record_id','=',$currentQuiz['recordId']],
            ['is_correct','=',1],
        ])->count();

        $record = Record::find($currentQuiz['recordId']);
        if($record){
            $record->status = 2;
            $record->update();
        }

        return view('quizResult', ['resultData'=>$resultData, 'correctAnswers' => $correctAnswers]);
    }

    function userDetails(){
        $quizRecord = Record::WithQuiz()->where('user_id',Session::get('user')['id'])->get();
        return view('userDetails',['quizRecord'=>$quizRecord]);
    }

    function quizSearch(Request $request){
        $quizData = Quiz::withCount('Mcq')->where('name','like', '%'. $request->search.'%')->get();

        return view('quiz-search',['quizData'=>$quizData, 'quiz'=>$request->search]);
    }

    function verifyUser($email){
        $orgEmail = Crypt::decryptString($email); 
        $user = User::where('email',$orgEmail)->first();
        if($user){
            $user->active = 2;
            
            if($user->save()){
                return redirect('/')->with('message-success', "User verified successfully");
            }
        }
    }

    function userForgotPassword(Request $request){
         $link = Crypt::encryptString($request->email);
         $link = url('/user-forgot-password/'.$link);
         Mail::to($request->email)->send(new userForgotPassword($link));
         return redirect('/')->with('message-success', "Please check email to set new password.");
    }

    
    function userResetForgotPassword($email){
        $orgEmail = Crypt::decryptString($email);
        return view('user-set-forgot-password', ['email'=>$orgEmail]);
    }

    function userSetForgotPassword(Request $request){
        $validation = $request->validate([
            'email' => 'required | email',
            'password' => 'required | min:3 | confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if($user){
            $user-> password = Hash::make($request->password);
            if($user->save()){
                return redirect('userLogin')->with('message-success', "New password created.");
            }
        }
    }

    function certificate(){
        $data = [];
        $data['quiz'] = str_replace('-',' ',Session::get('currentQuiz')['quizName']);      
        $data['name'] = Session::get('user')['name'];
        
        return view('certificate', ['data'=>$data]);
    }
    
    function downloadCertificate(){
        $data = [];
        $data['quiz'] = str_replace('-',' ',Session::get('currentQuiz')['quizName']);      
        $data['name'] = Session::get('user')['name'];
        
        $html= view('download-certificate', ['data'=>$data])->render();
        return response(
            Browsershot::html($html)->setChromePath('C:\Program Files\Google\Chrome\Application\chrome.exe')
        ->pdf()
            )->withHeaders([
                'Content-type'=>"application/pdf",
                'Content-disposition'=>"attachment;filename=certificate.pdf"
            ]);
    }
}
