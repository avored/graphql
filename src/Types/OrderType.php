<?php
namespace AvoRed\Graphql\Types;

use AvoRed\Framework\Database\Contracts\CategoryFilterModelInterface;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class OrderType extends GraphQLType
{

    /**
     * Attribute for Order Type
     * @var array
     */
    protected $attributes = [
        'name' => 'Order',
        'description' => 'A type'
    ];

     /**
     * Fields for Order Type
     * @return array $fields
     */
    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Order Id'
            ],
            'shipping_option' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Order Shipping Option'
            ],
            'payment_option' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Order Payment Option'
            ],
            'order_status_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Order Status Id'
            ],
            'currency_code' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Order Currency Code'
            ],
            'shipping_address_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Order Shipping Address Id'
            ],
            'billing_address_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Order Billing Address Id'
            ],
            'track_code' => [
                'type' => Type::string(),
                'description' => 'Order Tracking Code'
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Order created at'
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Order updated at '
            ],
        ];
    }

    /**
     * @param \AvoRed\Framework\Database\Models\Order $order
     * @param array $args
     * @return string $taxAmount
     */
    protected function resolveTaxAmountField(Order $order, $args)
    {
        return $order->taxAmount();
    }
}
