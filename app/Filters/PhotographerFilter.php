<?php


namespace App\Filters;


use Filter\Filter;

class PhotographerFilter extends Filter
{

    protected function filterName($name)
    {
        $this->query->where('name','like',"%$name%");
    }

    protected function filterPhone($phone)
    {
        $this->query->where('phone','like',"%$phone%");
    }

    protected function filterEmail($email)
    {
        $this->query->where('email','like', $email);
    }

    protected function filterGender($gender)
    {
        $this->query->where('gender', $gender);
    }

    protected function filterRate($rate)
    {
        $this->query->where('rate' , '>=', $rate);
    }

    protected function filterCity($city)
    {
        $this->query->where('city' , $city);
    }

    protected function filterService($service)
    {
        $this->query->whereHas('services', function($query) use($service){
            $query->where('service_id', $service);
        });
    }
}
