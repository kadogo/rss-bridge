<?php

class QwerteeBridge extends BridgeAbstract
{
    const MAINTAINER = 'kadogo';
    const NAME = 'Qwertee Bridge';
    const URI = 'https://www.qwertee.com/';
    const CACHE_TIMEOUT = 86400; //24h
    const DESCRIPTION = 'Returns latest tee from Qwertee.';

    public function collectData()
    {
        $html = getSimpleHTMLDOM(self::URI);

        foreach ($html->find('.index-tee') as $element) {
            $item = [];
            $item['uri']      = $element->find('img')->src;
            $item['title']    = $element->find('.title > span')->innertext;
            $item['author']   = $element->find('.title > a')->innertext;
            $item['content']  = $element->find('img');
            $this->items[]    = $item;

            // Break if we have 3 elements because we doesn't want the last chance tees
            if (count($this->items) == 3) {
              break;
            }
        }
    }
}
