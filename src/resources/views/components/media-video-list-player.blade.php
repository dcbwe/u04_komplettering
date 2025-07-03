@props([
  'snapshot',  
  'trailerKey',  
])

<div class="trailer-player relative w-full aspect-video overflow-hidden rounded-md">
  {{-- hidden checkbox toggles everything --}}
  <input 
    type="checkbox" 
    id="toggle-{{ $trailerKey }}" 
    class="hidden peer" 
  />

  {{-- play button (label toggles the checkbox) --}}
  <label 
    for="toggle-{{ $trailerKey }}"
    class="absolute bottom-[8%] left-[5%] p-[2%] border-2 border-white 
           rounded-full flex justify-center items-center bg-zinc-800/70
           cursor-pointer peer-checked:hidden"
  >
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
         viewBox="0 0 24 24" fill="#fff" stroke="transparent" stroke-width="2"
         stroke-linecap="round" stroke-linejoin="round">
      <polygon points="6 3 20 12 6 21 6 3"/>
    </svg>
  </label>

  {{-- snapshot image; hides itself when checkbox is checked --}}
  <img 
    src="{{ $snapshot }}" 
    alt="Trailer snapshot" 
    loading="lazy"
    class="object-cover w-full h-full peer-checked:hidden"
  />

  {{-- iframe; hidden by default, shown when checkbox is checked --}}
  <iframe
    src="https://www.youtube.com/embed/{{ $trailerKey }}?autoplay=1&controls=0&rel=0&modestbranding=1"
    title="YouTube trailer"
    loading="lazy"
    allow="autoplay; encrypted-media"
    allowfullscreen
    referrerpolicy="strict-origin-when-cross-origin"
    class="absolute inset-0 hidden peer-checked:block w-full h-full border-0"
  ></iframe>
</div>
