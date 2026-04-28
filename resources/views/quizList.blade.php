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
    <x-navbar name={{ $name }}></x-navbar>
        
    <div class=" flex flex-col items-center justify-center py-10">
            <h1 class=" text-2xl text-gray-800 mb-6 text-center font-bold">Category Name : {{$category}}</h1>
            <a class="bg-green-800 rounded-xl px-6 py-2 text-white hover:bg-green-600" href="/addQuiz">Back</a>
        <div class="pt-5 w-200">
            <ul class="border border-gray-200">
                <li class="p-2">
                        <ul class="flex justify-between font-bold">
                            <li>Mcqs</li>
                            <li>Questions</li>
                            <li>Action</li>
                        </ul>
                    </li>
                @foreach ($quizData as $item)
                    <li class=" even:bg-gray-200 p-2">
                        <ul class="flex justify-between">
                            <li>{{$item->id}}</li>
                            <li>{{$item->question}}</li>
                            <li>
                                <a href="/showQuiz/{{$item->id}}/{{$item->name}}" class="text-blue-600 hover:text-blue-400">View</a>
                            </li>
                        </ul>
                    </li>
                @endforeach
                
            </ul>
        </div>
    </div>
</body>

</html>
