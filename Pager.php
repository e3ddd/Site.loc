<?php

class Pager
{
    public int $amountDataItems;
    public int $limit;
    private int $page;

    public function __construct($amountDataItems, $limit, $page)
    {
        $this->amountDataItems = $amountDataItems;
        $this->limit = $limit;
        $this->page = min($this->countPages() - 1, max($page, 0));
    }

    public function countPages()
    {
        return ceil($this->amountDataItems/$this->limit);
    }


    public function currentNum()
    {
        return $this->limit * $this->page;
    }

    public function limitNum()
    {
        return $this->currentNum() + $this->limit;
    }

    public function activeItem($num)
    {
        return $this->page == $num;
    }

    public function hasPrevPage()
    {
        return $this->page > 0;
    }

    public function hasNextPage()
    {
        return $this->countPages() > $this->page + 1;
    }

    public function getCurrentPage()
    {
        return $this->page;
    }

    public function generateURL(string $url, int $num)
    {
        $queryString = parse_url($url, PHP_URL_QUERY) ?: '';
        parse_str($queryString, $items);
        $items['num'] = $num;
        $newQuerystring = http_build_query($items);
        if (empty($queryString)) {
            return $url . '?' . $newQuerystring;
        }
        return preg_replace('@'.preg_quote($queryString).'$@', $newQuerystring, $url);
    }

    public function showPager($pagerTemplate, $pagerItemTemplate, $pagerItemTemplateActive, $requestURI, $queryString): string
    {
        $pages = [];
        if ($this->hasPrevPage()) {
            $pages[] = (new RenderPage($pagerItemTemplate))
                ->setContent('URL', $this->generateURL($requestURI, $queryString['num'] - 1))
                ->setContent('TITLE', 'Prev')
                ->render();
        }

        for ($i = 0; $i < $this->countPages(); $i++) {
            if ($this->activeItem($i)) {
                $pages[] = (new RenderPage($pagerItemTemplateActive))
                    ->setContent('URL',  $this->generateURL($requestURI, $i))
                    ->setContent('TITLE', $i + 1)
                    ->render();
            } else {
                $pages[] = (new RenderPage($pagerItemTemplate))
                    ->setContent('URL',  $this->generateURL($requestURI, $i))
                    ->setContent('TITLE', $i + 1)
                    ->render();
            }
        }

        if ($this->hasNextPage()) {
            $pages[] = (new RenderPage($pagerItemTemplate))
                ->setContent('URL',  $this->generateURL($requestURI,$queryString['num'] + 1))
                ->setContent('TITLE', 'Next')
                ->render();
        }


        $pages = (new RenderPage($pagerTemplate))
            ->setContent(
                'items',
                implode('', $pages)
            );

        return $pages->render();
    }
}