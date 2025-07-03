<section class="w-full max-w-7xl py-3 bg-zinc-900 sm:bg-zinc-950">
<x-title title="Watchlist" subtitle="Your personal watchlist"/>
    <div class="flex flex-col justify-center items-center w-full gap-2 px-3 my-7">
        <x-bookmark-toggle />
        <h3 class="text-lg sm:text-xl text-yellow-400 brightness-400 font-semibold">
            Please login to access Watchlist
        </h3>
        <span class="text-blue-500 text-sm sm:text-md pb-3">
            Keep track of movies and tv-shows you watch
        </span>

        <a href="/auth/login"
           title="Login"
           class="flex justify-center items-center rounded-md cursor-pointer
                  py-0.5 px-3 font-extrabold text-base text-[#a6da24] bg-[#d90101]
                  hover:bg-zinc-800 hover:text-green-500">
           Login
        </a>

    </div>
</section>
