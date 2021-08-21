<?php

//fuly decode a particular string
function full_decode($string)
{
	return html_entity_decode($string, ENT_QUOTES);
}

//decode anything we throw at it
function form_decode(&$x)
{
	//loop through objects or arrays
	if(is_array($x) || is_object($x))
	{
		foreach($x as &$y)
		{
			$y = form_decode($y);
		}
	}
	
	if(is_string($x))
	{
		$x	= full_decode($x);
	}
	
	return $x;
}

function my_character_limiter($str, $n = 500, $end_char = '&#8230;')
{
	$output = substr($str, 0, $n);
	if(strlen($str)>$n){
		$output.=$end_char;
	}

	return $output;
}


//used by the gift_card feature
function generate_code($length=16)
{
	$vowels = '0123';
	$consonants = '456789ABCDEF';

	$password = '';
	$alt = time() % 2;
	for ($i = 0; $i < $length; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt = 0;
		} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
		}
	}
	return $password;
}

function _p($permission = '', $redirect = false)
{
	$permission 	= strtolower($permission);
	$permissions 	= json_decode(\CI::session()->userdata('zeusPermissions'), true);
	$permissions 	= $permissions == null ? [] : $permissions;
	
	if(in_array($permission, @$permissions)){
		return true;
	}else{
		if($redirect){
			redirect('zeus/logout');
		}else{
			return false;
		}
	}
}

function get_sku($product_name){
	$first_word = explode(' ',$product_name)[0];
	\CI::load()->helper('string');
	$sku = strtoupper($first_word).'-'.random_string('numeric', 4).'-'.date('md');

	if(\DB\DB::itExists('products', 'sku', $sku))
		get_sku($product_name);

		return $sku;
	}

	function sensor($string)
	{
		$string = str_split($string);
		for($i = 0; $i<=3; $i++){
			$string[$i] = '*';
		}
		return implode('', $string);
	}

//Create Notification User
	function _n($customer_id = 0, $notification = '', $type = '', $link = '')
	{
		if($customer_id != 0){
			\DB\DB::save('notifications', ['customer_id'=>$customer_id, 'notification'=>$notification, 'type'=>$type, 'link'=>$link, 'created_at'=>date('Y-m-d H:i:s')]);
		}
		return;
	}

	function dateAgo($date = ''){
		$today = date("Y-m-d H:i:s");
		$db_date = new DateTime($date);
		$current_day = new DateTime($today);
		$difference = $db_date->diff($current_day);
		if($difference->days == 0){
			return 'Today';
		}elseif($difference->days == 1) {
			return 'Yesterday';
		}else{
			return $difference->days.' days ago';
		}
	}

	function d($dateString = '')
	{
		return date('M d, Y g:i A', strtotime($dateString));
	}

	function _pagelink($page_id = 0){
		$page = \DB\DB::getRow('pages', ['id'=>$page_id]);
		if(!$page);
		return '';
		if($page->new_window){
			return '<a href="'.site_url('page/'.$row->slug).'">'.$row->title.'</a>';
		}
	}

	function categories_children($categoryId = 0)
	{
		$allCategories = \DB\DB::getFew('categories', ['id', 'parent_id']);
		$subCategories = [];
		$firstLevelChildren = array_filter($allCategories, function($object) use (&$categoryId){

			return ($object->parent_id == $categoryId);

		});
	}

	function cat_list($id = 0, $categories = [])
	{
	
		$depth2 = $depth3 = $depth4 = $depth5 = [];

		$sub = array_filter($categories, function($object) use($id){

			return ($object->parent_id == $id);
		});

		foreach($sub as $row){

			$id = $row->id;

			$sub2 = array_filter($categories, function($object) use($id){

				return ($object->parent_id == $id);
			});

			$depth2[] = $sub2;
		}

		return $depth2;
	}