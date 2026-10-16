<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Compte administrateur de démonstration.
     */
    public function run(): void
    {
        // is_admin n'est pas dans $fillable : il est affecté à la main
        $admin = User::firstOrNew(['email' => 'admin@woodycraft.test']);
        $admin->name = 'Administrateur';
        $admin->is_admin = true;

        if (! $admin->exists) {
            $admin->password = Hash::make('password');
        }

        $admin->save();
    }
}
