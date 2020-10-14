<aside id="menubar" class="menubar light">
    <div class="app-user">
        <div class="media">
            <div class="media-left">
                <div class="avatar avatar-md avatar-circle"><a href="javascript:void(0)"><img class="img-responsive"
                            src="{{asset('images/huyhieu.png')}}" alt="avatar"></a></div>
            </div>
            <div class="media-body">
                <div class="foldable">
                    <h5><a href="javascript:void(0)" class="username">{{session('name')}}</a></h5>
                    <ul>
                        <li class="dropdown"><a href="javascript:void(0)" class="dropdown-toggle usertitle"
                                data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"><small>{{session('tendonvi')}}</small> <span
                                    class="caret"></span></a>
                            <ul class="dropdown-menu animated flipInY">

                                <li><a class="text-color" href="quanlytaikhoan"><span class="m-r-xs"><i
                                                class="fa fa-gear"></i></span> <span>Thông tin tài khoản</span></a></li>
                                <li role="separator" class="divider"></li>
                                <li><a class="text-color" href="logout"><span class="m-r-xs"><i
                                                class="fa fa-power-off"></i></span> <span>Logout</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="menubar-scroll">
        <div class="menubar-scroll-inner">
            <ul class="app-menu">
                <li>
                    <a href="home"><i class="glyphicon glyphicon-home"></i> <span class="menu-text">Trang chủ</span></a>
                </li>
                <!-- <li><a href="listchitieu"><i class="menu-icon zmdi zmdi-file-text zmdi-hc-lg"></i> <span class="menu-text">Chỉ tiêu</span></a></li> -->
                @can('super-admin')
                <li class="has-submenu">
                    <a href="javascript:void(0)" class="submenu-toggle"><i class="zmdi zmdi-hc-lg zmdi-settings"></i>
                        <span class="menu-text">Hệ thống</span>
                        <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i></a>
                    <ul class="submenu">
                        <li><a href="/taikhoan"><span class="menu-text">1.1. Quản lý tài khoản</span></a></li>
                        <li><a href="/nhomquyen"><span class="menu-text">1.2. Quản lý nhóm & phân quyền </span></a></li>
                    </ul>
                </li>
                @endcan
                <li class="has-submenu">
                    <a href="javascript:void(0)" class="submenu-toggle"><i class="zmdi zmdi-view-list-alt"></i> <span
                            class="menu-text">Quản lý danh mục</span>
                        <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i></a>
                    <ul class="submenu">
                        @can('super-admin')
                        <li><a href="loaisolieu"><span class="menu-text">2.1. Quản lý loại số liệu</span></a></li>
                        <li><a href="donvitinh"><span class="menu-text">2.2. Quản lý đơn vị tính</span></a></li>
                        <li><a href="donvihanhchinh"><span class="menu-text">2.3. Quản lý đơn vị hành chính</span></a>
                        </li>
                        <li><a href="kybaocao"><span class="menu-text">2.4. Quản lý kỳ báo cáo</span></a></li>
                        <li><a href="diaban"><span class="menu-text">2.5. Quản lý địa bàn</span></a></li>
                        <li><a href="listchitieu"><span class="menu-text">2.6. Quản lý chỉ tiêu</span></a></li>
                        @endcan
                    </ul>
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
                <li>
                    <a href="/department"><i class="glyphicon glyphicon-education"></i> <span class="menu-text">Quản lý
                            đơn vị
                            hành
                            chính</span></a>
                </li>


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
                        <li><a href="/estimates/list"><span class="menu-text">Danh sách dự toán</span></a>
                        </li>
                        <li><a href="/estimates/approval"><span class="menu-text">Dự toán chờ phê duyệt</span></a>
                        </li>

                    </ul>
                </li>
                @if(Auth::user() !== null)
                <li>
                    <a href="api/logout"><i class="glyphicon glyphicon-off"></i> <span class="menu-text">Đăng
                            xuất</span></a>

                </li>
                @endif
            </ul>
        </div>
    </div>
</aside>