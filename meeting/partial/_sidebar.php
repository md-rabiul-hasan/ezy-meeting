
                <?php
                    $menus        = [];
                    $user_role_id = $_SESSION['role_id'];
                    $menuSql      = "SELECT * FROM menus WHERE  find_in_set($user_role_id,role_id)";
                    $menuQuery    = mysqli_query($connect, $menuSql);
                    while ($menuData = mysqli_fetch_array($menuQuery)) {
                        if ($menuData['status'] == 1) {

                            $menus['parent_menu'][$menuData['id']] = [
                                'id'                => $menuData['id'],
                                'menu_name'         => $menuData['menu_name'],
                                'link'              => $menuData['link'],
                                'status'            => $menuData['status'],
                                'parent_id'         => $menuData['parent_id'],
                                'submenu_parent_id' => $menuData['submenu_parent_id'],
                                'icon'              => $menuData['icon'],
                                'role_id'           => $menuData['role_id'],
                                'submenu'           => [],
                            ];
                        }

                        if ($menuData['status'] == 2) {
                            $menus['parent_menu'][$menuData['parent_id']]['submenu'][$menuData['id']] = [
                                'id'                => $menuData['id'],
                                'menu_name'         => $menuData['menu_name'],
                                'link'              => $menuData['link'],
                                'status'            => $menuData['status'],
                                'parent_id'         => $menuData['parent_id'],
                                'submenu_parent_id' => $menuData['submenu_parent_id'],
                                'icon'              => $menuData['icon'],
                                'role_id'           => $menuData['role_id'],
                                'submenu_submenu'   => [],
                            ];
                        }

                        if ($menuData['status'] == 3 && $menuData['submenu_parent_id'] != 0) {
                            $menus['parent_menu'][$menuData['submenu_parent_id']]['submenu'][$menuData['parent_id']]['submenu_submenu'][$menuData['id']] = [
                                'id'                => $menuData['id'],
                                'menu_name'         => $menuData['menu_name'],
                                'link'              => $menuData['link'],
                                'status'            => $menuData['status'],
                                'parent_id'         => $menuData['parent_id'],
                                'submenu_parent_id' => $menuData['submenu_parent_id'],
                                'icon'              => $menuData['icon'],
                                'role_id'           => $menuData['role_id'],
                            ];
                        }
                    }
                ?>
        <!-- SIDEBAR -->
        <aside class="site-sidebar scrollbar-enabled  pt-4" data-suppress-scroll-x="true">
            <!-- Sidebar Menu -->
            <nav class="sidebar-nav">
                <ul class="nav  in side-menu">

                    <?php foreach($menus['parent_menu'] as $parent_menu){ ?>

                        <?php 
                            $path = $parent_menu['link'];
                            $pageName = pathinfo($path,PATHINFO_BASENAME);
                            $isActiveParentMenu = ( basename($_SERVER['PHP_SELF']) == $pageName ) ? 'active' : '';

                         
                        ?>
                        
                        <?php if(count($parent_menu['submenu']) > 0) : ?>
                            <li class="menu-item-has-children">
                                <a href="#" class="main">
                                    <i class="list-icon <?php echo $parent_menu['icon']; ?>"></i> 
                                    <span class="hide-menu"><?php echo $parent_menu['menu_name']; ?></span>
                                </a>
                                <?php foreach($parent_menu['submenu'] as $parent_sub_menu) : ?>
                                <ul class="list-unstyled sub-menu collapse">
                                    <li>
                                        <a href="<?php echo $addDot.$parent_sub_menu['link']; ?>">
                                            <?php  echo $parent_sub_menu['menu_name']; ?>
                                        </a>
                                    </li>                                    
                                </ul>
                                <?php endforeach; ?>
                            </li>
                        <?php else: ?>
                            <li class="current-page <?php echo $isActiveParentMenu; ?>">
                                <a href="<?php echo $addDot.$parent_menu['link']; ?>">
                                    <i class="list-icon <?php echo $parent_menu['icon']; ?>"></i> 
                                    <span class="hide-menu"><?php echo $parent_menu['menu_name']; ?></span>
                                </a>
                            </li>
                        <?php endif; ?>


                    <?php } ?>
                    
                </ul>
                <!-- /.side-menu -->
            </nav>
            <!-- /.sidebar-nav -->

            <span style="color: #fff;text-align: center;font-size: 13px;border-top: 1px dashed #888;padding-top: 10px;">  @2020  All rights reserved <br><b style="font-size: 14px;">Venture Solution Limited</b></span>
        </aside>
        <!-- /.site-sidebar -->