<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\InventoryItem;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class InventoryItem202110Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2021-10";

        $this->test_session = new Session("session_id", "test-shop.myshopify.io", true, "1234");
        $this->test_session->setAccessToken("this_is_a_test_token");
    }

    /**

     *
     * @return void
     */
    public function test_1(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/inventory_items.json?ids=808950810%2C39072856%2C457924702",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        InventoryItem::all(
            $this->test_session,
            [],
            ["ids" => "808950810,39072856,457924702"],
        );
    }

    /**

     *
     * @return void
     */
    public function test_2(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/inventory_items/808950810.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        InventoryItem::find(
            $this->test_session,
            808950810,
            [],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_3(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/inventory_items/808950810.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["inventory_item" => ["id" => 808950810, "sku" => "new sku"]]),
            ),
        ]);

        $inventory_item = new InventoryItem($this->test_session);
        $inventory_item->id = 808950810;
        $inventory_item->sku = "new sku";
        $inventory_item->save();
    }

    /**

     *
     * @return void
     */
    public function test_4(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/inventory_items/808950810.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["inventory_item" => ["id" => 808950810, "cost" => "25.00"]]),
            ),
        ]);

        $inventory_item = new InventoryItem($this->test_session);
        $inventory_item->id = 808950810;
        $inventory_item->cost = "25.00";
        $inventory_item->save();
    }

}