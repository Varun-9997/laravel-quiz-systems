<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Set Password Page</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-user-navbar></x-user-navbar>
<div class=" bg-gray-100 flex items-center justify-center min-h-screen">
    <div class=" bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
        <h1 class=" text-2xl text-gray-800 mb-6 text-center">User Set Password</h1>
        <form action="/user-set-forgot-password" method="POST" class=" space-y-4">
            @csrf
            <div class="">
                <input type="hidden" placeholder="Enter your email" value={{ $email }} name="email"
                class=" w-full px-2 py-2 border border-gray-500 rounded-xl focus:outline-none">
                @error('email')
                    <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>
            <div>
                <label for="" class="text-gray-600 mb-1">Enter New Password</label>
                <input type="password" placeholder="Enter your password" name="password"
                class=" w-full px-2 py-2 border border-gray-500 rounded-xl focus:outline-none">
                @error('password')
                    <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>
            <div>
                <label for="" class="text-gray-600 mb-1">Confirm Password</label>
                <input type="password" placeholder="Enter your password again" name="password_confirmation"
                class=" w-full px-2 py-2 border border-gray-500 rounded-xl focus:outline-none">
                @error('password_confirmation')
                    <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="w-full bg-blue-800 rounded-xl px-2 py-2 text-white hover:bg-blue-600">Update Password</button>
        </form>
    </div>
</div>
</body>
</html>