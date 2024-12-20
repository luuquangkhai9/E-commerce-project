<?php
namespace Vendor\ExchangeRate\Block;

use Magento\Framework\View\Element\Template;
use Vendor\ExchangeRate\Model\ExchangeRate as ExchangeRateModel;

class ExchangeRate extends Template
{
    /**
     * @var ExchangeRateModel
     */
    protected $exchangeRateModel;

    /**
     * ExchangeRate constructor.
     *
     * @param Template\Context $context
     * @param ExchangeRateModel $exchangeRateModel
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        ExchangeRateModel $exchangeRateModel,
        array $data = []
    ) {
        $this->exchangeRateModel = $exchangeRateModel;
        parent::__construct($context, $data);
    }

    /**
     * Get exchange rates.
     *
     * @return array|null
     */
    public function getRates()
    {
        return $this->exchangeRateModel->getExchangeRates();
    }
}