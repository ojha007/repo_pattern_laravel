<?php
Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function ($router) {
    $router->apiResource('products', 'ProductController');
    $router->apiResource('products_categories', 'ProductCategoryController');
    $router->apiResource('blog_categories', 'BlogCategoryController');
    $router->apiResource('blog', 'BlogController');
    $router->patch('blog/{blog}/change_status', 'BlogController@changeStatus');
    $router->get('count/{modal_name}', 'BaseController@count');
    $router->get('user', 'UserController@show');
    $router->apiResource('roles', 'RoleController');
    $router->apiResource('permissions', 'PermissionController');
    $router->fallback(function () {
        return response()->json([
            'message' => 'Page Not Found.'], 404);
    });
});
Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function ($router) {
    $router->post('register', 'UserController@register');
    $router->post('login', 'UserController@login');
    $router->middleware('auth:api')->get('show', 'UserController@show');
});


