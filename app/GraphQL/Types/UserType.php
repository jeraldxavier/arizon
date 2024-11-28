<?php

namespace App\GraphQL\Types;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A type that describes a user',
        'model' => User::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The ID of the user',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the user',
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of the user',
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The creation timestamp of the user',
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The last update timestamp of the user',
            ],
        ];
    }
}
