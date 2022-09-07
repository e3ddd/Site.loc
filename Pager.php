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

    public function hasPrevPage($num)
    {
        if($num < $this->countPages()-($this->countPages()-1)){
            return true;
        }
        return false;
    }

    public function hasNextPage($num)
    {
        if($num < $this->countPages() - 1){
            return true;
        }
        return false;
    }
}