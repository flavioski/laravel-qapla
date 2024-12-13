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
use W3design\Qapla\Dto\GetOrderV13Request;
use W3design\Qapla\Qapla;

class QaplaApiV13 implements QaplaApiInterface, OrderApiV13Interface
{
    /** @var Client */
    private Client $client;

    /** @var string */
    private string $privateApiKey;

    /** @var string */
    private string $publicApiKey;

    /**
     * Constructor.
     *
     * @param string $privateApiKey
     * @param string $publicApiKey
     */
    public function __construct(string $privateApiKey, string $publicApiKey)
    {
        $this->client = new Client([
            'base_uri' => 'https://api.qapla.it/1.3/',
            'headers' => [
                'Authorization' => 'Bearer ' . $privateApiKey,
            ],
        ]);

        $this->privateApiKey = $privateApiKey;
        $this->publicApiKey = $publicApiKey;
    }

    /**
     * *getPrivateApiKey*
     * @return string
     */
    public function getPrivateApiKey(): string
    {
        return $this->privateApiKey;
    }

    /**
     * *setPrivateApiKey*
     * @param string $privateApiKey
     * @return QaplaApiV13
     */
    public function setPrivateApiKey(string $privateApiKey): QaplaApiV13
    {
        $this->privateApiKey = $privateApiKey;

        return $this;
    }

    /**
     * *getPublicApiKey*
     * @return string
     */
    public function getPublicApiKey(): string
    {
        return $this->publicApiKey;
    }

    /**
     * *setPublicApiKey*
     * @param string $publicApiKey
     * @return QaplaApiV13
     */
    public function setPublicApiKey(string $publicApiKey): QaplaApiV13
    {
        $this->publicApiKey = $publicApiKey;

        return $this;
    }

    /**
     * *getChannel*
     *
     * Allows you to retrieve the details of the channel associated with the API key
     * in JSON format
     *
     * @api https://api.qapla.dev/1.2/#pushOrder
     *
     * @required string $apiKey
     * @optional string $data
     *
     * @param string|null $data
     * @return array
     */
    public function getChannel(string $data = null): array
    {
        try {
            $response = $this->client->get('getChannel', [
                'query' => [
                    'apiKey' => $this->privateApiKey,
                    'data' => $data,
                ],
            ]);

            return [
                'status' => $response->getStatusCode(),
                'body' => json_decode($response->getBody()->getContents(), true),
            ];
        } catch (GuzzleException $e) {
            return ['status' => $e->getCode(), 'body' => $e->getMessage()];
        }
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
    /*public function pushOrderV13($data): array
    {
        try {
            $response = $this->client->post('pushOrder', [
                'json' => $data,
            ]);

            return ['status' => $response->getStatusCode(), 'body' => $response->getBody()->getContents()];
        } catch (GuzzleException $e) {
            return ['status' => $e->getCode(), 'body' => $e->getMessage()];
        }
    }*/

    /**
     * *getOrder*
     *
     * Allows you to retrieve the details of a single order imported from Qapla'
     *
     * @api https://api.qapla.dev/1.3/#getOrder
     *
     * @required string $apiKey
     * @required string $reference
     * @optional string $data
     *
     * @param GetOrderV13Request $request
     * @return array
     */
    public function getOrderV13(GetOrderV13Request $request): array
    {
        $query = [
            'apiKey' => $request->getApiKey(),
            'reference' => $request->getReference(),
        ];

        if ($request->getData() !== null) {
            $query['data'] = $request->getData();
        }

        try {
            $response = $this->client->get('getOrder', [
                'query' => $query,
            ]);

            return [
                'status' => $response->getStatusCode(),
                'body' => json_decode($response->getBody()->getContents(), true),
            ];
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
    /*public function getOrdersV13(): array
    {
        try {
            $response = $this->client->get('getOrders', [
                'query' => [
                    'apiKey' => $this->publicApiKey,
                ],
            ]);

            return [
                'status' => $response->getStatusCode(),
                'body' => json_decode($response->getBody()->getContents(), true),
            ];
        } catch (GuzzleException $e) {
            return ['status' => $e->getCode(), 'body' => $e->getMessage()];
        }
    }*/
}
