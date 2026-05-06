<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MCQ Page</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-user-navbar ></x-user-navbar>
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
    <h1 class="text-4xl text-center text-green-800 mb-6 font-bold ">
        {{ $quizName }}
    </h1>
    <h1 class="text-4xl text-center text-green-800 mb-6 font-bold ">
        Question No. {{ session('currentQuiz')['totalMcq'] }}
    </h1>
    <h1 class="text-2xl text-center text-green-800 mb-6 font-bold ">
        {{ session('currentQuiz')['currentMcq'] }} of  {{ session('currentQuiz')['totalMcq'] }}
    </h1>
    <div class="bg-white mt-2 p-4 shadow-xl rounded-2xl w-md ">
        <h1 class=" font-bold text-blue-600 pl-2">Q. {{ $mcqData->question }}</h1>
        <form action="/submitNext/{{$mcqData->id}}" method="POST" class=" flex flex-col space-y-4 mt-2">
            <input type="hidden" name="id" value="{{ $mcqData->id }}">
            @csrf
            <label for="option_1" class="flex border p-2 m-2 rounded-lg hover:bg-blue-300 cursor-pointer shadow-lg">
                <input id="option_1" class="form-radio text-blue-500 m-1" type="radio" value="a" name="option">
                <span class=" text-green-800">{{ $mcqData->a}}</span>
            </label>
            <label for="option_2" class="flex border p-2 m-2 rounded-lg hover:bg-blue-300 cursor-pointer shadow-lg">
                <input id="option_2" class="form-radio text-blue-500 m-1" type="radio" value="b" name="option">
                <span class=" text-green-800">{{ $mcqData->b }}</span>
            </label>
            <label for="option_3" class="flex border p-2 m-2 rounded-lg hover:bg-blue-300 cursor-pointer shadow-lg">
                <input id="option_3" class="form-radio text-blue-500 m-1" type="radio" value="c" name="option">
                <span class=" text-green-800">{{ $mcqData->c }}</span>
            </label>
            <label for="option_4" class="flex border p-2 m-2 rounded-lg hover:bg-blue-300 cursor-pointer shadow-lg">
                <input id="option_4" class="form-radio text-blue-500 m-1" type="radio" value="d" name="option">
                <span class=" text-green-800">{{ $mcqData->d }}</span>
            </label>
            <button type="submit" class="bg-green-600 hover:bg-green-500 cursor-pointer p-2 mt-2 text-white rounded-xl w-full">
                Submit Answer and Next
            </button>
        </form>

    </div>
    
</div>
<x-user-footer></x-user-footer>
</body>
</html>