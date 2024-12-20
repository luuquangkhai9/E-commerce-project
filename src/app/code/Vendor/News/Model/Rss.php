<?php
namespace Vendor\News\Model;

class Rss
{
    const RSS_URL = 'https://vnexpress.net/rss/kinh-doanh.rss';

    /**
     * Get news from VnExpress RSS feed.
     *
     * @return array|null
     */
    public function getNews()
    {
        try {
            $xmlString = file_get_contents(self::RSS_URL);
            $xml = simplexml_load_string($xmlString, "SimpleXMLElement", LIBXML_NOCDATA);
            $json = json_encode($xml);
            $array = json_decode($json, true);

            if (isset($array['channel']['item'])) {
                $news = [];
                foreach ($array['channel']['item'] as $item) {
                    $news[] = [
                        'title' => $item['title'],
                        'link' => $item['link'],
                        'description' => $item['description'],
                        'pubDate' => $item['pubDate'],
                    ];
                }
                return $news;
            }
        } catch (\Exception $e) {
            // Log error for debugging
            error_log($e->getMessage());
            return null;
        }
        return null;
    }
}