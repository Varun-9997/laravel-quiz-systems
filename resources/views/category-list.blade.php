<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz System Home Page</title>
    @vite('resources/css/app.css')
</head>
<body>
  <x-user-navbar></x-user-navbar> 
  <div class="flex flex-col min-h-screen items-center bg-gray-100">
    @if(session('message-success'))
    <div>
        <p class=" text-green-500 font-bold">{{session('message-success')}}</p>
    </div>
    @endif
    <h1 class="text-4xl font-bold text-blue-700 p-5" >Check Your Skills</h1>
    <div class="w-full max-w-md">
      <div class="relative">
       <form action="search-quiz" method="get">
       <input class="w-full px-4 py-3 text-gray-700 border border-gray-300
        rounded-2xl shadow" type="text" name="search"  placeholder="Search quiz..." />
        <button class="absolute right-2 top-3">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
        </button>
       </form>
      </div>
    </div>
    <div class="w-200">
        <h1 class="text-2xl text-blue-700 text-center my-5">Top Categories</h1>
        <ul class="border border-gray-200">
        <li class="p-2 font-bold">
                <ul class="flex justify-between">
                    <li class="w-30">S. No</li>
                    <li class="w-70">Name</li>
                    <li class="w-70">Quiz Count</li>
                    <li class="w-30">Action</li>
                </ul>
            </li>

            @foreach($categories as $key=>$category)
            <li class="even:bg-gray-200 p-2">
                <ul class="flex justify-between">
                    <li class="w-30">{{$key+1}}</li>
                    <li class="w-70">{{$category->name}}</li>
                    <li class="w-30">{{$category->quizzes_count}}</li>
                    <li class="w-30 flex">
                        <a href="userQuizList/{{$category->id}}/{{str_replace(' ','-',$category->name)}}" class="text-blue-600 hover:text-blue-800">
                        View
                        </a>
                    </li>
                </ul>
            </li>
            @endforeach
        </ul>
       <div class="mb-10 mt-5">
        {{$categories->links()}}
       </div>
    </div>

</div>
<x-user-footer></x-user-footer>
</body>