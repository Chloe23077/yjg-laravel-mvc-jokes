<?php
// joke permission
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => 'joke browse']);
        Permission::create(['name' => 'joke read']);
        Permission::create(['name' => 'joke add']);
        Permission::create(['name' => 'joke edit']);
        Permission::create(['name' => 'joke delete']);

        // user permission
        Permission::create(['name' => 'user browse']);
        Permission::create(['name' => 'user read']);
        Permission::create(['name' => 'user add']);
        Permission::create(['name' => 'user edit']);
        Permission::create(['name' => 'user delete']);

        // role
        $superUser = Role::create(['name' => 'superuser']);
        $admin = Role::create(['name' => 'admin']);
        $staff = Role::create(['name' => 'staff']);
        $client = Role::create(['name' => 'client']);

        $superUser->givePermissionTo(Permission::all());
        $admin->givePermissionTo([
            'joke browse', 'joke add', 'joke edit', 'joke delete',
            'user browse', 'user add', 'user edit', 'user delete',
        ]);
        $staff->givePermissionTo([
            'joke browse', 'joke add', 'joke edit', 'joke delete',
            'user browse'
        ]);
        $client->givePermissionTo([
            'joke browse', 'joke add', 'joke edit', 'joke delete'
        ]);

    }
}
