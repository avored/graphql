<?php

return [
    'auth' => [
        'guards' => [
            'admin_api' => [
                'driver' => 'passport',
                'provider' => 'admin-users',
                'hash' => false,
            ],
        ],
    ],
    
    'default_schema' => 'default',

    'schemas' => [
        'default' => [
            'query' => [
                'menu' => \AvoRed\Graphql\Queries\MenuQuery::class,
                'allCategory' => \AvoRed\Graphql\Queries\AllCategoryQuery::class,
                'category' => \AvoRed\Graphql\Queries\CategoryQuery::class,
                'product' => \AvoRed\Graphql\Queries\ProductQuery::class,
            ],
            'mutation' => [
                'login' => \AvoRed\Graphql\Mutations\Auth\LoginMutation::class,
                'addToCart' => \AvoRed\Graphql\Mutations\Cart\AddToCartMutation::class,
            ],
            'middleware' => [],
            'method'     => ['get', 'post'],
        ],
        'secret' => [
            'query' => [
                'order' => \AvoRed\Graphql\Queries\OrderQuery::class,
            ],
            'mutation' => [
                // 'example_mutation'  => ExampleMutation::class,
            ],
            'middleware' => ['auth:api'],
            'method'     => ['get', 'post'],
        ],
    ],

    

    // The types available in the application. You can then access it from the
    // facade like this: GraphQL::type('user')
    //
    'types' => [
        'menu' => AvoRed\Graphql\Types\MenuType::class,
        'category' => AvoRed\Graphql\Types\CategoryType::class,
        'filter' => AvoRed\Graphql\Types\FilterType::class,
        'product' => AvoRed\Graphql\Types\ProductType::class,
        'token' => AvoRed\Graphql\Types\TokenType::class,
        'cartProduct' => AvoRed\Graphql\Types\CartProductType::class,
        'order' => AvoRed\Graphql\Types\OrderType::class,
        'address' => AvoRed\Graphql\Types\AddressType::class,
    ],
];
