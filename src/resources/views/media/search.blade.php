<x-app-layout>
    <h1 class="text-2xl text-blue-500 font-bold mb-6">Search results for "{{ $query }}"</h1>
    @if ($query && count($results))
        <x-search-results :results="$results" />
    @endif
</x-app-layout>
