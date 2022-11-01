<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'academic_grade' => ['required', 'string', 'max:191'],
            'school_name' => ['string', 'max:191'],
            'state' => ['required', 'string', 'max:191'],
            'birthdate' => ['required', 'date', 'before:today'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'academic_grade' => $input['academic_grade'],
            'school_name' => $input['school_name'],
            'state' => $input['state'],
            'birthdate' => $input['birthdate'],
        ]);

        $user->createAsStripeCustomer();

        return $user;
    }
}
