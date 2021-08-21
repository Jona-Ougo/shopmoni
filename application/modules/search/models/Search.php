<?php
/**
 * Search Class
 *
 * @package     GoCart
 * @subpackage  Models
 * @category    Search
 * @author      Clear Sky Designs
 * @link        http://gocartdv.com
 */

Class Search extends CI_Model
{

    function recordTerm($term, $category_id = '')
    {
        $code   = md5($term.$category_id);
        CI::db()->where(['code'=>$code]);
        $exists = CI::db()->count_all_results('search');
        if ($exists < 1){
            if(empty($category_id)){
                $data = ['code'=>$code, 'term'=>$term, 'created_at'=>date('Y-m-d H:i:s')];
              CI::db()->insert('search',$data);  
          }else{
            $data= ['code'=>$code, 'term'=>$term, 'category_id'=>$category_id, 'created_at'=>date('Y-m-d H:i:s')];
            CI::db()->insert('search', $data);
        }

    }
    return $code;
}

function getTerm($code = '')
{
    CI::db()->select('*');
    $result = CI::db()->get_where('search', array('code'=>$code));

    if($result->num_rows() < 1)
        return false;

    return $result->row();
}
}