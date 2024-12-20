<?php 
namespace Vendor\ExchangeRate\Plugin;
use Magento\Framework\Data\Tree\NodeFactory;

class Topmenu
{
    protected $nodeFactory;
    protected $_storeManager;
    protected $_pageFactory;
    protected $_urlBuilder;

    public function __construct(
        NodeFactory $nodeFactory,
        \Magento\Cms\Model\PageFactory $pageFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\UrlInterface $urlBuilder
    ) {
        $this->nodeFactory = $nodeFactory;
        $this->_pageFactory = $pageFactory;
        $this->_storeManager = $storeManager;
        $this->_urlBuilder = $urlBuilder;
    }

    public function beforeGetHtml(
        \Magento\Theme\Block\Html\Topmenu $subject,
        $outermostClass = '',
        $childrenWrapClass = '',
        $limit = 0
    ) {
        // Add Custom Menu

          $node = $this->nodeFactory->create(
            [
                'data' => [
                    'name' => __('Rate'),
                    'id' => 'tygia',
                    'url' => $this->_urlBuilder->getUrl(null, ['_direct' =>'tygia']),
                    'has_active' => false,
                     'is_active' => false
                     ],
                 'idField' => 'id',
                 'tree' => $subject->getMenu()->getTree()
            ]
        );
        $subject->getMenu()->addChild($node);
    }
}