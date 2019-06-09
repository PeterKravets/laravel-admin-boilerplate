<?php

namespace App\useCases;


use App\Exceptions\GeneralException;
use App\Models\Auth\SocialAccount;
use App\Models\User;

class SocialiteService
{
    /**
     * @param $data
     * @param $provider
     *
     * @throws GeneralException
     * @return mixed
     */
    public function findOrCreateProvider($data, $provider)
    {
        // User email may not provided.
        $user_email = $data->email ?: "{$data->id}@{$provider}.com";

        // Check to see if there is a user with this email first.
        $user = $this->getByColumn($user_email, 'email');

        /*
         * If the user does not exist create them
         * The true flag indicate that it is a social account
         * Which triggers the script to use some default values in the create method
         */
        if (! $user) {
            // Get users first name and last name from their full name
            $nameParts = $this->getNameParts($data->getName());

            $user = User::create([
                'first_name' => $nameParts['first_name'],
                'last_name' => $nameParts['last_name'],
                'email' => $user_email,
                'active' => true,
                'confirmed' => true,
                'password' => null,
                'avatar_type' => $provider,
            ]);

            if ($user) {
                // Add the default site role to the new user
                $user->assignRole(config('access.users.default_role'));
            }
        }

        // See if the user has logged in with this social account before
        if (! $user->hasProvider($provider)) {
            // Gather the provider data for saving and associate it with the user
            $user->providers()->save(new SocialAccount([
                'provider' => $provider,
                'provider_id' => $data->id,
                'token' => $data->token,
                'avatar' => $data->avatar,
            ]));
        } else {
            // Update the users information, token and avatar can be updated.
            $user->providers()->update([
                'token' => $data->token,
                'avatar' => $data->avatar,
            ]);

            $user->avatar_type = $provider;
            $user->update();
        }

        // Return the user object
        return $user;
    }

    /**
     * @param $fullName
     *
     * @return array
     */
    protected function getNameParts($fullName)
    {
        $parts = array_values(array_filter(explode(' ', $fullName)));
        $size = count($parts);
        $result = [];

        if (empty($parts)) {
            $result['first_name'] = null;
            $result['last_name'] = null;
        }

        if (! empty($parts) && $size == 1) {
            $result['first_name'] = $parts[0];
            $result['last_name'] = null;
        }

        if (! empty($parts) && $size >= 2) {
            $result['first_name'] = $parts[0];
            $result['last_name'] = $parts[1];
        }

        return $result;
    }
}
