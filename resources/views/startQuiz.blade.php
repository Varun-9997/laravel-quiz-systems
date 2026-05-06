<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ str_replace('-',' ',$quizName) }}</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-user-navbar ></x-user-navbar>
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
        @if(Session('message-success'))
        <div>
            <p class=" text-green-500 font-bold">{{ Session('message-success') }}</p>
        </div>
        @endif
    <h1 class="text-4xl text-center text-green-800 mb-6 font-bold ">
    {{ str_replace('-',' ',$quizName) }}
    </h1>
    <h2 class="text-lg text-center text-green-800 mb-6 font-bold ">
        This Quiz container {{$quizCount}} Questions and no limit to attempt this Quiz</h2>
        <h1 class="text-2xl text-center text-green-800 mb-6 font-bold ">
        Good Luck
    </h1>

    @if (session('user'))
        <a type="submit" href="/mcq/{{ Session('firstMcq')-> id.'/'. $quizName }}" class=" bg-blue-800 rounded-md px-2 py-2 text-white hover:bg-blue-600">
        Start Quiz
        </a>
        @else
        <div class=" flex flex-col gap-3">
        <a type="submit" href="/userSignupQuiz" class=" bg-blue-800 rounded-md px-2 py-2 text-white hover:bg-blue-600">
        Signup to Start Quiz
        </a>
        <a type="submit" href="/userLoginQuiz" class=" bg-blue-800 rounded-md px-2 py-2 text-white hover:bg-blue-600">
        Login to Start Quiz
        </a>
        </div>
    @endif
    
  

</div>
</body>
</html>