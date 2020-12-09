<?php

namespace Car\model;
use DB;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    

	public static function getOrder($uid="")
	{
		
		$sql = "
		SELECT `cart`.`id` AS `id`,`carModel`.`car_brand` AS `carBrand`,
			`carModel`.`car_name` AS `carName`,`cart`.`car_unit_price` AS `unitPrice`,
			`cart`.`car_qty` 
			AS `qty`,
			(`cart`.`car_qty` * `cart`.`car_unit_price` )AS `totalPrice`,
			`carModel`.`car_image` AS `carImg`,
			CONCAT(
				DATE_FORMAT(
					ADDTIME(
						`cart`.`created_at`,'5:30'
					),'%D-%b-%Y,%a,%h:%i:%s %p'
				),'[GMT+5:30 HRS.]'
			) AS `oredrAt`,
			`cart`.`status` AS `status`
		FROM `car_cart` as `cart`
		LEFT JOIN `car_model` AS `carModel` ON `cart`.`car_id` = `carModel`.`id`";
		if($uid !=""){
			$sql .=" WHERE `cart`.`user_id` = ".$uid."";
		}		
		$sql .=" order by `cart`.`id` DESC";
		//echo $sql;exit;
		DB::enableQueryLog();
		$result = DB::select($sql);
		return $result = DB::select($sql);
		/*
		$query = DB::getQueryLog();		
		$lastQuery = end($query);
		echo "<pre>";
		print_r($lastQuery);		
		exit;
		*/
	}
}
