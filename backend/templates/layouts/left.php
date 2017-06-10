<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->


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

        <?=dmstr\widgets\Menu::widget(
    [
        'options' => ['class' => 'sidebar-menu'],
        'items'   => [
            ['label' => Yii::t('backend','Page manager'), 'icon' => 'fa fa-clone', 'url' => ['/pages'], 'visible' => (Yii::$app->user->can("admin") || Yii::$app->user->can("technik"))],
            ['label' => Yii::t('backend','User manager'), 'icon' => 'fa fa-user', 'url' => ['/user'], 'visible' => (Yii::$app->user->can("admin") || Yii::$app->user->can("finance_moderator"))],
            ['label' => Yii::t('backend','Certificates'), 'icon' => 'fa fa-certificate', 'url' => ['/certificates'], 'visible' => (Yii::$app->user->can("admin") || Yii::$app->user->can("finance_moderator"))],
            ['label' => Yii::t('common','Packages'), 'icon' => 'fa fa-clone', 'url' => ['/packages'], 'visible' => (Yii::$app->user->can("admin") || Yii::$app->user->can("finance_moderator"))],
            ['label' => Yii::t('backend','Money logs'), 'icon' => 'fa fa-money', 'url' => ['/log-money'], 'visible' => (Yii::$app->user->can("admin") || Yii::$app->user->can("finance_moderator"))],
            ['label' => Yii::t('backend','Log Deals'), 'icon' => 'fa fa-handshake-o', 'url' => ['/log-deals'], 'visible' => (Yii::$app->user->can("admin") || Yii::$app->user->can("finance_moderator"))],
            ['label' => Yii::t('backend','Adress'), 'icon' => 'fa fa-address-book-o', 'url' => ['/adress']],
            ['label' => Yii::t('backend','Admins'), 'icon' => 'fa fa-id-card', 'url' => ['/permissions'],'visible' => Yii::$app->user->can("admin")],
            [
                'label'   => Yii::t('backend','Certificate setings'),
                'icon'    => 'fa fa-cogs',
                'url'     => '#',
                'visible' => (Yii::$app->user->can("admin") || Yii::$app->user->can("technik")), 
                'items'   => [
                    ['label' => Yii::t('backend','Apartment setigns'), 'icon' => 'fa fa-pencil', 'url' => ['/apartments']],
                    ['label' => Yii::t('backend','Club setigns'), 'icon' => 'fa fa-pencil', 'url' => ['/clubs']],
                    ['label' => Yii::t('backend','Season setigns'), 'icon' => 'fa fa-pencil', 'url' => ['/seasons']],
                    ['label' => Yii::t('backend','Companys setigns'), 'icon' => 'fa fa-pencil', 'url' => ['/companys']],
                    ['label' => Yii::t('backend','Countries setigns'), 'icon' => 'fa fa-pencil', 'url' => ['/countries']],
                    ['label' => Yii::t('backend','Time setigns'), 'icon' => 'fa fa-pencil', 'url' => ['/times']],
                ],
            ],    
            [
                'label'   => Yii::t('backend','Site setings'),
                'icon'    => 'fa fa-cogs',
                'url'     => '#',
                'visible' => (Yii::$app->user->can("admin") || Yii::$app->user->can("technik")),
                'items'   => [
                    ['label' => Yii::t('backend','Themes setigns'), 'icon' => 'fa fa-image', 'url' => ['/theme']],
                    ['label' => Yii::t('backend','Currency'), 'icon' => 'fa fa-dollar', 'url' => ['/currencies']],
                    ['label' => Yii::t('backend','Finance'), 'icon' => 'fa fa-money', 'url' => ['/finance']],
                ],
            ],
            [
                'label' => Yii::t('backend','Same tools'),
                'icon'  => 'fa fa-share',
                'url'   => '#',
                'visible' => Yii::$app->user->can("admin"),
                'items' => [
                    ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
                    /*[
                        'label' => 'Level One',
                        'icon'  => 'fa fa-circle-o',
                        'url'   => '#',
                        'items' => [
                            ['label' => 'Level Two', 'icon' => 'fa fa-circle-o', 'url' => '#'],
                            [
                                'label' => 'Level Two',
                                'icon'  => 'fa fa-circle-o',
                                'url'   => '#',
                                'items' => [
                                    ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#'],
                                    ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#'],
                                ],
                            ],
                        ],
                    ],
                     */
                ],
            ],
        ],
    ]
)?>

    </section>

</aside>
