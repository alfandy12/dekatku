<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        return DB::transaction(function () use ($input) {
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'role' => 'user'
            ]);

            $defaultStoreName = $input['name'] . "'s Store";
            $store = Store::create([
                'title' => $defaultStoreName,
                'type' => 'product',
                'slug' => Str::slug($defaultStoreName) . '-' . Str::random(6),
                'url_media' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8',
                'location' => 'Indonesia',
                'description' => 'Welcome to ' . $defaultStoreName . '! Start managing your products and grow your business.',
            ]);

            $user->stores()->attach($store->id,);

            return $user;
        });
    }
}
