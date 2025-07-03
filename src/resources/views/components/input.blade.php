@props([
    'logo' => null,
    'name' => '',
    'type' => 'text'
])

<div class="flex items-center bg-zinc-700 border-1 border-zinc-800 rounded-md w-full overflow-hidden" title="{{ $name }}">
    @if($logo)
        <div class="bg-lime-500 rounded-md p-1">
            {!! $logo !!}
        </div>
    @endif
    <input type="{{ $type }}" 
           class="font-bold text-xl px-3 text-white border-none caret-none outline-none w-full bg-transparent" 
           id="{{ $name }}" 
           name="{{ $name }}" 
           value="{{ old($name) }}" 
           placeholder="{{ str_replace('_', ' ', ucfirst($name)) }}">
</div>
