<?php
namespace Uet\MomoWallet\Controller\Payment\Start;

/**
 * Interceptor class for @see \Uet\MomoWallet\Controller\Payment\Start
 */
class Interceptor extends \Uet\MomoWallet\Controller\Payment\Start implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Payment\Gateway\Command\CommandPoolInterface $commandPool, \Psr\Log\LoggerInterface $logger, \Magento\Sales\Api\OrderRepositoryInterface $orderRepository, \Magento\Payment\Gateway\Data\PaymentDataObjectFactory $paymentDataObjectFactory, \Magento\Checkout\Model\Session $checkoutSession, ?\Magento\Sales\Api\PaymentFailuresInterface $paymentFailures = null)
    {
        $this->___init();
        parent::__construct($context, $commandPool, $logger, $orderRepository, $paymentDataObjectFactory, $checkoutSession, $paymentFailures);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute();
    }
}
