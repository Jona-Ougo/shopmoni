<?php

include('content_filter.php');

function productPrimaryImage($product = object, $size = 'medium')
{
    $image = base_url('uploads/images/'.$size.'/no_picture.png');
    if(!empty($product->images)){
        foreach($product->images as $photo){
            if(isset($photo['primary'])){
                $primary = $photo;
                break;
            }else{
                $primary = $photo;
            }
        }
        $image = base_url('uploads/images/'.$size.'/'.$primary['filename']);
    }
    return $image;
}

function productPrice($product = object)
{
    if(!isset($product->saleprice) && !isset($product->price))
        return 0;
    return format_currency($product->saleprice > 0 ? $product->saleprice : $product->price);
}

function productSaleStatus($product = object)
{
    $text = $class = '';
    if((bool)$product->track_stock && $product->quantity < 1 && config_item('inventory_enabled')){
        $text = lang('out_of_stock');
        $class = 'new';
    }elseif(@$product->saleprice > 0){
        $text = lang('on_sale');
        $class = 'sale';
    }
    return "<div class='product-status'><span class='{$class}'>{$text}</span></div>";
}


function subcategory_loop_($subcat = [])
{
    if(count($subcat) < 1)
        return '';

    $temp = [];
    foreach($subcat as $row){
        $query = \CI::db()->where('parent_id', $row['id']);
        $query = \CI::db()->order_by('sequence', 'DESC');
        $query = \CI::db()->get('categories');
        $children = $query->result_array();
        if(count($children) > 0){
            $temp = array_merge_recursive($children, $temp);
        }
    }

    $subcat = array_merge_recursive($subcat, $temp);
    if(count($subcat) > 32)
        $slice = 10;
    else
        $slice = 8;

    $chunks = array_chunk($subcat, $slice);
    echo "<ul class='dropdown-menu mega_dropdown' role='menu' style='font-size:12px !important; padding:0 !important'>";

    foreach($chunks as $key=>$value){
        echo "<li class='block-container col-sm-3'><ul class='block-megamenu-link' style='padding:0 !important;'>";

        foreach($value as $row){
            $url = site_url('category/'.$row['slug']);
            echo "<li class='link_container'><a href='{$url}'>{$row['name']}</a></li>";
        }

        echo "</ul></li>";
    }
    echo "</ul>";
}

function subcategory_loop($subcat = [])
{
    if(count($subcat) < 1)
        return '';

    $temp = [];
    foreach($subcat as $row){
        $query = \CI::db()->where('parent_id', $row['id']);
        $query = \CI::db()->order_by('sequence', 'DESC');
        $query = \CI::db()->get('categories');
        $children = $query->result_array();
        if(count($children) > 0){
            $temp = array_merge_recursive($children, $temp);
        }
    }

    $subcat = array_merge_recursive($subcat, $temp);
    if(count($subcat) > 32)
        $slice = 10;
    else
        $slice = 8;

    $chunks = array_chunk($subcat, $slice);
    echo "<div class='row'>";

    foreach($chunks as $key=>$value){
        echo "<div class='col-sm-3'><ul>";

        foreach($value as $row){
            $url = site_url('category/'.$row['slug']);
            echo "<li class='link_container'><a href='{$url}'>{$row['name']}</a></li>";
        }

        echo "</ul></div>";
    }
    echo "</div>";
}


function page_loop($parent = 0, $ulattribs=false, $ul=true)
{
    $pages = CI::Pages()->get_pages_tiered();

    $items = false;
    if(isset($pages[$parent]))
    {
        $items = $pages[$parent];
    }

    if($items)
    {
        echo ($ul)?'<ul '.$ulattribs.'>':'';
        foreach($items as $item)
        {
            echo '<li class="menu-item">';
            $chevron = ' <i class="icon-chevron-down dropdown"></i>';
            
            if($item->slug == '')
            {
                //add the chevron if this has a drop menu
                $name = $item->title;
                if(isset($pages[$item->id]))
                {
                    $name .= $chevron;
                }

                $target = ($item->new_window)?' target="_blank"':'';
                $anchor = '<a href="'.$item->url.'"'.$target.'>'.$name.'</a>';
            }
            else
            {
                //add the chevron if this has a drop menu
                $name = $item->menu_title;
                if(isset($pages[$item->id]))
                {
                    $name .= $chevron;
                }
                $selected = (CI::uri()->segment(2) == $item->slug)?'class="selected"':'';
                $anchor = anchor('page/'.$item->slug, $name, $selected);
            }

            echo $anchor;
            page_loop($item->id);
            echo '</li>';
        }
        echo ($ul)?'</ul>':'';
    }
}


function page_partial($partial = '', $vars = [])
{
    $page = new \GoCart\Controller\Front;
    return $page->partial($partial, $vars);
}

function run_shortcode($shortcodeContent = '')
{
    echo (new content_filter($shortcodeContent))->display();
}

function productOptionsHtml($options = [], $posted_options = [])
{   
   if(count($options) < 1)
    return;

$html = '';
foreach($options as $option){
    if($option->required){
        $required = ' class="required" ';
    }

    if($option->type == 'checklist'){
        $value = '';
        if($posted_options && isset($posted_options[$option->id])){
            $value = $posted_options[$option->id];
        }
    }else{
        if(isset($option->values[0])){
            $value = $option->values[0]->value;
            if($posted_options && isset($posted_options[$option->id])){
                $value = $posted_options[$option->id];
            }
        }else{
            $value = '';
        }
    }
    $html   = "<tr>";
    $td     = $td2 = '';
    $name   = 'option['.$option->id.']';

    switch($option->type){
        case 'textfield':
        $td = "<input type='text' name='{$name}' value='{$value}' >";
        break;

        case 'textarea':
        $td = "<textarea name='{$name}' >{$value}</textarea>";
        break;

        case 'droplist':
        $choose_option = lang('choose_option');
        $td = "<select name='{$name}' ><option value=''>{$choose_option}</option>";
        foreach($option->values as $values){
            $selected   = '';
            $text   = '(+'.format_currency($values->price).')';
            $td2    = $values->name;
            if($value == $values->id)
                $selected = 'selected';
            $td.="<option {$selected} value='{$values->id}'>{$text}</option>";
        }
        $td.="</select>";
        echo $td;
        break;

        case 'radiolist':
        $checked = '';
        foreach($option->values as $values){
            if($value == $values->id)
                $checked = 'checked';
            $text   = '(+'.format_currency($values->price).')';
            $td2    = $values->name;
            $td .= "<input {$checked} type='radio' name='{$name}' value='{$values->id}'> {$text}";
        }
        break;

        case 'checklist':
        $checked = '';
        foreach($option->values as $values){
            if($value == $values->id)
                $checked = 'checked';
            $text   = '(+'.format_currency($values->price).')';
            $td2    = $values->name;
            $td .= "<input {$checked} type='checkbox' name='{$name}' value='{$values->id}'> {$text}";
        } 
        break;

    }

    $html.="<td class='table-label'>{$td2}</td><td class='table-value'>{$td}</td></tr>";
}
return $html;
}

function getCategoryMarketPlace($slug = '')
{
    $category = \DB\DB::getRow('categories', ['slug'=>$slug]);
    if(!$category)
        return false;

    if($category->is_marketplace == 1)
        return $category->slug;

    $parent = \DB\DB::getRow('categories', ['id'=>$category->parent_id]);

    if($parent->is_marketplace == 1)
        return $parent->slug;
    else
        getCategoryMarketPlace($parent->slug);
}

function dd($var = '')
{
  echo '<pre>';
  var_dump($var);
  echo '</pre>';
}
