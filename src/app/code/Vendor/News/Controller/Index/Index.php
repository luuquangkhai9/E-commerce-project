<?php
namespace Vendor\News\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\UrlRewrite\Model\UrlRewriteFactory;
use Magento\UrlRewrite\Model\ResourceModel\UrlRewriteCollectionFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    protected $urlRewriteFactory;
    protected $urlRewriteCollectionFactory;

    public function __construct(
        Context $context, 
        PageFactory $resultPageFactory,
        UrlRewriteFactory $urlRewriteFactory,
        UrlRewriteCollectionFactory $urlRewriteCollectionFactory)
    {
        $this->urlRewriteFactory = $urlRewriteFactory;
        $this->urlRewriteCollectionFactory = $urlRewriteCollectionFactory;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {   
        $categoryId = 9; // Category ID you want to change
        $newTargetPath = 'tintuc/index/index';
        
        try {
            // Get the existing URL rewrite
            $collection = $this->urlRewriteCollectionFactory->create()
                ->addFieldToFilter('target_path', 'catalog/category/view/id/' . $categoryId);

            if ($collection->getSize()) {
                foreach ($collection as $urlRewrite) {
                    $urlRewrite->setTargetPath($newTargetPath); // Update the target path
                    $urlRewrite->save();
                }
                $this->messageManager->addSuccessMessage(__('URL Rewrite updated successfully.'));
            } else {
                $this->messageManager->addErrorMessage(__('No URL Rewrite found for the specified target path.'));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Error: %1', $e->getMessage()));
        }

        return $this->resultPageFactory->create();
    }
}