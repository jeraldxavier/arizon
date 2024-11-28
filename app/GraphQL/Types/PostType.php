<?php

namespace App\GraphQL\Types;

use App\Models\Post;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PostType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Post',
        'description' => 'A type that represents a post',
        'model' => Post::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The ID of the post',
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The title of the post',
            ],
            'content' => [
                'type' => Type::string(),
                'description' => 'The content of the post',
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The creation date of the post',
            ],
        ];
    }
}
