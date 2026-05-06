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
    <span class="flex  justify-between w-200">
        <a href="/" class=" text-2xl p-4 mt-5 ml-5 text-violet-600">Back</a>
        <a href="/download-certificate" class=" text-2xl p-4 mt-5 ml-5 text-violet-600">Download Certificate</a>
    </span>
    <div class="w-200 border-8 mt-5 bg-gray-100 border-indigo-500 p-6 text-center">
        <h1 class="text-4xl">Certificate of Completion</h1>
        <p class=" text-2xl mt-5">This is to clarify that</p>
        <h2 class="text-2xl">{{ $data['name'] }}</h2>
        <p class=" text-2xl">has succesfully completed the quiz:</p>
        <h3 class="text-2xl">{{ $data['quiz'] }}</h3>
        <p class=" text-2xl mt-5">{{date('d-m-y')}}</p>
    </div>
</body>

</html>
