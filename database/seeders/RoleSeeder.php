<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Empty the table first
        Role::truncate();
        
        //Admin Role.....i.e The system administratos
        $admin = new Role();
        $admin->type = "Admin";
        $admin->save();

    //Regular Role (for registration compatibility, type must be 'Regular')
    $regular = new Role();
    $regular->type = "Regular";
    $regular->save();

        //Lost & Found Manager Role
        $manager = new Role();
        $manager->type = "Lost & Found Manager";
        $manager->save();

        //ID replacement approver role.......i.e The course administrators
        $approver = new Role();
        $approver->type = "ID Replacement Approver";
        $approver->save();
    }
}
