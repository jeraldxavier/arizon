<?php

namespace App\GraphQL\Mutations;

use App\Models\Post;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Validation\ValidationException;

class UpdatePostMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updatePost',
    ];

    public function type(): Type
    {
        return GraphQL::type('Post');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of the post to update',
            ],
            'title' => [
                'type' => Type::string(),
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
            'id' => 'required|exists:posts,id',
            'title' => 'sometimes|string|max:30',
            'content' => 'nullable|string',
        ];
    }

    public function resolve($root, $args)
    {
        $post = Post::findOrFail($args['id']);
        $post->update($args);

        return $post;
    }
}
