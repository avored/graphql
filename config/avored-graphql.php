<?php

return [

    'default_schema' => 'default',

    'schemas' => [
        'default' => [
            'query' => [
                'category' => \AvoRed\Graphql\Queries\CategoryQuery::class,
            ],
            'mutation' => [
                // 'example_mutation'  => ExampleMutation::class,
            ],
            'middleware' => [],
            'method'     => ['get', 'post'],
        ],
    ],

    // The types available in the application. You can then access it from the
    // facade like this: GraphQL::type('user')
    //
    'types' => [
        'category'           => AvoRed\Graphql\Types\CategoryType::class,
        // 'relation_example'  => ExampleRelationType::class,
        // \Rebing\GraphQL\Support\UploadType::class,
    ],
];
