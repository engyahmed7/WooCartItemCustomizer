<?php

class Custom_Package_Plugin
{

    private $admin;
    private $frontend;
    private $cart;

    public function __construct()
    {
        $this->admin = new Custom_Package_Admin();
        $this->frontend = new Custom_Package_Frontend();
        $this->cart = new Custom_Package_Cart();
    }


    public function run()
    {
        $this->admin->init();
        $this->frontend->init();
        $this->cart->init();
    }
}
