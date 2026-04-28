<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Categories Page</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-user-navbar ></x-user-navbar>
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
    <h1 class="text-4xl text-center text-green-800 mb-6 font-bold ">
    {{ $quizName }}
    </h1>
    <h2 class="text-lg text-center text-green-800 mb-6 font-bold ">
        This Quiz container {{$quizCount}} Questions and no limit to attempt this Quiz</h2>
        <h1 class="text-2xl text-center text-green-800 mb-6 font-bold ">
        Good Luck
    </h1>

    @if (session('user'))
        <a type="submit" href="" class=" bg-blue-800 rounded-md px-2 py-2 text-white hover:bg-blue-600">
        Start Quiz
        </a>
        @else
        <a type="submit" href="/userSignupQuiz" class=" bg-blue-800 rounded-md px-2 py-2 text-white hover:bg-blue-600">
        Login/Signup for Start Quiz
        </a>
    @endif
    
  

</div>
</body>
</html>