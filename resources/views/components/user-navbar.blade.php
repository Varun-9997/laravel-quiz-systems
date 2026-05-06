<nav class=" bg-gray-200 shadow-xl px-5 py-3">
        <div class="flex justify-between">
            <div class="text-gray-800 text-xl font-bold cursor-pointer hover:text-gray-500">
            Quiz Systems
        </div>
        <div class="space-x-4">
            <a class="text-gray-500 hover:text-blue-500" href="/">Home</a>
            <a class="text-gray-500 hover:text-blue-500" href="/category-list">Categories</a>
            @if (session('user'))
                <a class="text-gray-500 hover:text-blue-500" href="/userDetails">Welcome, {{Session('user')['name']}}</a>
            <a class="text-gray-500 hover:text-blue-500" href="/userLogout">Logout</a>
            @else
            <a class="text-gray-500 hover:text-blue-500" href="/userLogin">Login</a>
            <a class="text-gray-500 hover:text-blue-500" href="/userSignup">Signup</a>
                
            @endif
            
            <a class="text-gray-500 hover:text-blue-500" href="">Blog</a>
        </div>
        </div>
    </nav>