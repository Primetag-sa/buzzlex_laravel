<?php


namespace App\Filters;


use Filter\Filter;

class UserFilter extends Filter
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

    protected function filterJoinDate($date)
    {
        $this->query->whereDate('created_at', $date);
    }

}
