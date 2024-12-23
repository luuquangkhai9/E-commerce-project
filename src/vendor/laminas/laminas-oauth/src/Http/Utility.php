<?php

namespace Laminas\OAuth\Http;

use Laminas\OAuth\Config\ConfigInterface;

use function array_merge;
use function count;
use function explode;
use function implode;
use function md5;
use function preg_match;
use function rand;
use function rawurldecode;
use function rawurlencode;
use function str_replace;
use function strtolower;
use function time;
use function ucfirst;
use function uniqid;

class Utility
{
    /**
     * Assemble all parameters for a generic OAuth request - i.e. no special
     * params other than the defaults expected for any OAuth query.
     *
     * @param  string $url
     * @param  null|array $serviceProviderParams
     * @return array
     */
    public function assembleParams(
        $url,
        ConfigInterface $config,
        ?array $serviceProviderParams = null
    ) {
        $params = [
            'oauth_consumer_key'     => $config->getConsumerKey(),
            'oauth_nonce'            => $this->generateNonce(),
            'oauth_signature_method' => $config->getSignatureMethod(),
            'oauth_timestamp'        => $this->generateTimestamp(),
            'oauth_version'          => $config->getVersion(),
        ];

        if ($config->getToken()->getToken() !== null) {
            $params['oauth_token'] = $config->getToken()->getToken();
        }

        if ($serviceProviderParams !== null) {
            $params = array_merge($params, $serviceProviderParams);
        }

        $params['oauth_signature'] = $this->sign(
            $params,
            $config->getSignatureMethod(),
            $config->getConsumerSecret(),
            $config->getToken()->getTokenSecret(),
            $config->getRequestMethod(),
            $url
        );

        return $params;
    }

    /**
     * Given both OAuth parameters and any custom parameters, generate an
     * encoded query string. This method expects parameters to have been
     * assembled and signed beforehand.
     *
     * @param array $params
     * @param bool $customParamsOnly Ignores OAuth params e.g. for requests using OAuth Header
     * @return string
     */
    public function toEncodedQueryString(array $params, $customParamsOnly = false)
    {
        if ($customParamsOnly) {
            foreach ($params as $key => $value) {
                if (preg_match("/^oauth_/", $key)) {
                    unset($params[$key]);
                }
            }
        }
        $encodedParams = [];
        foreach ($params as $key => $value) {
            $encodedParams[] = self::urlEncode($key)
                             . '='
                             . self::urlEncode($value);
        }
        return implode('&', $encodedParams);
    }

    /**
     * Cast to authorization header
     *
     * @param  array $params
     * @param  null|string $realm
     * @param  bool $excludeCustomParams
     * @return string
     */
    public function toAuthorizationHeader(array $params, $realm = null, $excludeCustomParams = true)
    {
        $headerValue = [
            'OAuth realm="' . $realm . '"',
        ];

        foreach ($params as $key => $value) {
            if ($excludeCustomParams) {
                if (! preg_match("/^oauth_/", $key)) {
                    continue;
                }
            }
            $headerValue[] = self::urlEncode($key)
                           . '="'
                           . self::urlEncode($value) . '"';
        }
        return implode(",", $headerValue);
    }

    /**
     * Sign request
     *
     * @param  array $params
     * @param  string $signatureMethod
     * @param  string $consumerSecret
     * @param  null|string $tokenSecret
     * @param  null|string $method
     * @param  null|string $url
     * @return string
     */
    public function sign(
        array $params,
        $signatureMethod,
        $consumerSecret,
        $tokenSecret = null,
        $method = null,
        $url = null
    ) {
        $className = '';
        $hashAlgo  = null;
        $parts     = explode('-', (string) $signatureMethod);
        if (count($parts) > 1) {
            $className = 'Laminas\OAuth\Signature\\' . ucfirst(strtolower($parts[0]));
            $hashAlgo  = $parts[1];
        } else {
            $className = 'Laminas\OAuth\Signature\\' . ucfirst(strtolower($signatureMethod));
        }

        $signatureObject = new $className($consumerSecret, $tokenSecret, $hashAlgo);
        return $signatureObject->sign($params, $method, $url);
    }

    /**
     * Parse query string
     *
     * @param  mixed $query
     * @return array
     */
    public function parseQueryString($query)
    {
        $params = [];
        if (empty($query)) {
            return [];
        }

        // Not remotely perfect but beats parse_str() which converts
        // periods and uses urldecode, not rawurldecode.
        $parts = explode('&', $query);
        foreach ($parts as $pair) {
            $kv                           = explode('=', $pair);
            $params[rawurldecode($kv[0])] = rawurldecode($kv[1]);
        }
        return $params;
    }

    /**
     * Generate nonce
     *
     * @return string
     */
    public function generateNonce()
    {
        return md5(uniqid(rand(), true));
    }

    /**
     * Generate timestamp
     *
     * @return int
     */
    public function generateTimestamp()
    {
        return time();
    }

    /**
     * urlencode a value
     *
     * @param  string $value
     * @return string
     */
    public static function urlEncode($value)
    {
        $encoded = rawurlencode((string) $value);
        $encoded = str_replace('%7E', '~', $encoded);
        return $encoded;
    }
}
