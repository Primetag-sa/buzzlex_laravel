<?php


namespace App\Filters;


use Filter\Filter;

class ReviewFilter extends Filter
{

    protected function filterUser($user)
    {
        $this->query->whereHas('user', function($query) use($user){
            $query->where('user_id', $user->id);
        });
    }

    protected function filterPhotographer($photographer)
    {
        $this->query->whereHas('photographer', function($query) use($photographer){
            $query->where('photographer_id', $photographer->id);
        });
    }

    protected function filterRate($rate)
    {
        $this->query->where('rate', '>=', $rate);
    }
}
