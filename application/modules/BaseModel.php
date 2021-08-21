<?php
/**
 * Created by PhpStorm.
 * User: kayode.oguntimehin
 * Date: 10/12/2017
 * Time: 10:15 PM
 */

Class BaseModel extends CI_Model {

    public function getTableValueByField($table, $field, $value)
    {
        return CI::db()->where($field, $value)->get($table)->row();
    }

}