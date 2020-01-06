<?php
namespace App\Http\Controllers\Api;

use \App\Http\Controllers\Controller;

/**
 * Customer Controller for Api
 * 
 * @author zildjian <gtrmergillazildjianl@gmail.com>
 * @since 2019.12.31
 */
class CustomerController extends BaseApiController {

    

    /**
     * Default response
     */
    public function index() {
        return response('this is working');
    }

}