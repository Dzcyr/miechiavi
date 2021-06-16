<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // base tables
        \Encore\Admin\Auth\Database\Menu::truncate();
        \Encore\Admin\Auth\Database\Menu::insert(
            [
                [
                    "parent_id" => 0,
                    "order" => 1,
                    "title" => "首页",
                    "icon" => "fa-bar-chart",
                    "uri" => "/",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 9,
                    "title" => "系统管理",
                    "icon" => "fa-tasks",
                    "uri" => NULL,
                    "permission" => NULL
                ],
                [
                    "parent_id" => 2,
                    "order" => 10,
                    "title" => "管理员",
                    "icon" => "fa-users",
                    "uri" => "auth/users",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 2,
                    "order" => 11,
                    "title" => "角色",
                    "icon" => "fa-user",
                    "uri" => "auth/roles",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 2,
                    "order" => 12,
                    "title" => "权限",
                    "icon" => "fa-ban",
                    "uri" => "auth/permissions",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 2,
                    "order" => 13,
                    "title" => "菜单",
                    "icon" => "fa-bars",
                    "uri" => "auth/menu",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 2,
                    "order" => 14,
                    "title" => "操作日志",
                    "icon" => "fa-history",
                    "uri" => "auth/logs",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 13,
                    "order" => 4,
                    "title" => "用户列表",
                    "icon" => "fa-users",
                    "uri" => "/users",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 7,
                    "title" => "轮播图列表",
                    "icon" => "fa-file-picture-o",
                    "uri" => "/banners",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 2,
                    "title" => "房源列表",
                    "icon" => "fa-home",
                    "uri" => "/housings",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 8,
                    "title" => "文章列表",
                    "icon" => "fa-book",
                    "uri" => "/articles",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 13,
                    "order" => 5,
                    "title" => "收藏房源列表",
                    "icon" => "fa-th-large",
                    "uri" => "user-favorite-housings",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 3,
                    "title" => "用户管理",
                    "icon" => "fa-user",
                    "uri" => NULL,
                    "permission" => NULL
                ],
                [
                    "parent_id" => 13,
                    "order" => 6,
                    "title" => "查看房源记录列表",
                    "icon" => "fa-history",
                    "uri" => "/user-view-housings",
                    "permission" => NULL
                ]
            ]
        );

        \Encore\Admin\Auth\Database\Permission::truncate();
        \Encore\Admin\Auth\Database\Permission::insert(
            [
                [
                    "name" => "所有权限",
                    "slug" => "*",
                    "http_method" => "",
                    "http_path" => "*"
                ],
                [
                    "name" => "首页",
                    "slug" => "dashboard",
                    "http_method" => "GET",
                    "http_path" => "/"
                ],
                [
                    "name" => "登录",
                    "slug" => "auth.login",
                    "http_method" => "",
                    "http_path" => "/auth/login\r\n/auth/logout"
                ],
                [
                    "name" => "用户设置",
                    "slug" => "auth.setting",
                    "http_method" => "GET,PUT",
                    "http_path" => "/auth/setting"
                ],
                [
                    "name" => "系统管理",
                    "slug" => "auth.management",
                    "http_method" => "",
                    "http_path" => "/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs"
                ],
                [
                    "name" => "房源列表",
                    "slug" => "housings",
                    "http_method" => "",
                    "http_path" => "/housings"
                ],
                [
                    "name" => "用户列表",
                    "slug" => "users",
                    "http_method" => "",
                    "http_path" => "/users"
                ],
                [
                    "name" => "收藏房源列表",
                    "slug" => "user-favorite-housings",
                    "http_method" => "",
                    "http_path" => "/user-favorite-housings"
                ],
                [
                    "name" => "查看房源记录列表",
                    "slug" => "user-view-housings",
                    "http_method" => "",
                    "http_path" => "/user-view-housings"
                ],
                [
                    "name" => "轮播图列表",
                    "slug" => "banners",
                    "http_method" => "",
                    "http_path" => "/banners"
                ],
                [
                    "name" => "文章列表",
                    "slug" => "articles",
                    "http_method" => "",
                    "http_path" => "/articles"
                ]
            ]
        );

        \Encore\Admin\Auth\Database\Role::truncate();
        \Encore\Admin\Auth\Database\Role::insert(
            [
                [
                    "name" => "超级管理员",
                    "slug" => "administrator"
                ],
                [
                    "name" => "运营",
                    "slug" => "operation"
                ]
            ]
        );

        // pivot tables
        DB::table('admin_role_menu')->truncate();
        DB::table('admin_role_menu')->insert(
            [
                [
                    "role_id" => 1,
                    "menu_id" => 2
                ]
            ]
        );

        DB::table('admin_role_permissions')->truncate();
        DB::table('admin_role_permissions')->insert(
            [
                [
                    "role_id" => 1,
                    "permission_id" => 1
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 2
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 6
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 7
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 8
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 9
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 10
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 11
                ]
            ]
        );

        // finish
    }
}
