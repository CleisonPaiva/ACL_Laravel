<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;
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
//         Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        /*
                Gate::define('update-post', function (User $user, Post $post) {
                    return $user->id === $post->user_id;
                });

        */
        $permissions = Permission::with('roles')->get();
        foreach( $permissions as $permission )
        {
            Gate::define($permission->name, function(User $user) use ($permission){
                return $user->hasPermission($permission);
            });
        }
      Gate::before(function (User $user){
   if ($user->hasAnyRoles('adm'))
       return true;
      });
    }

}
