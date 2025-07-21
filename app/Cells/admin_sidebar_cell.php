 <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
     <!--begin::Sidebar Brand-->
     <div class="sidebar-brand">
         <!--begin::Brand Link-->
         <a href="./index.html" class="brand-link">
             <!--begin::Brand Image-->
             <img
                 src="<?= ASSETS_ADMIN ?>/assets/img/AdminLTELogo.png"
                 alt="AdminLTE Logo"
                 class="brand-image opacity-75 shadow" />
             <!--end::Brand Image-->
             <!--begin::Brand Text-->
             <span class="brand-text fw-light">AdminLTE 4</span>
             <!--end::Brand Text-->
         </a>
         <!--end::Brand Link-->
     </div>
     <!--end::Sidebar Brand-->
     <!--begin::Sidebar Wrapper-->
     <div class="sidebar-wrapper">
         <nav class="mt-2">
             <!--begin::Sidebar Menu-->
             <ul
                 class="nav sidebar-menu flex-column"
                 data-lte-toggle="treeview"
                 role="navigation"
                 aria-label="Main navigation"
                 data-accordion="false"
                 id="navigation">
                 <?php foreach ($menus as $menu): ?>
                     <?php if (array_key_exists('hide', $menu) && $menu['hide'] == true) {
                            continue;
                        } ?>
                        <input type="hidden" value="<?= $current_path ?>">
                     <?php if (count($menu['child']) == 0) { ?>
                         <li class="nav-item">
                             <a href="<?= $menu['url'] ?>" data-id="<?= $menu['id'] ?>" class="nav-link <?= str_contains($current_path, $menu['id']) || ($menu['id'] == 'dashboard' && ($current_path == "" || $current_path == 'admin')) ? 'active' : '' ?>">
                                 <i class="nav-icon <?= $menu['icon_class'] ?>"></i>
                                 <p><?= $menu['title'] ?></p>
                             </a>
                         </li>
                     <?php } else { ?>
                         <li class="nav-item <?= str_contains($current_path, $menu['id']) ? 'menu-open' : '' ?>">
                             <a href="#" class="nav-link">
                                 <i class="nav-icon <?= $menu['icon_class'] ?>"></i>
                                 <p>
                                     <p><?= $menu['title'] ?></p>
                                     <i class="nav-arrow bi bi-chevron-right"></i>
                                 </p>
                             </a>
                             <ul class="nav nav-treeview">
                                 <?php foreach ($menu['child'] as $submenu): ?>
                                     <li class="nav-item">
                                         <a href="<?= $submenu['url'] ?>" class="nav-link <?= str_contains($current_path, $submenu['url']) ? 'active' : '' ?>">
                                             <i class="nav-icon <?= $submenu['icon_class'] ?>"></i>
                                             <p><?= $submenu['title'] ?></p>
                                         </a>
                                     </li>
                                 <?php endforeach; ?>
                             </ul>
                         </li>
                     <?php } ?>
                 <?php endforeach; ?>
             </ul>


             <!--end::Sidebar Menu-->
         </nav>
     </div>
     <!--end::Sidebar Wrapper-->
 </aside>