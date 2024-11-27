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
        Permission::firstOrCreate(['name' => 'joke browse']);
        Permission::firstOrCreate(['name' => 'joke read']);
        Permission::firstOrCreate(['name' => 'joke add']);
        Permission::firstOrCreate(['name' => 'joke edit']);
        Permission::firstOrCreate(['name' => 'joke delete']);

        // user permission
        Permission::firstOrCreate(['name' => 'user browse']);
        Permission::firstOrCreate(['name' => 'user read']);
        Permission::firstOrCreate(['name' => 'user add']);
        Permission::firstOrCreate(['name' => 'user edit']);
        Permission::firstOrCreate(['name' => 'user delete']);
        Permission::firstOrCreate(['name' => 'user restore']);
        Permission::firstOrCreate(['name' => 'user force delete']);

        // role
        $superUser = Role::firstOrCreate(['name' => 'superuser']);
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $staff = Role::firstOrCreate(['name' => 'staff']);
        $client = Role::firstOrCreate(['name' => 'client']);

        $superUser->givePermissionTo(Permission::all());
        $admin->givePermissionTo([
            'joke browse', 'joke add', 'joke edit', 'joke delete',
            'user browse', 'user add', 'user edit', 'user delete',
            'user restore', 'user force delete',
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
