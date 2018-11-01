<?php
use app\models\User;
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel" style="margin-top: 10px;">
            <div class="pull-left image">
                <?php if (User::isAdmin()): ?>
                           <?= User::getFotoAdmin(['class' => 'img-circle']); ?>
                       <?php endif ?>
                       <?php if (User::isAnggota()): ?>
                           <?= User::getFotoAnggota(['class' => 'img-circle']); ?>
                       <?php endif ?>
                       <?php if (User::isPetugas()): ?>
                           <?= User::getFotoPetugas(['class' => 'img-circle']); ?>
                       <?php endif ?>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <?php if (User::isAdmin()){ ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Perpustakaan', 'options' => ['class' => 'header']],
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['site/index']],
                    // ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Data Peminjaman', 'icon' => 'exchange', 'url' => ['peminjaman/index']],
                    [
                        'label' => 'Data Buku',
                        'icon' => 'book',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Buku', 'icon' => 'book', 'url' => ['buku/index']],
                            ['label' => 'Penerbit', 'icon' => 'bookmark', 'url' => ['penerbit/index']],
                            ['label' => 'Penulis', 'icon' => 'pencil', 'url' => ['penulis/index']],
                            ['label' => 'kategori', 'icon' => 'list', 'url' => ['kategori/index']],
                            ['label' => 'Denda', 'icon' => 'dollar', 'url' => ['kenaikan-denda/index']],
                        ],
                    ],

                    [
                        'label' => 'User',
                        'icon' => 'users',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Anggota', 'icon' => 'circle', 'url' => ['anggota/index']],
                            ['label' => 'Petugas', 'icon' => 'circle', 'url' => ['petugas/index']],
                            // ['label' => 'Petugas', 'url' => ['petugas/index'], 'visible' => Yii::$app->user->isGuest],
                            // ['label' => 'Anggota', 'url' => ['anggota/index'], 'visible' => Yii::$app->user->isGuest],
                        ],
                    ],
                    ['label' => 'Menu Fitur Lain', 'options' => ['class' => 'header']],
                        [
                            'label' => 'Fitur Lain',
                            'icon' => 'gear',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                                ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                                ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                            ],
                        ],
                        ['label' => 'Lain-lain', 'options' => ['class' => 'header']],
                        ['label' => 'Kontak', 'icon' => 'tty', 'url' => ['site/contact'],],
                        ['label' => 'Tentang', 'icon' => 'font', 'url' => ['site/about'],],
                        
                ],  
            ]
        ) ?>

        <?php } elseif(User::isAnggota()) { ?>
            <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Perpustakaan', 'options' => ['class' => 'header']],
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['site/index']],
                    // ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Data Peminjaman', 'icon' => 'exchange', 'url' => ['peminjaman/index']],
                    ],  
            ]
        ) ?>

    <?php } elseif(User::isPetugas()) {?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Perpustakaan', 'options' => ['class' => 'header']],
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['site/index']],
                    // ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    // ['label' => 'Data Peminjaman', 'icon' => 'exchange', 'url' => ['peminjaman/index']],
                    ['label' => 'Data Peminjaman', 'icon' => 'exchange', 'url' => ['peminjaman/index']],
                    [
                        'label' => 'Data Buku',
                        'icon' => 'book',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Buku', 'icon' => 'book', 'url' => ['buku/index']],
                            ['label' => 'Penerbit', 'icon' => 'bookmark', 'url' => ['penerbit/index']],
                            ['label' => 'Penulis', 'icon' => 'pencil', 'url' => ['penulis/index']],
                            ['label' => 'kategori', 'icon' => 'list', 'url' => ['kategori/index']],
                        ],
                    ],
                    ['label' => 'Profil saya', 'icon' => 'user', 'url' => ['buku/update', Yii::$app->user->identity->id_user_role == 3]],
                ],  
            ]
        ) ?>

        <?php } ?>

        

    </section>

</aside>
