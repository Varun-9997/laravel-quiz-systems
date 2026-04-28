<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Current Quiz Mcqs</title>
    @vite('resources/css/app.css')
</head>

<body>
<x-user-navbar></x-user-navbar>
<div class="flex flex-col min-h-screen items-center bg-gray-100">
    <h1 class=" text-4xl text-blue-500 font-bold p-5">Check your Skills</h1>
    <div class=" w-full max-w-md">
        <div class="relative">
            <input class="w-full px-4 py-3 rounded-lg shadow-lg text-gray-700 border border-gray-300" type="text"
             placeholder="Search Quiz...">
             <button class=" absolute right-2 top-3">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f">
                <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 
                184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q
                -75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                </button>
        </div>
    </div>
    <div class="pt-5 w-200 mt-5">
            <ul class="border border-gray-200">
                <li class="p-2">
                        <ul class="flex justify-between font-bold">
                            <li class=" w-30">Sr. No.</li>
                            <li class=" w-70">Name</li>
                            <li class=" w-70">Total Quiz</li>
                            <li class=" w-30">Action</li>
                        </ul>
                    </li>
                @foreach ($categories as $key=>$category)
                    <li class=" even:bg-gray-200 p-2">
                        <ul class="flex justify-between">
                            <li class=" w-30">{{ $key + 1 }}</li>
                            <li class=" w-70">{{$category->name}}</li>
                            <li class=" w-70">{{$category->quizzes_count}}</li>
                            <li class="flex gap-3 w-30">
                            <a href="userQuizList/{{$category->id}}/{{$category->name}}" class="text-blue-600 hover:text-blue-400">View</a>
                        </li>
                        </ul>
                    </li>
                @endforeach
                
            </ul>
        </div>
</div>

<x-user-footer></x-user-footer>

</body>