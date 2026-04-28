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
        
    <div class=" flex flex-col items-center justify-center py-10">
            <h1 class=" text-2xl text-gray-800 mb-6 text-center font-bold">Category Name : {{$category}}</h1>
        <div class="pt-5 w-200">
            <ul class="border border-gray-200">
                <li class="p-2">
                        <ul class="flex justify-between font-bold">
                            <li class="50">Quiz Id</li>
                            <li class="50">Name</li>
                            <li class="50">Mcq Count</li>
                            <li class="50">Action</li>
                        </ul>
                    </li>
                @foreach ($quizData as $item)
                    <li class=" even:bg-gray-200 p-2">
                        <ul class="flex justify-between">
                            <li class="50">{{$item->id}}</li>
                            <li class="50">{{$item->name}}</li>
                            <li class="50">{{$item->mcq_count}}</li>
                            <li class="50">
                                <a href="/startQuiz/{{$item->id}}/{{ $item->name }}" class="text-green-600 font-bold hover:text-blue-400">
                                    Attemp Quiz
                                </a>
                            </li>
                        </ul>
                    </li>
                @endforeach
                
            </ul>
        </div>
    </div>
</body>

</html>
