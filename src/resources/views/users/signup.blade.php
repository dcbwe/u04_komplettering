<x-app-layout title="Create User">

    <div class="flex flex-col items-center h-full w-full flex-grow">
        
        <h2 class="flex justify-center font-bold text-xl sm:text-2xl text-rose-500 p-3">
            Create Your User
        </h2>
        <form autocomplete="off" class="flex flex-col gap-3 w-[80vw] sm:w-md" action="{{ route('users.signup') }}" method="POST">
            @csrf

                <x-input
                    logo='<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>' 
                    name="username" 
                    type="text" 
                />

                <x-input
                    logo='<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="m-0.5 lucide lucide-key-round"><path d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z"/><circle cx="16.5" cy="7.5" r=".5" fill="currentColor"/></svg>' 
                    id="password"
                    name="password" 
                    type="password" 
                />

                <x-input
                    logo='<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="m-0.5 lucide lucide-key-round"><path d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z"/><circle cx="16.5" cy="7.5" r=".5" fill="currentColor"/></svg>' 
                    id="password"
                    name="password_confirmation"
                    type="password"
                />

                <x-error />

                <button type="submit" class="flex justify-center items-center hover:bg-lime-500 rounded-md w-full font-bold text-xl px-3 py-0.5 text-black bg-white cursor-pointer">
                    Submit
                </button>
        
        </form>

    </div>

</x-app-layout>
