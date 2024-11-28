<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class AuthResponseType extends GraphQLType
{
    protected $attributes = [
        'name' => 'AuthResponse',
        'description' => 'Response for login and authentication',
    ];

    public function fields(): array
    {
        return [
            'status' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Status of the login request',
            ],
            'message' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Message of the response',
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'JWT token (if login is successful)',
            ],
        ];
    }
}
