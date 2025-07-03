<nav class="shadow mb-10">
    <div class="max-w-7xl mx-auto p-1">
        <div class="flex justify-between items-center py-3">
            <!-- logo -->
            <div class="flex justify-center items-center bg-zinc-900 hover:bg-zinc-800 rounded-sm cursor-pointer border-2 border-rose-500 z-150">
            <a href="{{ route('home') }}" 
               class="text-green-400 font-extrabold text-xl py-0 px-2"
               aria-label="Go to homepage"
               title="Go to homepage">
                NPMDb
            </a>    
        </div>

            <!-- centered search bar | large screens -->
            <div class="flex-1 justify-center items-center px-6 md:px-10">
                <div class="hidden sm:flex w-full">
                    <x-search-bar />
                </div>
            </div>
            <!-- right icons  -->
            <div class="flex items-center mr-3">
                @auth
                <a href="/profile" 
                   class="text-green-500 bg-rose-800 hover:bg-zinc-800 rounded-full p-1 focus:outline-none cursor-pointer mr-3"
                   aria-label="Profile-page"
                   title="Profile">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 translate-x-0.5"><path d="m16 11 2 2 4-4"/><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                </a>
                <a href="{{ route('users.logout') }}" 
                   class="text-green-500 bg-rose-800 hover:bg-zinc-800 rounded-full p-1 focus:outline-none cursor-pointer"
                   aria-label="Logout"
                   title="Logout">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 translate-x-0.25"><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/></svg>
                </a>
                @else
                <a href="{{ route('users.login') }}" 
                   class="text-green-500 bg-rose-800 hover:bg-zinc-800 rounded-full p-1 focus:outline-none cursor-pointer"
                   aria-label="Login"
                   title="Login">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 translate-x-0.25"><circle cx="10" cy="7" r="4"/><path d="M10.3 15H7a4 4 0 0 0-4 4v2"/><path d="M15 15.5V14a2 2 0 0 1 4 0v1.5"/><rect width="8" height="5" x="13" y="16" rx=".899"/></svg>
                </a>
                @endauth
            </div>
            <!-- hamburger -->
            <div class="flex items-center">
                <button class="text-green-500 bg-rose-800 hover:bg-zinc-800 rounded-full p-1 focus:outline-none cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
        <!-- bottom search bar | small screens-->
        <div class="flex-1 justify-center items-center flex sm:hidden">
            <x-search-bar />
        </div>
    </div>
</nav>
