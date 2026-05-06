<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz Result Page</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-user-navbar></x-user-navbar>
    <div class="flex flex-col min-h-screen items-center bg-gray-100">
        <h1 class=" text-4xl text-blue-500 font-bold p-5">{{ $correctAnswers }}out of {{ count($resultData) }} Correct
        </h1>
        @if($correctAnswers*100/count($resultData)>70)
            <a href="/certificate" class="text-blue-600 font-bold">View and Download Certificate</a>
        @endif
        <div class="pt-5 w-200 mt-5">
            <ul class="border border-gray-200">
                <li class="p-2">
                    <ul class="flex justify-between font-bold">
                        <li class=" w-30">Sr. No.</li>
                        <li class=" w-70">Question</li>
                        <li class=" w-70">Result</li>
                    </ul>
                </li>
                @foreach ($resultData as $key => $item)
                    <li class=" even:bg-gray-200 p-2">
                        <ul class="flex justify-between">
                            <li class=" w-30">{{ $key + 1 }}</li>
                            <li class=" w-30">{{ $item->question }}</li>
                            @if ($item->is_correct)
                                <li class="w-70 text-green-700 font-bold">Correct</li>
                            @else
                                <li class="w-70 text-red-700 font-bold">Incorrect</li>
                            @endif
                        </ul>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>

    <x-user-footer></x-user-footer>

</body>
