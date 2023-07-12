<!-- ======= Sidebar ======= -->

@if (session()->has('UserName'))
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">
            @if ($listMenuOfRole->isEmpty())
                <p class="text-danger">Bạn không có quyền nào</p>
            @else
                @foreach ($listMenuOfRole->where('Lever', 0) as $item)
                    @if ($listMenu->where('ParentId', $item->IdMenuAdmin)->isEmpty())
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="/admin/{{ $item->ControllerName . '/' . $item->ActionName }}">
                                <i class="{{ $item->Icon }}"></i>
                                <span>{{ $item->MenuName }}</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link collapsed" data-bs-target="#{{ $item->IdName }}"
                                data-bs-toggle="collapse">
                                <i class="{{ $item->Icon }}"></i><span>{{ $item->MenuName }}</span><i
                                    class="bi bi-chevron-down ms-auto"></i>
                            </a>
                            <ul id="{{ $item->IdName }}" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                                @foreach ($listMenu->where('ParentId', $item->IdMenuAdmin)->sortBy('Order') as $item2)
                                    <li>
                                        <a href="/admin/{{ $item2->ControllerName . '/' . $item2->ActionName }}">
                                            <i class="{{ $item2->Icon }}"></i><span>{{ $item2->MenuName }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            @endif
        </ul>
    </aside><!-- End Sidebar-->
@else
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ URL::to('/admin') }}">
                    <i class="bi bi-house"></i>
                    <span>Trang chủ</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ URL::to('/admin/login.html') }}">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Đăng nhập</span>
                </a>
            </li>
        </ul>
    </aside><!-- End Sidebar-->
@endif
