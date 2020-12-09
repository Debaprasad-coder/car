<?php

namespace Car;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'car_model';
	protected $primaryKey = 'id';
}
