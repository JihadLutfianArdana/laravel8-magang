<!--**********************************
            Nav header start
        ***********************************-->
<div class="nav-header d-flex align-items-center">
    <img class="m2-3 ml-2" src="{{ asset('template/images/logo_prov3.png') }}" alt="" width="50" height="50">
    <span class="ml-3 font-weight-bold" style="font-size: 1.5rem; color: white;">SIMAGANG</span>
</div>
<!--**********************************
                    Nav header end
                ***********************************-->

<!--**********************************
                    Header start
                ***********************************-->
<div class="header">
    <div class="header-content clearfix">
        <div class="nav-control">
            <div class="hamburger">
                <span class="toggle-icon"><i class="icon-menu"></i></span>
            </div>
        </div>
        <div class="header-left">
            <div class="input-group icons">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"><i
                            class="mdi mdi-magnify"></i></span>
                </div>
                <input type="search" class="form-control" placeholder="Search Dashboard" aria-label="Search Dashboard">
                <div class="drop-down   d-md-none">
                    <form action="#">
                        <input type="text" class="form-control" placeholder="Search">
                    </form>
                </div>
            </div>
        </div>
        <div class="header-right">
            <ul class="clearfix">
                <li class="icons dropdown">
                    <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                        <span class="activity active"></span>
                        <span class="mr-2">{{ Auth::user()->nama }}</span> <!-- Menampilkan username -->
                        <img src="{{ asset('template/images/user/1.png') }}" height="40" width="40"
                            alt="">
                    </div>
                    <div class="drop-down dropdown-profile dropdown-menu">
                        <div class="dropdown-content-body">
                            <ul>
                                <!-- Menu Reset Password -->
                                @can('admin')
                                    <li>
                                        <a href="/dashboard/reset-password-admin"
                                            style="background: none; border: none; color: inherit; cursor: pointer; font: inherit; display: flex; align-items: center; outline: none;">
                                            <i class="bi bi-key" style="margin-right: 5px;"></i>
                                            <span>Reset Password</span>
                                        </a>
                                    </li>
                                @endcan

                                <!-- Menu Reset Password untuk Peserta -->
                                @cannot('admin')
                                    @cannot('adminPendaftaran')
                                        @cannot('pembimbingLapangan')
                                            <li>
                                                <a href="/dashboard/reset-password-peserta"
                                                    style="background: none; border: none; color: inherit; cursor: pointer; font: inherit; display: flex; align-items: center; outline: none;">
                                                    <i class="bi bi-key" style="margin-right: 5px;"></i>
                                                    <span>Reset Password</span>
                                                </a>
                                            </li>
                                        @endcannot
                                    @endcannot
                                @endcannot

                                @can('adminPendaftaran')
                                    <li>
                                        <a href="/dashboard/reset-password-adminpendaftaran"
                                            style="background: none; border: none; color: inherit; cursor: pointer; font: inherit; display: flex; align-items: center; outline: none;">
                                            <i class="bi bi-key" style="margin-right: 5px;"></i>
                                            <span>Reset Password</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('pembimbingLapangan')
                                    <li>
                                        <a href="/dashboard/reset-password-pembimbing"
                                            style="background: none; border: none; color: inherit; cursor: pointer; font: inherit; display: flex; align-items: center; outline: none;">
                                            <i class="bi bi-key" style="margin-right: 5px;"></i>
                                            <span>Reset Password</span>
                                        </a>
                                    </li>
                                @endcan

                                <hr class="my-1">
                                <!-- Menu Logout -->
                                <li>
                                    <a href="#" onclick="event.preventDefault(); confirmLogout();"
                                        style="background: none; border: none; color: inherit; cursor: pointer; font: inherit; display: flex; align-items: center; outline: none;">
                                        <i class="bi bi-box-arrow-right" style="margin-right: 5px;"></i>
                                        <span>Logout</span>
                                    </a>

                                    <form id="logout-form" action="/logout" method="post" style="display: none;">
                                        @csrf
                                    </form>
                                </li>

                                <script>
                                    function confirmLogout() {
                                        Swal.fire({
                                            title: 'Logout',
                                            text: "Apa Anda yakin ingin keluar?",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Keluar',
                                            cancelButtonText: 'Batal'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                document.getElementById('logout-form').submit();
                                            }
                                        });
                                    }
                                </script>


                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--**********************************
                    Header end
                ***********************************-->
