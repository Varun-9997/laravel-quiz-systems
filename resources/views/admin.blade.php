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
    <x-navbar name={{$name}}></x-navbar>
    <div class=" bg-slate-50 flex flex-col items-center min-h-screen pt-5">
        <div class="pt-5 w-200">
            <ul class="border border-gray-200">
                <li class="p-2">
                        <ul class="flex justify-between font-bold">
                            <li class="w-40">Sr. No.</li>
                            <li class="w-80">Name</li>
                            <li class="w-80">Email</li>
                        </ul>
                    </li>
                @foreach ($users as $key=>$user)
                    <li class=" even:bg-gray-200 p-2">
                        <ul class="flex justify-between">
                            <li class="w-40">{{$key+1}}</li>
                            <li class="w-80">{{$user->name}}</li>
                            <li class="w-80">{{$user->email}}</li>
                        </ul>
                    </li>
                @endforeach
                
            </ul>
        </div>
        <div class=" mt-5">
            {{ $users->links() }}
        </div>
    </div>

</body>
</html>