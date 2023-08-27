<?php
namespace App;
use App\Data\AbstractOrder;
use App\Data\BuyerInterface;
use Exception;
use RuntimeException;
use SellingPartnerApi\Api\FbaOutboundV20200701Api as FbaOutboundApi;
use SellingPartnerApi\Configuration;
use SellingPartnerApi\Model\FbaOutboundV20200701\Address;
use SellingPartnerApi\Model\FbaOutboundV20200701\CreateFulfillmentOrderRequest;
use SellingPartnerApi\Model\FbaOutboundV20200701\ShippingSpeedCategory;


class ShippingService implements ShippingServiceInterface
{
    protected Configuration $config;

    protected const SHIPPING_TYPES = [
        1 => 'Standard',
        2 => 'Expedited',
        3 => 'Priority',
        4 => 'ScheduledDelivery',
    ];

    public function __construct(Configuration $config){
        $this->config = $config;
    }
    public function ship(AbstractOrder $order, BuyerInterface $buyer): string
    {

        try {
            $apiInstance = new FbaOutboundApi($this->config);
            $body = new CreateFulfillmentOrderRequest([
                'seller_fulfillment_order_id' => $order->data['order_unique'],
                'displayable_order_id' => $order->data['order_id'],
                'displayable_order_date' => $order->data['order_date'],
                'displayable_order_comment' => $order->data['comments'],
                'shipping_speed_category' => new ShippingSpeedCategory(self::SHIPPING_TYPES[$order->data['shipping_type_id']]),
                'destination_address' => new Address([
                    'address_line1' => $order->data['shipping_adress'], //WTF?
                    //No, I'm not doing any filtering today
                    'city' => $order->data['shipping_city'],
                    'state_or_region' => $order->data['shipping_state'],
                    'postal_code' => $order->data['shipping_zip'],
                    'country_code' => $order->data['shipping_country'],
                ]),
            ]);

            return $apiInstance->createFulfillmentOrder($body);
        } catch (Exception $e) {
            throw new RuntimeException('Exception when calling FbaOutboundApi->createFulfillmentOrder: '. $e->getMessage());
        }
    }
}