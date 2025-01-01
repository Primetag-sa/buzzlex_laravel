<?php


namespace App\Filters;


use Filter\Filter;

class SettingFilter extends Filter
{
    protected function filterName($name)
    {
        $this->query->where('name','like',"%$name%");
    }

    protected function filterType($type)
    {
        $this->query->where('type', $type);
    }
}
