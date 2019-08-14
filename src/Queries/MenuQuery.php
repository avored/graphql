<?php

declare(strict_types=1);

namespace AvoRed\Graphql\Queries;

use AvoRed\Framework\Database\Contracts\MenuGroupModelInterface;
use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

class MenuQuery extends Query
{
    protected $attributes = [
        'name' => 'menu',
        'description' => 'A query'
    ];

    /**
     * Menu Group Repository
     * @var AvoRed\Framework\Database\Repository\MenuGroupRepository
     */
    protected $menuGroupRepository;

    /**
     * Menu Query construct
     * @param \AvoRed\Framework\Database\Contracts\MenuGroupModelInterface $menuGroupRepository
     * @return void
     */
    public function __construct(MenuGroupModelInterface $menuGroupRepository)
    {
        $this->menuGroupRepository = $menuGroupRepository;
    }

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('menu'));
    }

    public function args(): array
    {
        return [
            'identifier' => [
                'name' => 'identifier',
                'type' => Type::nonNull(Type::string())
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return $this->menuGroupRepository->getTreeByIdentifier($args['identifier']);
    }
}
