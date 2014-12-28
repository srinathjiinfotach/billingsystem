<?php
/**
 * Created by PhpStorm.
 * User: CarlosRenato
 * Date: 26/12/2014
 * Time: 11:10 PM
 */
namespace Administrator;
class ProductCategory extends \ModelBase
{
    protected $table = 'product_category';

    public function products(){
        return $this->hasMany('Administrator\Product', 'category_id');
    }


}