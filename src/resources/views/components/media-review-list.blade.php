@props(['item', 'reviews', 'userReview' => null])

@php
    $editing = session('editing_review', false);
@endphp

<section class="w-full max-w-7xl py-6 bg-zinc-900 rounded-md overflow-x-auto">
    <x-title title="Reviews" subtitle="See what others think and share your own thoughts"/>

    <div class="flex overflow-x-auto gap-3 pb-4">

        {{-- First slot: either guest prompt, user form, or editable card --}}
        @guest
            <div class="flex flex-col justify-center items-center h-34 w-1/2 md:w-1/3 xl:w-1/4 flex-shrink-0 bg-zinc-800 rounded-md border-1 {{ colorShadow() }} snap-start">
                <p class="text-white text-sm sm:text-base text-center">
                    You will have to<a href="{{ route('users.login') }}"
                    title="Login"
                    class="flex justify-center items-center rounded-md cursor-pointer
                  py-0 px-2 font-extrabold text-sm sm:text-base text-[#a6da24] bg-[#d90101]
                  hover:bg-zinc-800 hover:text-green-500">Login
                </a> to write a review.
                </p>
            </div>
        @else
            @if ($userReview)
                <x-media-review-card
                    :review="$userReview"
                    :editable="true"
                    :editing="$editing"
                    :initialContent="$userReview->content"
                />
            @else
                <x-review-form :mediaId="$item->id" :mediaType="$item->type()" />
            @endif
        @endguest

        {{-- All other reviews (excluding current user's) --}}
        @if ($reviews->isEmpty())
        <div class="flex flex-col justify-center items-center h-34 w-1/2 md:w-1/3 xl:w-1/4 flex-shrink-0 bg-zinc-800 rounded-md border-1 {{ colorShadow() }} snap-start">
            <span class="text-center m-auto text-rose-500 text-sm sm:text-base">No user reviews yet</span>
        </div>
        @else
        @foreach($reviews->all() as $review)
            @auth
                @if ($userReview && $review->userId === $userReview->userId)
                    @continue
                @endif
            @endauth
            <x-media-review-card :review="$review" />
        @endforeach
        @endif
    </div>
</section>
