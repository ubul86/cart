<?php
namespace common\helpers;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ResponseHelper
 *
 * @author ubul8
 */
class ResponseHelper {
    const RESPONSE_SUCCESS=1;
    const RESPONSE_ERROR=0;
    
    const MESSAGE_CART_SAVE_SUCCESSFULL = "Cart is successfully saved!";
    const MESSAGE_CART_EMPTY_CART = "Empty cart!";
    const MESSAGE_CART_ERROR_IN_SAVE = "Something went wrong";
    const MESSAGE_CART_UNSET_SUCCESS = "Cart is empty now!";
    const MESSAGE_CART_ITEM_NOT_FOUND = "Cart item is not found!";
    const MESSAGE_CART_DELETE_SUCCESSFULL = "Cart item is deleted";
    const MESSAGE_ITEM_NOT_FOUND = "Item is not found";
    
    protected $response=[
        "result" => 0,
        "message" => '',
    ];
    
    
    
    public function setResponse($result,$message){
        $this->response['result']=$result;
        $this->response['message']=$message;
        return $this;
    }
        
    public function output(){
        return $this->response;
    }
    
}
