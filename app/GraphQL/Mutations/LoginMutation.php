<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class LoginMutation extends Mutation
{
    protected $attributes = [
        'name' => 'login',
    ];

    public function args(): array
    {
        return [
            'email' => [
                'type' => Type::nonNull(Type::string()),
                // 'description' => 'User Name',
            ],
            'password' => [
                'type' => Type::nonNull(Type::string()),
                // 'description' => 'Password',
            ],
        ];
    }

    public function resolve($root, $args)
    {
        // Attempt to authenticate the user with email and password
        if (!$token = Auth::guard('api')->attempt($args)) {
            return [
                'status' => 'error',
                'message' => 'Invalid credentials',
            ];
        }

        return [
            'status' => 'success',
            'message' => 'Login successful',
            'token' => $token,
        ];
    }

    public function type(): Type
    {
        return GraphQL::type('AuthResponse');
    }
}
