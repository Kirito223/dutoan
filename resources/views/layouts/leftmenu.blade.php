<aside id="menubar" class="menubar light">
    <div class="userAvatar">
        <div class="avatar">
            <a href="/home"><img src="{{asset('images/huyhieu.png')}}" /></a>

        </div>
        <p>
            @php
            $session = new App\Helpers\SessionHelper();
            $loginController = new App\Http\Controllers\loginController();

            @endphp
            {{$session->getUserName()}}
        </p>
    </div>
    <div class="menubar-scroll">
        <div class="menubar-scroll-inner">
            <ul class="app-menu">
                <li>
                    <a href="/home"><i class="glyphicon glyphicon-home"></i> <span class="menu-text">Trang chủ</span></a>
                </li>


                <li>
                    <a href="/evaluation"><i class="glyphicon glyphicon-bishop"></i> <span class="menu-text">Quản lý chỉ
                            tiêu</span></a>
                </li>
                <li>
                    <a href="/unit"><i class="glyphicon glyphicon-home"></i> <span class="menu-text">Quản lý đơn vị
                            tính</span></a>
                </li>
                <li>
                    <a href="/sendNotce"><i class="glyphicon glyphicon-bell"></i> <span class="menu-text">Soạn thông
                            báo</span></a>
                </li>
                @if ($loginController->hasRole(3))
                <li>
                    <a href="/department"><i class="glyphicon glyphicon-education"></i> <span class="menu-text">Quản lý
                            đơn vị
                            hành
                            chính</span></a>
                </li>
                @endif
                <li class="has-submenu">
                    <a href="javascript:void(0)" class="submenu-toggle"><i class="zmdi zmdi-dns"></i> <span
                            class="menu-text">Quản lý biểu mẫu</span>
                        <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i></a>
                    <ul class="submenu">
                        <li><a href="/template"><span class="menu-text">Danh sách biểu mẫu</span></a></li>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="javascript:void(0)" class="submenu-toggle"><i class="zmdi zmdi-dns"></i> <span
                            class="menu-text">Quản lý dự toán</span>
                        <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i></a>
                    <ul class="submenu">
                        <li><a href="/estimates"><span class="menu-text">Lập dự toán</span></a></li>
                        <li><a href="/estimates/list"><span class="menu-text">Danh sách dự toán đã lập</span></a>
                        </li>
                        @if ($loginController->hasRole(2))
                        <li><a href="/estimates/approval"><span class="menu-text">Dự toán chờ phê duyệt</span></a>
                        </li>
                        @endif


                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="javascript:void(0)" class="submenu-toggle"><i class="zmdi zmdi-dns"></i> <span
                            class="menu-text">Quản lý báo cáo</span>
                        <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i></a>
                    <ul class="submenu">
                        <li>
                            <a href="/report"><span class="menu-text">
                                    Danh sách báo cáo</span></a>
                        </li>

                        @if ($loginController->hasRole(2))
                        <li>
                            <a href="/report/listapproval"><span class="menu-text">
                                    Báo cáo chờ phê duyệt</span></a>
                        </li>
                        @endif
                    </ul>
                </li>


                @if(Auth::user() !== null)
                <li>
                    <a href="/api/logout"><i class="glyphicon glyphicon-off"></i> <span class="menu-text">Đăng
                            xuất</span></a>

                </li>
                @endif
            </ul>
        </div>
    </div>
</aside>

<style>
    .userAvatar {
        text-align: center;
    }

    .userAvatar p {
        font-weight: bold;
        text-transform: uppercase;
    }
</style>