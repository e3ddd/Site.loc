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
        $this->page = $page;
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
        $queryString = parse_url($url, PHP_URL_QUERY);
        parse_str($queryString, $items);
        $items['num'] = $num;
        $newQuerystring = http_build_query($items);
        if (empty($queryString)) {
            return $url . '&' . $newQuerystring;
        }
        return str_replace('&'.$queryString, '&' . $newQuerystring, $url);
    }
}