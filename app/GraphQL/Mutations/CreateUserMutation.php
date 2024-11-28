<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;

class CreateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createUser',
        'description' => 'A mutation to create a new user',
    ];

    public function type(): Type
    {
        return \GraphQL::type('User'); // Make sure the User type is defined in your GraphQL schema
    }

    public function args(): array
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the user',
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email of the user',
            ],
            'password' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The password for the user',
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $user = User::create([
            'name' => $args['name'],
            'email' => $args['email'],
            'password' => Hash::make($args['password']),
        ]);

        return $user;
    }
}
