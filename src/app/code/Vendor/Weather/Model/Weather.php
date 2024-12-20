<?php
namespace Vendor\Weather\Model;

use Magento\Framework\HTTP\Client\Curl;

class Weather
{
    const API_URL = 'https://api.openweathermap.org/data/2.5/forecast'; // Thay đổi API URL
    const API_KEY = '665f5e240fa6b0b27f155733f7dfd6ca'; // Thay YOUR_API_KEY bằng API Key của bạn
    const DEFAULT_CITY = 'Hanoi';
    const DEFAULT_COUNTRY_CODE = 'vn';
    const DEFAULT_UNITS = 'metric'; // Hệ đo lường (metric: Celsius, imperial: Fahrenheit)

    /**
     * @var Curl
     */
    protected $curlClient;

    /**
     * Weather constructor.
     *
     * @param Curl $curl
     */
    public function __construct(
        Curl $curl
    )
    {
        $this->curlClient = $curl;
    }

    /**
     * Get weather data from OpenWeatherMap.
     *
     * @param string|null $city
     * @param string|null $countryCode
     * @return array|null
     */
    public function getWeatherData($city = null, $countryCode = null)
    {
        $city = $city ?? self::DEFAULT_CITY;
        $countryCode = $countryCode ?? self::DEFAULT_COUNTRY_CODE;
        $url = self::API_URL . "?q={$city},{$countryCode}&appid=" . self::API_KEY . "&units=" . self::DEFAULT_UNITS;

        try {
            $this->curlClient->get($url);
            $response = $this->curlClient->getBody();
            $data = json_decode($response, true);

            if (isset($data['cod']) && $data['cod'] == 200) {
                return $this->processWeatherData($data);
            } else {
                error_log("OpenWeatherMap API Error: " . ($data['message'] ?? 'Unknown error'));
                return null;
            }
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    /**
     * Process weather data to get current weather and daily forecast.
     *
     * @param array $data
     * @return array
     */
    protected function processWeatherData($data)
    {
        $currentWeather = [];
        $dailyForecast = [];

        // Get current weather (first item in the list)
        $firstItem = $data['list'][0];
        $currentWeather = [
            'city' => $data['city']['name'],
            'country' => $data['city']['country'],
            'temp' => $firstItem['main']['temp'],
            'feels_like' => $firstItem['main']['feels_like'],
            'description' => $firstItem['weather'][0]['description'],
            'icon' => $firstItem['weather'][0]['icon'],
            'humidity' => $firstItem['main']['humidity'],
            'wind_speed' => $firstItem['wind']['speed'],
            'wind_deg' => $firstItem['wind']['deg'], // Hướng gió
            'pressure' => $firstItem['main']['pressure'], // Áp suất
            'date' => date('l, d F', $firstItem['dt']), // Thứ, ngày tháng
            'min_temp' => $firstItem['main']['temp_min'], // Nhiệt độ thấp nhất hiện tại
            'max_temp' => $firstItem['main']['temp_max'], // Nhiệt độ cao nhất hiện tại
        ];

        // Get daily forecast (group by date)
        $startDate = date('Y-m-d'); // Ngày hiện tại
        $endDate = date('Y-m-d', strtotime('+6 days', strtotime($startDate))); // 6 ngày sau
        foreach ($data['list'] as $item) {
            $date = date('Y-m-d', $item['dt']);

            // Chỉ lấy dữ liệu trong khoảng thời gian cần thiết
            if ($date >= $startDate && $date <= $endDate) {
                if (!isset($dailyForecast[$date])) {
                    $dailyForecast[$date] = [
                        'date' => date('l', $item['dt']), // Lấy tên thứ
                        'temps' => [],
                        'icons' => [],
                    ];
                }

                $dailyForecast[$date]['temps'][] = $item['main']['temp'];
                $dailyForecast[$date]['icons'][] = $item['weather'][0]['icon'];
            }
        }

        // Calculate min/max temp and get most frequent icon for each day
        foreach ($dailyForecast as $date => &$forecast) {
            $forecast['min_temp'] = round(min($forecast['temps']));
            $forecast['max_temp'] = round(max($forecast['temps']));
            $forecast['icon'] = $this->getMostFrequentIcon($forecast['icons']);
            unset($forecast['temps']); // Remove unnecessary data
            unset($forecast['icons']);
        }

        return [
            'current' => $currentWeather,
            'forecast' => $dailyForecast, // Lấy toàn bộ dự báo trong khoảng thời gian
        ];
    }

    /**
     * Get most frequent icon from a list of icon codes.
     *
     * @param array $icons
     * @return string
     */
    protected function getMostFrequentIcon($icons)
    {
        $counts = array_count_values($icons);
        arsort($counts);
        return key($counts);
    }

    /**
     * Get wind direction in text format.
     *
     * @param float $degrees
     * @return string
     */
    public function getWindDirection($degrees)
    {
        $directions = ['N', 'NE', 'E', 'SE', 'S', 'SW', 'W', 'NW'];
        $index = round(($degrees % 360) / 45);
        return $directions[$index % 8];
    }
}