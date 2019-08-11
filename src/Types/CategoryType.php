<?php
namespace AvoRed\Graphql\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;

class CategoryType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Category',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [

        ];
    }
}
