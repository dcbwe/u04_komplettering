@props([
    'logo' => null,
    'name' => '',
    'type' => 'text'
])

<div class="flex items-center bg-zinc-700 rounded-md w-full overflow-hidden" title="{{ $name }}">
    @if($logo)
        <div class="bg-green-500 rounded-md p-1">
            {!! $logo !!}
        </div>
    @endif
    <input type="{{ $type }}" 
           class="font-bold text-lg px-3 text-white border-none caret-none outline-none w-full bg-transparent" 
           id="{{ $name }}" 
           name="{{ $name }}" 
           value="{{ old($name) }}" 
           placeholder="{{ str_replace('_', ' ', ucfirst($name)) }}">
</div>