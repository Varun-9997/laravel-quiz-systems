<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Quiz Page</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-navbar name={{ $name }}></x-navbar>

    <div class=" flex flex-col items-center justify-center py-10">
        <div class=" bg-slate-50 p-8 rounded-lg shadow-lg w-full max-w-md ">
            @if (!Session::has('quizDetails'))
                <h1 class=" text-2xl text-gray-800 mb-6 text-center font-bold">Add Quiz</h1>
            <form action="/addQuiz" method="GET" class=" space-y-4 ">
                @csrf
                <div class="">
                    <input type="text" placeholder="Enter quiz name" name="quiz"
                        class=" w-full px-2 py-2 border border-gray-500 rounded-xl focus:outline-none">
                </div>
                <div class="">
                    <select name="category_id"
                        class=" w-full px-2 py-2 border border-gray-500 rounded-xl focus:outline-none">
                        @foreach ($categories as $category)
                            <option value={{$category->id}} > {{$category->name}} </option>
                        @endforeach
                        
                    </select>
                </div>

                <button type="submit"
                    class="w-full bg-blue-800 rounded-xl px-2 py-2 text-white hover:bg-blue-600">Add</button>
            </form>
            @else
            <p class="text-center text-green-600 font-bold">{{session('quizDetails')['name']}}</p>
            <p class="text-center text-green-600 font-bold">Total Mcqs: {{$totalMcqs}}
                @if ($totalMcqs > 0)
                    <a class="text-yellow-500 text-sm" href="showQuiz/{{session('quizDetails')['id']}}">Total Mcqs</a>
                @endif
            </p>
                <h1 class=" text-2xl text-gray-800 mb-6 text-center font-bold">Add MCQ's</h1>
                <form action="/addMcq" method="POST" class="space-y-4">
                    @csrf
                    <div class="">
                    <textarea type="text" placeholder="Enter question" name="question"
                        class=" w-full px-2 py-2 border border-gray-500 rounded-xl focus:outline-none"></textarea>
                </div>
                @error('question')
                    <div class="text-red-500">{{$message}}</div>
                @enderror
                <div class="">
                    <input type="text" placeholder="Enter first option" name="a"
                        class=" w-full px-2 py-2 border border-gray-500 rounded-xl focus:outline-none">
                </div>
                @error('a')
                    <div class="text-red-500">{{$message}}</div>
                @enderror
                <div class="">
                    <input type="text" placeholder="Enter second option" name="b"
                        class=" w-full px-2 py-2 border border-gray-500 rounded-xl focus:outline-none">
                </div>
                @error('b')
                    <div class="text-red-500">{{$message}}</div>
                @enderror
                <div class="">
                    <input type="text" placeholder="Enter third option" name="c"
                        class=" w-full px-2 py-2 border border-gray-500 rounded-xl focus:outline-none">
                </div>
                @error('c')
                    <div class="text-red-500">{{$message}}</div>
                @enderror
                <div class="">
                    <input type="text" placeholder="Enter fourth option" name="d"
                        class=" w-full px-2 py-2 border border-gray-500 rounded-xl focus:outline-none">
                </div>
                @error('d')
                    <div class="text-red-500">{{$message}}</div>
                @enderror
                <div class="">
                    <select  name="correct_ans" class=" w-full px-2 py-2 border border-gray-500 rounded-xl focus:outline-none">
                        <option value="">Select Answer</option>
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="d">D</option>
                    </select>
                </div>
                @error('correct_ans')
                    <div class="text-red-500">{{$message}}</div>
                @enderror
                <button type="submit" name="submit"
                    class="w-full bg-green-800 rounded-xl px-2 py-2 text-white hover:bg-green-600" value="addMore">Add More</button>
                    <button type="submit" name="submit"
                    class="w-full bg-blue-800 rounded-xl px-2 py-2 text-white hover:bg-blue-600" value="done">Add and Submit</button>
                    <a class="w-full bg-red-800 block text-center rounded-xl px-2 py-2 text-white hover:bg-red-600" href="/endQuiz">
                    Finish Quiz</a>
                </form>
            @endif
            
        </div>
    </div>
</body>

</html>
