<?php
/**
 * Created by PhpStorm.
 * User: Jarbit
 * Date: 17/11/2014
 * Time: 12:17
 */

namespace Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider {

    public function register(){
        $app = $this->app;
        $app->bind('Repositories\Administrator\ProductRepository', 'Repositories\Administrator\ProductEloquent');
        $app->bind('Repositories\Administrator\ProductCategoryRepository', 'Repositories\Administrator\ProductCategoryEloquent');
        $app->bind('Repositories\Administrator\ProviderRepository', 'Repositories\Administrator\ProviderEloquent');
        $app->bind('Repositories\Administrator\ClientRepository', 'Repositories\Administrator\ClientEloquent');
        $app->bind('Repositories\Administrator\ClientRepository', 'Repositories\Administrator\ClientEloquent');
        $app->bind('Repositories\Administrator\InvoiceRepository', 'Repositories\Administrator\InvoiceEloquent');
        $app->bind('Repositories\Administrator\UserRepository', 'Repositories\Administrator\UserEloquent');
        $app->bind('Repositories\Administrator\RoleRepository', 'Repositories\Administrator\RoleEloquent');
        $app->bind('Repositories\Administrator\PermissionRepository', 'Repositories\Administrator\PermissionEloquent');
    }
} 