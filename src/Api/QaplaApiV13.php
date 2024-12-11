<?php
/**
 * Laravel Qapla
 * Copyright since 2024 Flavio Pellizzer and Contributors
 * <Silvano Fabbro> Property
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/MIT
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to flappio.pelliccia@gmail.com so we can send you a copy immediately.
 *
 * @author    Flavio Pellizzer <flappio.pelliccia@gmail.com>
 * @copyright Since 2024 Flavio Pellizzer
 * @license   https://opensource.org/licenses/MIT
 */
declare(strict_types=1);

namespace W3design\Qapla\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class QaplaApiV13 implements QaplaApiInterface
{
    /** @var Client */
    private $client;

    /** @var string */
    private $apiKey;

    /**
     * Constructor.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->client = new Client(['base_uri' => 'https://api.qapla.it/1.3/']);
        $this->apiKey = $apiKey;
    }

    /**
     * *pushOrder*
     *
     * Allows you to upload one or more orders via a POST of the data into Qapla'
     * in JSON format
     *
     * **Schema**
     * ````json
     * {
     *     "apiKey": "string",
     *     "origin": "string",
     *     "pushOrder": [
     *         {
     *             "reference": "string",
     *             "orderID": int,
     *             "courier": "string",
     *             "courierService": "string",
     *             "status": "string",
     *             "createdAt": "datetime",
     *             "updatedAt": "datetime",
     *             "name": "string",
     *             "street": "string",
     *             "city": "string",
     *             "state": "string",
     *             "postCode": "string",
     *             "country": "string",
     *             "email": "string",
     *             "telephone": "string",
     *             "amount": float,
     *             "shippingCost": float,
     *             "currencyCode": "string",
     *             "payment": "string",
     *             "isCOD": bool,
     *             "notes": "string",
     *             "parcels": [
     *                 {
     *                     "width": int,
     *                     "height": int,
     *                     "weight": int,
     *                     "length": int,
     *                     "boxCode: null,
 *                         "content": null,
     *                     "originCountry": null
     *                 }
     *             ],
     *             "isReturnable": bool,
     *             "shippingCODPaymentOption": "string",
     *             "shippingInsurance": "string",
     *             "shippingDeliveryOptions": "string",
     *             "shippingRequiredDeliveryDate": "date",
     *             "latestShipDate": "date",
     *             "latestDeliveryDate": "date",
     *             "pickUpDate": "date",
     *             "custom1": "string",
     *             "custom2": "string",
     *             "custom3": "string",
     *             "pickupPoint": "string",
     *             "content": "string",
     *             "rows": [
     *                 {
     *                     "sku": "string",
     *                     "name": "string",
     *                     "qty": int,
     *                     "weight": float,
     *                     "url": "string",
     *                     "imageUrl": "string",
     *                     "price": float,
     *                     "total": float,
     *                     "isReturnable": bool,
     *                     "notes": "string",
     *                     "customsCode": null,
     *                     "originCountry": null,
     *                     "netWeight": null,
     *                     "unitOfMeasurement": null,
     *                     "parcelID": null,
     *                     "transparencyCodes": [
     *                         "ABC123",
     *                         "DEF456"
     *                     ]
     *                 }
     *             ],
     *             "sender": [
     *                 "code": "string",
     *                 "businessName": "string",
     *                 "street": "string",
     *                 "city": "string",
     *                 "state": "string",
     *                 "postCode": "string",
     *                 "country": "string",
     *                 "email": "string",
     *                 "telephone": "string",
     *                 "referent": "string",
     *                 "isDefault": bool
     *             ],
     *             "PUDO": [
     *                 "id": "string",
     *                 "type": "string",
     *                 "name": "string",
     *                 "address": "string",
     *                 "city": "string",
     *                 "state": "string",
     *                 "country": "string",
     *                 "postalCode": "string",
     *                 "description": "string"
     *             ],
     *             "invoice": {
     *                 "number": "string",
     *                 "date": "date"
     *             },
     *             "goodsCode": "string"
     *         }
     *     ]
     * }
     * ````
     *
     * @api https://api.qapla.dev/1.3/#pushOrder
     *
     * @required string $apiKey
     * @required array $data
     *
     * @param $data
     * @return array
     */
    public function pushOrder($data): array
    {
        try {
            $response = $this->client->post('pushOrder', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                ],
                'json' => $data,
            ]);

            return ['status' => $response->getStatusCode(), 'body' => $response->getBody()->getContents()];
        } catch (GuzzleException $e) {
            return ['status' => $e->getCode(), 'body' => $e->getMessage()];
        }
    }

    /**
     * *getOrder*
     *
     * Allows you to retrieve the details of a single order imported from Qapla'
     *
     * @api https://api.qapla.dev/1.3/#getOrder
     *
     * @required string $apiKey
     * @required string $reference
     * string $data
     *
     * @param $reference
     * @param $data
     * @return array
     */
    public function getOrder($reference, $data = null): array
    {
        try {
            $response = $this->client->get('getOrder', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                ],
                'query' => [
                    'apiKey' => $this->apiKey,
                    'reference' => $reference,
                ],
            ]);

            return ['status' => $response->getStatusCode(), 'body' => $response->getBody()->getContents()];
        } catch (GuzzleException $e) {
            return ['status' => $e->getCode(), 'body' => $e->getMessage()];
        }
    }

    /**
     * *getOrders*
     *
     * Allows you to receive the list of orders imported from Qapla'
     *
     * **Note:**
     * - Date are in ISO 8601 format (YYYY-MM-DD).
     * - Datetime are in ISO 8601 format (YYYY-MM-DDTHH:MM:SS).
     *
     * @api https://api.qapla.dev/1.2/#getOrders
     *
     * @required string $apiKey
     * @optional string $updatedAt
     * @optional string $createdAt
     * @optional string $dateIns
     * @optional string $dateFromDateTo
     *
     * @return array
     */
    public function getOrders(): array
    {
        try {
            $response = $this->client->get('getOrders', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                ],
                'query' => [
                    'apiKey' => $this->apiKey,
                ],
            ]);

            return ['status' => $response->getStatusCode(), 'body' => $response->getBody()->getContents()];
        } catch (GuzzleException $e) {
            return ['status' => $e->getCode(), 'body' => $e->getMessage()];
        }
    }
}
