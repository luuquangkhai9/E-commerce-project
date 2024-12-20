<?php
namespace Vendor\Weather\Block;

use Magento\Framework\View\Element\Template;
use Vendor\Weather\Model\Weather as WeatherModel;

class Weather extends Template
{
    /**
     * @var WeatherModel
     */
    protected $weatherModel;

    /**
     * Weather constructor.
     *
     * @param Template\Context $context
     * @param WeatherModel $weatherModel
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        WeatherModel $weatherModel,
        array $data = []
    ) {
        $this->weatherModel = $weatherModel;
        parent::__construct($context, $data);
    }

    /**
     * Get weather data.
     *
     * @return array|null
     */
    public function getWeatherData()
    {
        return $this->weatherModel->getWeatherData();
    }

    /**
     * Get weather icon URL.
     *
     * @param string $iconCode
     * @param bool $large
     * @return string
     */
    public function getWeatherIconUrl($iconCode, $large = false)
    {
        $size = $large ? "@4x.png" : "@2x.png";
        return "https://openweathermap.org/img/wn/{$iconCode}{$size}";
    }
}