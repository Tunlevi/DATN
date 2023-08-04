<?php
/**
 * Created by PhpStorm .
 * User: trungphuna .
 * Date: 4/30/23 .
 * Time: 12:46 AM .
 */


return [
    [
        'icon'   => 'home',
        'name'   => 'Admin',
        'route'  => 'get_admin.index',
        'prefix' => ['']
    ],
    [
        'icon'   => 'database',
        'name'   => 'Product',
        'route'  => 'get_admin.product.index',
        'prefix' => ['']
    ],
    [
        'icon'   => 'shopping-cart',
        'name'   => 'Order',
        'route'  => 'get_admin.order.index',
        'prefix' => ['']
    ],
    [
        'icon'   => 'user',
        'name'   => 'User',
        'route'  => 'get_admin.user.index',
        'prefix' => ['']
    ],
];
