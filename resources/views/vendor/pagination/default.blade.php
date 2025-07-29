<ul class="flex justify-center list-reset mt-8">
    @if ($paginator->onFirstPage())
        <li class="mx-1">
            <span class="block p-2 text-gray-500 bg-gray-200 rounded-lg">Precedent</span>
        </li>
    @else
        <li class="mx-1">
            <a href="{{ $paginator->previousPageUrl() }}" class="block p-2 text-blue-600 bg-blue-200 rounded-lg hover:bg-blue-300">Precedent</a>
        </li>
    @endif

    
    @if ($paginator->hasMorePages())
        <li class="mx-1">
            <a href="{{ $paginator->nextPageUrl() }}" class="block p-2 text-blue-600 bg-blue-200 rounded-lg hover:bg-blue-300">Suivant</a>
        </li>
    @else
        <li class="mx-1">
            <span class="block p-2 text-gray-500 bg-gray-200 rounded-lg">Suivant</span>
        </li>
    @endif
</ul>
