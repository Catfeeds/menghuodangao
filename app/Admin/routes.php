<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('users', UserController::class);
    $router->resource('article-category', ArticleCategoryController::class);//文章分类
    $router->resource('article', ArticleController::class);//文章
    $router->any('article-save',"ArticleController@article_save");//文章保存
    $router->resource('config', ConfigController::class);//站点配置
    $router->any('config-save',"ConfigController@config_save");//站点配置保存
    $router->resource('ads-position', AdsPositionController::class);//广告位
    $router->resource('ads-image', AdsImageController::class);//广告位
    $router->resource('more-image', MoreImageController::class);//广告位
    $router->resource('nav', NavController::class);//导航
    $router->resource('link', LinkController::class);//友情链接
    $router->resource('recruitment-apply', RecruitmentApplyController::class);//招聘申请
    $router->resource('apply',ApplyController::class);//招聘申请

    $router->get('city', 'RegionController@city');
    $router->get('district', 'RegionController@district');
    $router->get('article-iframe', 'ArticleController@iframe');//文章
});
