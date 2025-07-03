@props(['item'])

@php
    $stars = 10;
    $userScore = $item->userScore();
@endphp
<!-- total rating -->
<div class="place-items-left">
<div class="flex gap-1 items-center" 
     aria-label="Total rating" 
     title="Total rating">

    <svg viewBox="0 0 24 24" 
         fill="{{ $item->score() ? '#22c55e' : 'none' }}" 
         stroke="#22c55e" 
         stroke-width="2" 
         stroke-linecap="round" 
         stroke-linejoin="round" 
         class="w-4 h-4 sm:w-5 sm:h-5">
        <path d="M12 .587l3.668 7.431L24 9.748l-6 5.845L19.336 24 12 19.897 4.664 24 6 15.593 0 9.748l8.332-1.73z"/>
    </svg>

    <span class="text-white text-sm sm:text-base">
        {{ is_null($item->score()) ? '-' : $item->scoreFormated() }}
    </span>

</div>
</div>
<!--user rating -->
<div class="group select-none">
    @auth
    <button type="button"
            class="flex items-center justify-center rounded-full pointer-events-auto focus:outline-none gap-1 bg-zinc-900/80"
            aria-label="{{ $userScore ? 'Your rating: ' . $userScore : 'Submit rating' }}"
            title="{{ $userScore ? 'Your rating: ' . $userScore : 'Submit rating' }}"
            tabindex="0">

        <svg class="w-4 h-4 sm:w-5 sm:h-5 brightness-200"
             fill="{{ $userScore ? '#3b82f6' : 'none' }}" 
             stroke="#3b82f6" 
             stroke-width="2" 
             viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L24 9.748l-6 5.845L19.336 24 12 19.897 4.664 24 6 15.593 0 9.748l8.332-1.73z"/>
        </svg>

        <span class="text-white text-sm sm:text-base">
            {{ is_null($userScore) ? '-' : $userScore }}
        </span>

    </button>
    @else
    <a href="{{ route('users.login') }}"
       class="flex items-center justify-center rounded-full pointer-events-auto focus:outline-none gap-1 bg-zinc-900/80"
       aria-label="Login to rate"
       title="Login to rate">

        <svg class="w-4 h-4 sm:w-5 sm:h-5 brightness-200"
             fill="none"
             stroke="#3b82f6"
             stroke-width="2"
             viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L24 9.748l-6 5.845L19.336 24 12 19.897 4.664 24 6 15.593 0 9.748l8.332-1.73z"/>
        </svg>
        <span class="text-white text-sm sm:text-base">
            -
        </span>
    </a>
    @endauth

    <!--dropdown-->
    @auth
    <div class="absolute top-0 right-0 bottom-0 w-14 flex flex-col justify-between items-center 
                py-2 px-1 bg-zinc-800/95 rounded-sm shadow-xl z-30 opacity-0 pointer-events-none 
                group-hover:pointer-events-auto group-focus-within:opacity-100 
                group-focus-within:pointer-events-auto transition min-w-[3.5rem]">

    @for ($i = $stars; $i >= 1; $i--)
        <form method="POST" 
              action="{{ route('rating.store') }}" 
              class="flex-1 flex w-full">
            @csrf
            <input type="hidden" 
                   name="rating" 
                   value="{{ $i }}">
            <input type="hidden" 
                   name="media_type" 
                   value="{{ $item->type() }}">
            <input type="hidden" 
                   name="media_id" 
                   value="{{ $item->id }}">
            <input type="hidden" 
                   name="adult" 
                   value="{{ $item->isAdult() }}">
        

            <button type="submit"
                    class="relative flex items-center justify-center w-full h-full hover:scale-120 active:scale-95 transition focus:outline-none"
                    aria-label="Rate: {{ $i }}"
                    @if($userScore == $i) title="Your grade: {{ $i }}" @endif >

                <svg class="w-6 h-6 sm:w-7 sm:h-7 brightness-200"
                     fill="#3b82f6"
                     stroke="#3b82f6"
                     stroke-width="2"
                     viewBox="0 0 24 24">
                    <path d="M12 .587l3.668 7.431L24 9.748l-6 5.845L19.336 24 12 19.897 4.664 24 6 15.593 0 9.748l8.332-1.73z"/>
                </svg>

                <span class="absolute text-xs font-semibold text-rose-700 pointer-events-none"
                      style="left: 50%; top: 54%; transform: translate(-50%, -52%);">
                    {{ $i }}
                </span>

            </button>

        </form>
    @endfor
    </div>
    @endauth
</div>

