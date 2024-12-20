<?php
namespace Vendor\News\Block;

use Magento\Framework\View\Element\Template;
use Vendor\News\Model\Rss;

class News extends Template
{
    /**
     * @var Rss
     */
    protected $rss;

    /**
     * News constructor.
     *
     * @param Template\Context $context
     * @param Rss $rss
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Rss $rss,
        array $data = []
    ) {
        $this->rss = $rss;
        parent::__construct($context, $data);
    }

    /**
     * Get news.
     *
     * @return array|null
     */
    public function getNews()
    {
        return $this->rss->getNews();
    }
}