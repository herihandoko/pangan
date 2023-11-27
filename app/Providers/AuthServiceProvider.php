<?php

namespace App\Providers;

use App\Inventory;
use App\Model\Rolemodule;
use App\Policies\InventoryPolicy;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Inventory::class => InventoryPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
        Gate::define('viewAny', function (User $user, $moduleCode) {
            $result = Rolemodule::join('modules AS m', 'm.id', '=', 'module_id')
                ->where('m.code', $moduleCode)
                ->where('role_id', $user->role_id)
                ->value('acc_view');

            return $result === 1;
        });

        Gate::define('view', function (User $user, $moduleCode) {
            $result = Rolemodule::join('modules AS m', 'm.id', '=', 'module_id')
                ->where('m.code', $moduleCode)
                ->where('role_id', $user->role_id)
                ->value('acc_view');

            return $result === 1;
        });

        Gate::define('create', function (User $user, $moduleCode) {
            $result = Rolemodule::join('modules AS m', 'm.id', '=', 'module_id')
                ->where('m.code', $moduleCode)
                ->where('role_id', $user->role_id)
                ->value('acc_create');

            return $result === 1;
        });

        Gate::define('edit', function (User $user, $moduleCode) {
            $result = Rolemodule::join('modules AS m', 'm.id', '=', 'module_id')
                ->where('m.code', $moduleCode)
                ->where('role_id', $user->role_id)
                ->value('acc_edit');

            return $result === 1;
        });

        Gate::define('update', function (User $user, $moduleCode) {
            $result = Rolemodule::join('modules AS m', 'm.id', '=', 'module_id')
                ->where('m.code', $moduleCode)
                ->where('role_id', $user->role_id)
                ->value('acc_edit');

            return $result === 1;
        });

        Gate::define('delete', function (User $user, $moduleCode) {
            $result = Rolemodule::join('modules AS m', 'm.id', '=', 'module_id')
                ->where('m.code', $moduleCode)
                ->where('role_id', $user->role_id)
                ->value('acc_delete');

            return $result === 1;
        });
    }
}
