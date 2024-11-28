<?php

namespace App\GraphQL\Mutations;

use App\Models\Post;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Validation\ValidationException;

class CreatePostMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createPost',
    ];

    public function type(): Type
    {
        return GraphQL::type('Post');
    }

    public function args(): array
    {
        return [
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Title of the post',
            ],
            'content' => [
                'type' => Type::string(),
                'description' => 'Content of the post',
            ],
        ];
    }

    public function rules(array $args = []): array
    {
        return [
            'title' => 'required|string|max:30',
            'content' => 'nullable|string',
        ];
    }

    public function resolve($root, $args)
    {
        return Post::create($args);
    }
}
