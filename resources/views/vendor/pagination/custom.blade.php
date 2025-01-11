@if ($paginator->hasPages())
    <nav>
        <ul class="pagination flex justify-center items-center space-x-2">
            {{-- Nút "Trước" --}}
            @if ($paginator->onFirstPage())
                <li class="disabled">
                    <span class="px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed">«</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                       class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        «
                    </a>
                </li>
            @endif

            {{-- Các trang --}}
            @foreach ($elements as $element)
                {{-- Dấu "..." --}}
                @if (is_string($element))
                    <li class="disabled">
                        <span class="px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed">
                            {{ $element }}
                        </span>
                    </li>
                @endif

                {{-- Danh sách các trang --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="px-4 py-2 bg-blue-500 text-white rounded-lg font-bold">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-blue-500 hover:text-white">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Nút "Tiếp" --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                       class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        »
                    </a>
                </li>
            @else
                <li class="disabled">
                    <span class="px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed">»</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
