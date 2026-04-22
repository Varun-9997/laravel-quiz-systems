<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @vite('resources/css/app.css')
</head>
<body class=" bg-gray-100 flex items-center justify-center min-h-screen">
    <div class=" bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
        <h1 class=" text-2xl text-gray-800 mb-6 text-center">Admin Login</h1>
        <form action="/admin-login" method="POST" class=" space-y-4">
            @csrf
            <div class="">
                <label for="" class="text-gray-600 mb-1">Admin Name</label>
                <input type="text" placeholder="Enter your name" name="name"
                class=" w-full px-2 py-2 border border-gray-500 rounded-xl focus:outline-none">
                @error('name')
                    <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>
            <div>
                <label for="" class="text-gray-600 mb-1">Password</label>
                <input type="password" placeholder="Enter your password" name="password"
                class=" w-full px-2 py-2 border border-gray-500 rounded-xl focus:outline-none">
                @error('password')
                    <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="w-full bg-blue-800 rounded-xl px-2 py-2 text-white hover:bg-blue-600">Login</button>
        </form>
    </div>
</body>
</html>