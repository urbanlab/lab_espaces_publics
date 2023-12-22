@if (! empty($items))
  <nav
    aria-label="Breadcrumb"
    class="flex items-center py-2 -mx-2 leading-none"
    vocab="https://schema.org/"
    typeof="BreadcrumbList"
  >
    @foreach ($items as $item)
      @if (empty($item['url']))
        <span class="p-2 font-medium cursor-default">
          {{ $item['label'] }}
        </span>
      @else
        <span class="p-2" property="itemListElement" typeof="ListItem">
          <a
            property="item"
            typeof="WebPage"
            title="Go to {!! $item['label'] !!}."
            href="{{ $item['url'] }}"
            class="hover:text-indigo-500"
          >
            <span property="name">
              @if ($loop->first)
                <svg
                  class="flex-shrink-0 w-5 h-5"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  aria-hidden="true"
                >
                  <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>

                <span class="sr-only">{!! $item['label'] !!}</span>
              @else
                {!! $item['label'] !!}
              @endif
            </span>
          </a>

          <meta property="position" content="{{ $loop->iteration }}">
        </span>

        @if (!$loop->last)
          <svg class="flex-shrink-0 w-5 h-5 text-indigo-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
          </svg>
        @endif
      @endif
    @endforeach
  </nav>
@endif