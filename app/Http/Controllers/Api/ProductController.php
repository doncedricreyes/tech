<?php
namespace App\Http\Controllers\Api;
use App\Brand;

use App\Http\Controllers\Controller;

/**
 * Product Api Controller
 * 
 * @author zildjian <gtrmergillazildjianl@gmail.com>
 * @since 2020.01.01
 */
class ProductController extends BaseApiController {

    /**
     * Get all the products
     * 
     * @param int $brandId   brand id of the products to get
     * 
     * @Todo return products with the specified brandId
     */
    public function getProducts($brandId) {
        $aProducts = array();
        return response(json_encode($aProducts), 200, $this->aHeaders);
    }

    /**
     * Get all product brands
     * @Todo return all brands
     */
    public function getBrands() {
        $aBrands = Brand::get();
        return response(json_encode($aBrands), 200, $this->aHeaders);
    }
}