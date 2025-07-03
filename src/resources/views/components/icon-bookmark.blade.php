@props(['active' => false])

@if($active)
    <svg xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24" 
        fill="#be123c"
        stroke="#4ade80" 
        stroke-width="0.75" 
        stroke-linecap="round" 
        stroke-linejoin="round" 
        class="w-11 h-11 sm:w-14 sm:h-14">
        <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2Z"/>
        <path d="m9 10 2 2 4-4"/>
    </svg>
@else
    <svg xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        fill="#27272a"
        stroke="#ffffff"
        stroke-width="0.75"
        stroke-linecap="round"
        stroke-linejoin="round"
        class="w-11 h-11 sm:w-14 sm:h-14 hover:brightness-250">
        <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"/>
        <line x1="12" x2="12" y1="7" y2="13"/>
        <line x1="15" x2="9" y1="10" y2="10"/>
    </svg>
@endif
