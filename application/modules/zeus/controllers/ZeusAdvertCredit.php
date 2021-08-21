<?php
/**
 * Created by PhpStorm.
 * User: kayode.oguntimehin
 * Date: 05/12/2017
 * Time: 11:16 PM
 */

namespace GoCart\Controller;


class ZeusAdvertCredit extends Zeus
{
    public function __construct()
    {
        parent::__construct();

        \CI::load()->model(array('AdvertCredit'));
        \CI::load()->helper('formatting_helper');
        \CI::lang()->load('advert_credit');

        _p('viewadvertcredit', true);
    }


}