<x-app-layout title="Login">

    <div class="flex flex-col items-center h-full w-full flex-grow">

        <h2 class="flex justify-center font-bold text-lg sm:text-xl text-blue-500 p-3">
            Please Login to Continue
        </h2>

        <div class="flex flex-col gap-8 w-[80vw] sm:w-md">

            <form class="space-y-3" action="{{ route('users.login') }}" method="POST" autocomplete="off">
                @csrf

                <x-input-tmdb
                    logo='<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#e11d48" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>' 
                    name="username" 
                    type="text" 
                />

                <x-input-tmdb
                    logo='<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#e11d48" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="m-0.5 lucide lucide-lock-keyhole"><circle cx="12" cy="16" r="1"/><rect x="3" y="10" width="18" height="12" rx="2"/><path d="M7 10V7a5 5 0 0 1 10 0v3"/></svg>' 
                    name="password" 
                    type="password" 
                />

                <x-error />

                <button title="Click to login" type="submit" class="flex justify-center items-center bg-green-500 hover:bg-zinc-800 rounded-md w-full font-bold text-lg px-3 py-0.5 text-rose-500 hover:text-green-500 cursor-pointer">
                    Login
                </button>

            </form>

            <div class="relative flex items-center w-full">
                <div class="h-0.5 bg-zinc-700 flex-grow"></div>
                <span class="text-zinc-400 text-sm px-2">
                    not a user yet?
                </span>
                <div class="h-0.5 bg-zinc-700 flex-grow"></div>
            </div>

            <a href="/auth/signup" class="block w-full" title="Create a User">
                <div class="flex justify-center items-center hover:bg-lime-500 rounded-md w-full bg-white cursor-pointer">
                    <span class="font-bold text-lg px-3 py-0.5 text-black">
                        Create User
                    </span>
                </div>
            </a>

        </div>
    
    </div>
    
</x-app-layout>
