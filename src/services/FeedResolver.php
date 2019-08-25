<?php declare(strict_types=1);
namespace DanielZielkaRekrutacjaHRtec\services;

use DanielZielkaRekrutacjaHRtec\models\Feed as FeedModel;
use Feed;

class FeedResolver
{
    public function getData(string $url): array
    {
        $rss = Feed::loadRss($url);

        $retrun = [];
        foreach ($rss->item as $item) {
            $feed = (new FeedModel())
                ->setTitle((string) $item->title)
                ->setDescription((string) $item->description)
                ->setLink((string) $item->link)
                ->setPubDate((string) $item->pubDate)
                ->setCreator((string) $item->creator);

            $return[] = $feed;
        }

        return $return;
    }
}
