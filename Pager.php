<?php

class Pager
{
    private int $amountDataItems;
    public int $limit;

    public function __construct($amountDataItems, $limit)
    {
        $this->amountDataItems = $amountDataItems;
        $this->limit = $limit;
    }

    public function countPages()
    {
        return ceil($this->amountDataItems/$this->limit);
    }

    public function currentNum($page)
    {
        return $this->limit * $page;
    }

    public function hasPrevPage()
    {

    }

    public function hasNextPage()
    {

    }
}