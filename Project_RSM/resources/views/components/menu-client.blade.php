<!-- ======= Sidebar ======= -->

@foreach ($listMenu->where('Lever', 1) as $item)
    @if ($listMenu->where('ParentId', $item->IdMenu)->count() > 0)
        <li class="dropdown"><a href=""><span>{{ $item->MenuName }}</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                @foreach ($listMenu->where('ParentID', $item->MenuId)->where('Lever', 2)->sortBy('Order') as $menu2)

                @endforeach
                <li><a href="#">{{ $menu2->MenuName }}</a></li>
                {{-- <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                    <ul>
                        <li><a href="#">Deep Drop Down 1</a></li>
                        <li><a href="#">Deep Drop Down 2</a></li>
                        <li><a href="#">Deep Drop Down 3</a></li>
                        <li><a href="#">Deep Drop Down 4</a></li>
                        <li><a href="#">Deep Drop Down 5</a></li>
                    </ul>
                </li> --}}
            </ul>
        </li>
    @else
        <li><a class="nav-link scrollto"
                href="@if ($item->ControllerName !== null && $item->ControllerName !== '')/{{ $item->ControllerName }}@endif/{{ $item->ActionName }}@if ($item->ActionName !== null && $item->ActionName !== '').html @endif">{{ $item->MenuName }}</a>
        </li>
    @endif
@endforeach
