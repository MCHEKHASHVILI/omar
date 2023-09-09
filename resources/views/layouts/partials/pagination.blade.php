{{-- @if ($paginator->hasPages())
        @if ($paginator->onFirstPage())
        <li class="prev" aria-disabled="true" ><span><i class="fa fa-long-arrow-left"></i> Previous</span></li>
        @else --}}
        <li class="prev"><a href="/"><i class="fa fa-long-arrow-left"></i> Previous</a></li>
        {{-- @endif --}}
      
        {{-- @foreach ($elements as $element)
            @if (is_string($element))
                <li>{{ $element }}</li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage()) --}}
                        <li class="page-item">
                            <a class="active">1</a>
                        </li>
                    {{-- @else --}}
                        <li>
                            <a href="/">2</a>
                        </li>
                    {{-- @endif
                @endforeach
            @endif
        @endforeach --}}
        
        {{-- @if ($paginator->hasMorePages()) --}}
            <li class="next"><a href="/">Next <i class="fa fa-long-arrow-right"></i></a></li>
        {{-- @else
            <li class="next"><span>Next <i class="fa fa-long-arrow-right"></i></span></li>
        @endif
@endif --}}
