<?php


namespace App\Filters;

use Carbon\Carbon;
use Filter\Filter;

class OrderFilter extends Filter
{

    protected function filterType($type)
    {
        $this->query->where('type', $type);
    }

    protected function filterStatus($status)
    {
        $this->query->where('status', $status);
    }

    protected function filterDate($period)
    {
        match($period){
            'today' => $this->query->whereDate('date', today()),
            'this_week' => $this->query->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]),
            'this_month' => $this->query->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]),
            'all_time' => $this->query
        };
    }

    protected function filterUpcoming($value)
    {
        if($value && !in_array($value, [0, '0'])){
            $this->query->upcoming();
        }
    }

    protected function filterLatest($value)
    {
        if($value && !in_array($value, [0, '0'])){
            $this->query->latest();
        }
    }
}
