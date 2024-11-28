<?php

namespace App\GraphQL\Queries;

use App\Models\Post;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class PostQuery extends Query
{
    protected $attributes = [
        'name' => 'posts', // This is the query name in the GraphQL schema
    ];

    // Define the return type of the query
    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Post')); // Return a list of Post objects
    }

    // Define arguments for the query (e.g., for filtering posts)
    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
            ],
        ];
    }

    // Resolve the query: Fetch posts from the database
    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return Post::find($args['id']); // Fetch single post by ID
        }

        return Post::all(); // Return all posts if no ID is provided
    }
}
