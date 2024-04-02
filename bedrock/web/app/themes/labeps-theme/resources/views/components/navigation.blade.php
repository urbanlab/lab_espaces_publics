@if (!empty($primaryMenu['items']))
    <nav class="sticky nav-primary hidden w-screen md:w-3/4 max-sm:pt-16 max-sm:h-screen max-sm:order-last md:flex text-lg font-bold" id="navbar-hamburger" aria-label="{{ $primaryMenu['name'] }}">
        <div class="menu-main-menu-container">
        <ul id="menu-main-menu" class="menu">
            @foreach ($primaryMenu['items'] as $item)
                <li class="{{$item->active ? 'text-primary font-black' : 'Inactive' }}">
                    <a href="{{ $item->url }}">
                        {{ $item->label }}
                    </a>
                    @if (!empty($item->children))
                    <ul class="sub-menu">
                        @foreach ($item->children as $child)
                            <li>
                                <a href="{{ $child->url }}">
                                    {{ $child->label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
                </li>
            @endforeach
        </ul>
        </div>
    </nav>
@else
    <p>Menu not found.</p>
@endif

