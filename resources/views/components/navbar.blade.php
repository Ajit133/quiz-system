 <nav class="bg-indigo-700 shadow-lg px-6 py-0">
        <div class="flex justify-between items-center h-16">

            {{-- Brand / Logo --}}
            <a href="#" class="flex items-center gap-2 text-white text-xl font-bold tracking-wide hover:text-indigo-200 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
                Quiz System
            </a>

            {{-- Nav Links --}}
            <div class="flex items-center gap-1">
                <a href="/dashboard" class="px-4 py-2 rounded-md text-sm font-medium text-indigo-100 hover:bg-indigo-600 hover:text-white transition-colors duration-200">
                    Dashboard Home
                </a>
                <a href="/admin-categories" class="px-4 py-2 rounded-md text-sm font-medium text-indigo-100 hover:bg-indigo-600 hover:text-white transition-colors duration-200">
                    Categories
                </a>
                <a href="/add-quiz" class="px-4 py-2 rounded-md text-sm font-medium text-indigo-100 hover:bg-indigo-600 hover:text-white transition-colors duration-200">
                    Quizzes
                </a>

                {{-- Divider --}}
                <div class="h-6 w-px bg-indigo-500 mx-2"></div>

                {{-- User greeting --}}
                <div class="flex items-center gap-2 px-3 py-1.5 bg-indigo-800 rounded-full text-sm text-indigo-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9 9 0 1118.88 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Welcome, <span class="font-semibold text-white">{{$name}}</span>
                </div>

                {{-- Logout Button --}}
                <a href="/admin-logout" class="ml-2 px-4 py-2 rounded-md text-sm font-semibold bg-white text-indigo-700 hover:bg-indigo-100 transition-colors duration-200 shadow-sm">
                    Logout
                </a>
            </div>
        </div>
    </nav>