<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body>
    <nav class=" bg-gray-100 shadow-lg px-5 py-3">
        <div class="flex justify-between">
            <div class="text-gray-800 text-xl font-bold cursor-pointer hover:text-gray-500">
            Quiz Systems
        </div>
        <div class="space-x-4">
            <a class="text-gray-500 hover:text-blue-500" href="">Categories</a>
            <a class="text-gray-500 hover:text-blue-500" href="">Quiz</a>
            <a class="text-gray-500 hover:text-blue-500" href="">Welcome {{$name}}</a>
            <a class="text-gray-500 hover:text-blue-500" href="">Logout</a>
        </div>
        </div>
    </nav>
</body>
</html>