<?php

namespace Car\model;

use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    protected $table = 'car_cart';
	protected $primaryKey = 'id';
}
