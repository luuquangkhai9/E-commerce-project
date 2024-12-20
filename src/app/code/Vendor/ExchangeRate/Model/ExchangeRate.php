<?php
namespace Vendor\ExchangeRate\Model;

class ExchangeRate
{
    const API_URL = 'https://portal.vietcombank.com.vn/Usercontrols/TVPortal.TyGia/pXML.aspx?b=68';

    /**
     * Get exchange rates from Vietcombank.
     *
     * @return array|null
     */
    public function getExchangeRates()
    {
        try {
            $xmlString = file_get_contents(self::API_URL);
            $xml = simplexml_load_string($xmlString);
            $json = json_encode($xml);
            $array = json_decode($json, true);

            if (isset($array['Exrate'])) {
                $result = [];
                foreach ($array['Exrate'] as $rate) {
                    $result[$rate['@attributes']['CurrencyCode']] = [
                        'buy' => $rate['@attributes']['Buy'],
                        'transfer' => $rate['@attributes']['Transfer'],
                        'sell' => $rate['@attributes']['Sell'],
                    ];
                }
                return $result;
            }
        } catch (\Exception $e) {
            // Log error for debugging
            error_log($e->getMessage());
            return null;
        }
        return null;
    }
}