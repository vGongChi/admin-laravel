<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    // 新增后台管理路由
    $router->resource('banners', 'BannersController');//轮播图
    $router->resource('navigations', 'NavigationController');//导航菜单
    $router->resource('company-profiles', 'CompanyProfileController');//公司简介
    $router->resource('business-scopes', 'BusinessScopeController');//业务范围
    $router->resource('contact-infos', 'ContactInfoController');//联系信息
    $router->resource('messages', 'MessagesController');//消息管理
    $router->resource('site-configs', 'SiteConfigController');//站点配置

});
 