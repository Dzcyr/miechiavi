<?php

return [

    // 站点标题
    'name' => env('APP_NAME', 'Laravel-admin') . ' - 管理后台',

    // 页面顶部 Logo
    'logo' => '<b>' . env('APP_NAME', 'Laravel-admin') . '</b>',

    // 页面顶部小 Logo
    'logo-mini' => '<b>$$$</b>',

    // Laravel-Admin 启动文件路径
    'bootstrap' => app_path('Admin/bootstrap.php'),

    // 路由配置
    'route' => [
        // 路由前缀
        'prefix' => env('ADMIN_ROUTE_PREFIX', 'admin'),
        // 控制器命名空间前缀
        'namespace' => 'App\\Admin\\Controllers',
        // 默认中间件列表
        'middleware' => ['web', 'admin'],
    ],

    // Laravel-Admin 的安装目录
    'directory' => app_path('Admin'),

    // Laravel-Admin 页面标题
    'title' => env('APP_NAME', 'Laravel') . ' - 管理后台',

    // 是否使用 https
    'https' => env('ADMIN_HTTPS', false),

    // Laravel-Admin 用户认证设置
    'auth' => [

        'controller' => App\Admin\Controllers\AuthController::class,

        'guard' => 'admin',

        'guards' => [
            'admin' => [
                'driver'   => 'session',
                'provider' => 'admin',
            ],
        ],

        'providers' => [
            'admin' => [
                'driver' => 'eloquent',
                'model'  => Encore\Admin\Auth\Database\Administrator::class,
            ],
        ],

        // 是否展示 保持登录 选项
        'remember' => true,

        // 登录页面 URL
        'redirect_to' => 'auth/login',

        // 无需用户认证即可访问的地址
        'excepts' => [
            'auth/login',
            'auth/logout',
        ],
    ],

    // Laravel-Admin 文件上传设置
    'upload' => [

        // 对应 config/filesystem.php 中的 disks
        'disk' => env('FILESYSTEM_DRIVER', 'admin'),

        // 图片和文件的上传路径
        'directory' => [
            'image' => 'images',
            'file'  => 'files',
        ],
    ],

    // Laravel-Admin 数据库设置
    'database' => [

        // 数据库连接名称，留空即可
        'connection' => '',

        // 管理员用户表及模型
        'users_table' => 'admin_users',
        'users_model' => Encore\Admin\Auth\Database\Administrator::class,

        // 角色表及模型
        'roles_table' => 'admin_roles',
        'roles_model' => Encore\Admin\Auth\Database\Role::class,

        // 权限表及模型
        'permissions_table' => 'admin_permissions',
        'permissions_model' => Encore\Admin\Auth\Database\Permission::class,

        // 菜单表及模型
        'menu_table' => 'admin_menu',
        'menu_model' => Encore\Admin\Auth\Database\Menu::class,

        // 多对多关联中间表
        'operation_log_table'    => 'admin_operation_log',
        'user_permissions_table' => 'admin_user_permissions',
        'role_users_table'       => 'admin_role_users',
        'role_permissions_table' => 'admin_role_permissions',
        'role_menu_table'        => 'admin_role_menu',
    ],

    // Laravel-Admin 操作日志设置
    'operation_log' => [

        'enable' => true,

        // 只记录以下类型的请求
        'allowed_methods' => ['GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'CONNECT', 'OPTIONS', 'TRACE', 'PATCH'],

        // 不记操作日志的路由
        'except' => [
            'admin/auth/logs*',
        ],
    ],

    // 路由是否检查权限
    'check_route_permission' => true,

    // 菜单是否检查权限
    'check_menu_roles'       => true,

    // 管理员默认头像
    'default_avatar' => '/vendor/laravel-admin/AdminLTE/dist/img/user2-160x160.jpg',

    // 地图组件提供商
    'map_provider' => 'tencent',

    /*
     * 页面风格
     * @see https://adminlte.io/docs/2.4/layout
     */
    'skin' => 'skin-blue-light',

    // 后台布局
    'layout' => ['sidebar-mini'],

    // 登录页背景图
    'login_background_image' => '',

    // 显示版本
    'show_version' => false,

    // 显示环境
    'show_environment' => false,

    // 菜单绑定权限
    'menu_bind_permission' => true,

    // 默认启用面包屑
    'enable_default_breadcrumb' => false,

    // 压缩资源文件
    'minify_assets' => [

        // 不需要被压缩的资源
        'excepts' => [],

    ],

    // 启用菜单搜索
    'enable_menu_search' => false,

    // 顶部警告信息
    'top_alert' => '',

    // 表格操作展示样式
    'grid_action_class' => \Encore\Admin\Grid\Displayers\DropdownActions::class,

    // 扩展所在的目录
    'extension_dir' => app_path('Admin/Extensions'),

    // 扩展所在的目录
    'extensions' => [
        'china-distpicker' => [
            // 如果要关掉这个扩展，设置为false
            'enable' => true,
        ],
        'latlong' => [

            // Whether to enable this extension, defaults to true
            'enable' => true,

            // Specify the default provider
            'default' => 'tencent',

            // According to the selected provider above, fill in the corresponding api_key
            'providers' => [

                'google' => [
                    'api_key' => '',
                ],

                'yadex' => [
                    'api_key' => '',
                ],

                'baidu' => [
                    'api_key' => 'xck5u2lga9n1bZkiaXIHtMufWXQnVhdx',
                ],

                'tencent' => [
                    'api_key' => 'VVYBZ-HRJCX-NOJ4Z-ZO3PU-ZZA2J-QPBBT',
                ],

                'amap' => [
                    'api_key' => '3693fe745aea0df8852739dac08a22fb',
                ],
            ]
        ]
    ],
];
