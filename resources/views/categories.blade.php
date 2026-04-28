<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Categories Page</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-navbar name={{ $name }}></x-navbar>

    @if (session('category'))
        <div class="bg-green-500 text-white px-4 text-center">{{session('category')}}</div>
    @endif
        
    <div class=" flex flex-col items-center justify-center py-10">
        <div class=" bg-slate-50 p-8 rounded-lg shadow-lg w-full max-w-sm ">
            <h1 class=" text-2xl text-gray-800 mb-6 text-center font-bold">Add Category</h1>
            <form action="/admin-categories" method="POST" class=" space-y-4 ">
                @csrf
                <div class="">
                    <input type="text" placeholder="Enter category name" name="category"
                        class=" w-full px-2 py-2 border border-gray-500 rounded-xl focus:outline-none">
                    @error('category')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-blue-800 rounded-xl px-2 py-2 text-white hover:bg-blue-600">Add</button>
            </form>
        </div>
        <div class="pt-5 w-200">
            <ul class="border border-gray-200">
                <li class="p-2">
                        <ul class="flex justify-between font-bold">
                            <li>Sr. No.</li>
                            <li>Name</li>
                            <li>Creator</li>
                            <li>Action</li>
                        </ul>
                    </li>
                @foreach ($categories as $category)
                    <li class=" even:bg-gray-200 p-2">
                        <ul class="flex justify-between">
                            <li>{{$category->id}}</li>
                            <li>{{$category->name}}</li>
                            <li>{{$category->creator}}</li>
                            <li class="flex gap-3">
                            <a href="quizList/{{$category->id}}/{{$category->name}}" class="text-blue-600 hover:text-blue-400">View</a>
                            <a href="category/delete/{{$category->id}}" class="text-red-600 hover:text-red-400">Delete</a>
                        </li>
                        </ul>
                    </li>
                @endforeach
                
            </ul>
        </div>
    </div>
</body>

</html>
