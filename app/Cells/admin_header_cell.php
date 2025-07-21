 <nav class="app-header navbar navbar-expand bg-body">
     <!--begin::Container-->
     <div class="container-fluid">
         <!--begin::Start Navbar Links-->
         <ul class="navbar-nav">
             <li class="nav-item">
                 <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                     <i class="bi bi-list"></i>
                 </a>
             </li>
             <!-- <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
             <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li> -->
         </ul>
         <!--end::Start Navbar Links-->
         <!--begin::End Navbar Links-->
         <ul class="navbar-nav ms-auto">
             <!--begin::Notifications Dropdown Menu-->
             <li class="nav-item dropdown">
                 <a class="nav-link" data-bs-toggle="dropdown" href="#">
                     <i class="bi bi-bell-fill"></i>
                     <span class="navbar-badge badge text-bg-warning"><?= $notification ? count($notification) : 0 ?></span>
                 </a>
                 <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                     <span class="dropdown-item dropdown-header"><?= $notification ? count($notification) : 0 ?> Notifications</span>
                     <div class="dropdown-divider"></div>
                     <?php foreach ($notification as $notif): ?>
                         <a href="#" class="dropdown-item">
                             <i class="bi bi-envelope me-2"></i> <?= $notif['title'] ?>
                             <span class="float-end text-secondary fs-7"><?= $notif['timestamp'] ?></span>
                         </a>
                         <div class="dropdown-divider"></div>
                     <?php endforeach; ?>
                     <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
                 </div>
             </li>
             <!--end::Notifications Dropdown Menu-->
             <!--begin::Fullscreen Toggle-->
             <li class="nav-item">
                 <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                     <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                     <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                 </a>
             </li>
             <!--end::Fullscreen Toggle-->
             <!--begin::User Menu Dropdown-->
             <li class="nav-item dropdown user-menu">
                 <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                     <?php
                        $user_avatar = ASSETS_ADMIN . "/assets/img/user2-160x160.jpg";
                        if ($user && $user['avatar'] != "") {
                            $user_avatar = $user['avatar'];
                        }
                        ?>
                     <img
                         src="<?= $user_avatar ?>"
                         class="user-image rounded-circle shadow"
                         alt="User Image" />
                     <span class="d-none d-md-inline"><?= $user['name'] ?></span>
                 </a>
                 <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                     <!--begin::User Image-->
                     <li class="user-header text-bg-primary">
                         <img
                             src="<?= $user_avatar ?>"
                             class="rounded-circle shadow"
                             alt="User Image" />
                         <p>
                             <?= $user['name'] ?><?= $user['title'] && $user['title'] != "" ? ' - ' . $user['title'] : '' ?>
                             <small>Member since <?= $user['register_at'] ?></small>
                         </p>
                     </li>
                     <!--end::User Image-->
                     <!--begin::Menu Footer-->
                     <li class="user-footer">
                         <a href="#" class="btn btn-default btn-flat">Profile</a>
                         <a href="#" onclick="confirmLogout()" class="btn btn-default btn-flat float-end">Sign out</a>
                     </li>
                     <!--end::Menu Footer-->
                 </ul>
             </li>
             <!--end::User Menu Dropdown-->
         </ul>
         <!--end::End Navbar Links-->
     </div>
     <!--end::Container-->
 </nav>

 <script>
     const confirmLogout = async () => {
         Swal.fire({
             title: "Keluar?",
             text: "Anda akan keluarkan akun anda, lanjutkan?",
             showCancelButton: true,
             confirmButtonText: "Keluar",
             cancelButtonText: `Batal`,
             showLoaderOnConfirm: true,
             allowOutsideClick: () => !Swal.isLoading()
         }).then(async (result) => {
             /* Read more about isConfirmed, isDenied below */
             if (result.isConfirmed) {
                 try {
                     const url = "/admin/auth/logout/";
                     const response = await fetch(url);
                     const res = await response.json();
                     Toast.fire({
                         title: res.message,
                         icon: res.status == 'success' ? 'success' : 'error'
                     });

                     if(res.status == 'success'){
                        window.location.replace("/login");
                     }
                 } catch (error) {
                     Toast.fire({
                         title: "Gagal mengeluarkan akun anda!",
                         icon: 'error'
                     });
                 }

             }
         });
     }
 </script>