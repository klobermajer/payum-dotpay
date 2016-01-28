<?php

namespace Pixers\Payum\Dotpay;

use Payum\Core\Bridge\Guzzle\HttpClientFactory;
use Payum\Core\Bridge\Spl\ArrayObject;
use Payum\Core\HttpClientInterface;
use Pixers\Payum\Dotpay\Constants;

/**
 * Dotpay api
 *
 * @author Michał Kanak <kanakmichal@gmail.com>
 */
class Api
{

    /**
     * Dotpay api version
     */
    const VERSION = '0.8.32';
    const DEFAULT_ENDPOINT = 'https://ssl.dotpay.pl/';
    
    /**
     * @var HttpClientInterface
     */
    protected $client;

    /**
     * @var array
     */
    protected $options = [
        'id' => null,
        'URLC' => null,
        'url' => null,
        'endpoint' => self::DEFAULT_ENDPOINT,
        'method' => 'GET',
        'type' => Constants::TYPE_RETURN_BUTTON_AND_NOTIFY,
        'PIN' => null,
        'ip' => null
    ];

    /**
     * @param array $options
     * @param HttpClientInterface|null $client
     */
    public function __construct(array $options, HttpClientInterface $client = null)
    {
        $options = ArrayObject::ensureArrayObject($options);
        $options->defaults($this->options);
        $options->validateNotEmpty([
            'id',
        ]);

        $this->options = $options;
        $this->client = $client ? : HttpClientFactory::create();
    }

    /**
     * @return string
     */
    protected function getApiEndpoint()
    {
        return $this->options['endpoint'];
    }

    /**
     *
     * @return array
     */
    public function getApiOptions()
    {
        return $this->options;
    }

}
