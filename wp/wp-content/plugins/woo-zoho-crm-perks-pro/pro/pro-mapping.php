<?php
if( !defined( 'ABSPATH' ) ) exit;
$users=$this->post('users',$meta);
$layouts=$this->post('layouts_'.$module,$meta);
if($type == ''){
    $panel_count++;
?>
<div class="vx_div vx_refresh_panel ">    
      <div class="vx_head ">
<div class="crm_head_div"> <?php echo sprintf(__('%s. Object Owner',  'woo-zoho' ),$panel_count); ?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php _e('Expand / Collapse','woo-zoho') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>                 
    <div class="vx_group ">
   <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="crm_owner"><?php _e("Assign Owner", 'woo-zoho'); $this->tooltip($tooltips['vx_owner_check']);?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="crm_owner" class="crm_toggle_check <?php if(empty($users)){echo 'vx_refresh_btn';} ?>" name="meta[owner]" value="1" <?php echo !empty($feed["owner"]) ? "checked='checked'" : ""?> autocomplete="off"/>
    <label for="owner"><?php _e("Enable", 'woo-zoho'); ?></label>
  </div>
<div class="clear"></div>
</div>
    <div id="crm_owner_div" style="<?php echo empty($feed["owner"]) ? "display:none" : ""?>">
  <div class="vx_row">
  <div class="vx_col1">
  <label><?php _e('Users List','woo-zoho'); $this->tooltip($tooltips['vx_owners']); ?></label>
  </div>
  <div class="vx_col2">
  <button class="button vx_refresh_data" data-id="refresh_users" type="button" autocomplete="off" style="vertical-align: baseline;">
  <span class="reg_ok"><i class="fa fa-refresh"></i> <?php _e('Refresh Data','woo-zoho') ?></span>
  <span class="reg_proc"><i class="fa fa-refresh fa-spin"></i> <?php _e('Refreshing...','woo-zoho') ?></span>
  </button>
  </div> 
   <div class="clear"></div>
  </div> 

  <div class="vx_row">
   <div class="vx_col1">
  <label for="crm_sel_user"><?php _e('Select User','woo-zoho'); $this->tooltip($tooltips['vx_sel_owner']); ?></label>
</div> 
<div class="vx_col2">

  <select id="crm_sel_user" name="meta[user]" style="width: 100%;" autocomplete="off">
  <?php echo $this->gen_select($users,$feed['user'],__('Select User','woo-zoho')); ?>
  </select>

   </div>

   <div class="clear"></div>
   </div>
 
    <div class="vx_row">
   <div class="vx_col1">
  <label for="crm_sel_rule"><?php _e('Assignment Rule ','woo-zoho');   ?></label>
</div> 
<div class="vx_col2">
<input type="text" id="crm_sel_rule" name="meta[assign_rule]" style="width: 100%;" value="<?php if(!empty($feed['assign_rule'])){ echo $feed['assign_rule']; }; ?>" class="vx_input_100" autocomplete="off" placeholder="<?php _e('Assignment Rule ID','woo-zoho');   ?>" />
<div class="howto"><?php _e('Enter Assignment Rule ID to trigger rule in Zoho.','woo-zoho');   ?></div>

   </div>

   <div class="clear"></div>
   </div>
   
  
  </div>
  
  
 
   

  </div>
  </div>
<?php

    $panel_count++;
?>
<div class="vx_div vx_refresh_panel">    
      <div class="vx_head ">
<div class="crm_head_div"> <?php echo sprintf(__('%s. Object Layout',  'woocmmerce-zoho-crm' ),$panel_count++); ?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php _e('Expand / Collapse','woocmmerce-zoho-crm') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>                 
    <div class="vx_group ">
   <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="crm_layout"><?php _e("Assign Layout ", 'woocmmerce-zoho-crm'); ?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="crm_layout" class="crm_toggle_check <?php if(empty($layouts)){echo 'vx_refresh_btn';} ?>" name="meta[add_layout]" value="1" <?php echo !empty($feed["add_layout"]) ? "checked='checked'" : ""?> autocomplete="off"/>
    <label for="layout"><?php _e("Enable", 'woocmmerce-zoho-crm'); ?></label>
  </div>
<div class="clear"></div>
</div>
    <div id="crm_layout_div" style="<?php echo empty($feed["add_layout"]) ? "display:none" : ""?>">
  <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_sel_layout"><?php _e('Layouts ','woocmmerce-zoho-crm'); ?></label>
  </div>
  <div class="vx_col2">
  <button class="button vx_refresh_data" data-id="refresh_layouts" type="button" autocomplete="off" style="vertical-align: baseline;">
  <span class="reg_ok"><i class="fa fa-refresh"></i> <?php _e('Refresh Data','woocmmerce-zoho-crm') ?></span>
  <span class="reg_proc"><i class="fa fa-refresh fa-spin"></i> <?php _e('Refreshing...','woocmmerce-zoho-crm') ?></span>
  </button>
  </div> 
   <div class="clear"></div>
  </div> 

  <div class="vx_row">
   <div class="vx_col1">
  <label for="crm_sel_layout"><?php _e('Select Layout ','woocmmerce-zoho-crm'); ?></label>
</div> 
<div class="vx_col2">

  <select id="crm_sel_layout" name="meta[layout]" style="width: 100%;" class="vx_input_100" autocomplete="off">
  <?php echo $this->gen_select($layouts,$feed['layout'],__('Select Layout','woocmmerce-zoho-crm')); ?>
  </select>

   </div>

   <div class="clear"></div>
   </div>
 
  
  </div>
  

  </div>
  </div>
<?php             
} 
$tax_codes_list=array();
if(isset($fields['tax_id']['options'])){
 foreach($fields['tax_id']['options'] as $v){
$tax_codes_list[$v['value']]=$v['label'];   
 }
}else if(!empty($meta['tax_codes'])){
$tax_codes_list=$this->post('tax_codes',$meta); 
}
// $tax_codes=array('map'=>__('According to map in WooCommerce Zoho account Settings',  'woo-zoho' ));
if(is_array($tax_codes_list)){
 //  $tax_codes=$tax_codes+$tax_codes_list;
$tax_codes_list['map']=__('According to map in WooCommerce Zoho account Settings',  'woo-zoho' ); 
}
  $books_ops=array('dis'=>__('Product Price and Discount','woo-zoho'),'cost'=>__('Item Cost without Coupon Discount','woo-zoho'),'cost_tax'=>__('Item Cost + Item Tax','woo-zoho'));
if( empty($type) &&  !in_array($module,array('Activities','Campaigns','Solutions','Events','Notes'))  && vxc_zoho::$is_pr){ // in_array($module,array('Sales_Orders','Purchase_Orders','Contacts','Accounts','Leads','Deals','Invoices'))
                  $panel_count++;
                  $books=$this->post('price_books',$meta);
           
               ?>
                  <!-------------------------- lead products -------------------->
     <div class="vx_div vx_refresh_panel ">    
      <div class="vx_head ">
<div class="crm_head_div"> <?php echo sprintf(__('%s. Add Products',  'woo-zoho' ),$panel_count); ?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php _e('Expand / Collapse','woo-zoho') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>    
            
    <div class="vx_group ">
 
   <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="order_items"><?php _e("Line Items", 'woo-zoho'); $this->tooltip($tooltips['vx_line_items']);?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="crm_items" class="crm_toggle_check <?php if(empty($books) ){echo 'vx_refresh_btn';} ?>" name="meta[order_items]" value="1" <?php echo !empty($feed["order_items"]) ? "checked='checked'" : ""?> autocomplete="off"/>
    <label for="crm_items"><?php _e("Create an order product for each line item", 'woo-zoho'); ?></label>
  </div>
<div class="clear"></div>
</div>
    <div id="crm_items_div" style="<?php echo empty($feed["order_items"]) ? "display:none" : ""?>">
  <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_sel_book"><?php _e('Price Books','woo-zoho'); $this->tooltip($tooltips['vx_price_books']); ?></label>
  </div>
  <div class="vx_col2">
  <button class="button vx_refresh_data" data-id="refresh_books" type="button" autocomplete="off" style="vertical-align: baseline;">
  <span class="reg_ok"><i class="fa fa-refresh"></i> <?php _e('Refresh Data','woo-zoho') ?></span>
  <span class="reg_proc"><i class="fa fa-refresh fa-spin"></i> <?php _e('Refreshing...','woo-zoho') ?></span>
  </button>
  </div> 
   <div class="clear"></div>
  </div> 

  <div class="vx_row">
   <div class="vx_col1">
  <label for="crm_sel_book"><?php _e('Select Price Book (Optional)','woo-zoho'); $this->tooltip($tooltips['vx_sel_price_book']); ?></label>
</div> 
<div class="vx_col2">

  <select id="crm_sel_book" name="meta[price_book]" style="width: 100%;" autocomplete="off">
  <?php echo $this->gen_select($books,$feed['price_book'],__('Select Price Book','woo-zoho')); ?>
  </select>

   </div>

   <div class="clear"></div>
   </div>

     <div class="vx_row">
   <div class="vx_col1">
  <label for="crm_sel_price"><?php _e('Product Price','woo-zoho'); ?></label>
</div> 
<div class="vx_col2">

  <select id="crm_sel_price" name="meta[item_price]" style="width: 100%;" autocomplete="off">
  <?php
   echo $this->gen_select($books_ops,$feed['item_price'],__('Item Cost','woo-zoho')); ?>
  </select>

   </div>

   <div class="clear"></div>
   </div>
  
       <div class="vx_row">
   <div class="vx_col1">
  <label for="crm_sel_price_custom"><?php _e('Custom Item field for Price (Optional)','woo-zoho'); ?></label>
</div> 
<div class="vx_col2">
  <input type="text" id="crm_sel_price_custom" name="meta[item_price_custom]" value="<?php echo $this->post('item_price_custom',$feed); ?>"  style="width: 100%;" autocomplete="off">
  <div class="howto"><?php echo __('Enter line item field name for getting item price , Leave it empty for getting default price.','woo-zoho'); ?></div>
  <?php ?>
   </div>

   <div class="clear"></div>
   </div>
  
  </div>

  </div>
  </div>
  <?php
}
  
 if(in_array($module,array('invoices','estimates','recurringinvoices','creditnotes','purchaseorders','salesorders')) && vxc_zoho::$is_pr){
 $panel_count++;
 $product_types=array('goods'=>'Goods','service'=>'Services');
 ?>
                  <!-------------------------- lead products -------------------->
     <div class="vx_div vx_refresh_panel ">    
      <div class="vx_head ">
<div class="crm_head_div"> <?php echo sprintf(__('%s. Add Products',  'woo-zoho' ),$panel_count); ?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php _e('Expand / Collapse','woo-zoho') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>    
            
    <div class="vx_group ">
 
   <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="order_items"><?php _e("Line Items", 'woo-zoho'); $this->tooltip($tooltips['vx_line_items']);?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="crm_items" class="crm_toggle_check" name="meta[order_items]" value="1" <?php echo !empty($feed["order_items"]) ? "checked='checked'" : ""?> autocomplete="off"/>
    <label for="crm_items"><?php _e("Create a Zoho line item for each Woocommerce line item", 'woo-zoho'); ?></label>
  </div>
<div class="clear"></div>
</div>
    <div id="crm_items_div" style="<?php echo empty($feed["order_items"]) ? "display:none" : ""?>"> 

  <div class="vx_row">
   <div class="vx_col1">
  <label for="crm_sel_book"><?php _e('Product Type','woo-zoho'); $this->tooltip($tooltips['vx_sel_price_book']); ?></label>
</div> 
<div class="vx_col2">

  <select id="crm_sel_book" name="meta[product_type]" style="width: 100%;" autocomplete="off">
  <?php echo $this->gen_select($product_types,$feed['product_type'],__('Select Product Type','woo-zoho')); ?>
  </select>

   </div>

   <div class="clear"></div>
   </div>

<?php
 
if(!empty($meta['warehouses'])){
$wares=$this->post('warehouses',$meta); 
}else{
    $info['meta']=$meta;
$wares=$this->get_warehouses($info);
} 
?>
   <div class="vx_row">
   <div class="vx_col1">
  <label for="crm_sel_tax"><?php _e('Tax ID','woo-zoho'); ?></label>
</div> 
<div class="vx_col2">

  <select id="crm_sel_tax" name="meta[tax_id]" style="width: 100%;" autocomplete="off">
  <?php echo $this->gen_select($tax_codes_list,$feed['tax_id'],__('Select Tax ID','woo-zoho')); ?>
  </select>

   </div>

   <div class="clear"></div>
   </div>
  <div class="vx_row">
   <div class="vx_col1">
  <label for="crm_sel_price"><?php _e('Product Price','woo-zoho'); ?></label>
</div> 
<div class="vx_col2">

  <select id="crm_sel_price" name="meta[item_price]" style="width: 100%;" autocomplete="off">
  <?php
   echo $this->gen_select($books_ops,$feed['item_price'],__('Item Cost','woo-zoho')); ?>
  </select>

   </div>

   <div class="clear"></div>
   </div>  
   
         <div class="vx_row">
   <div class="vx_col1">
  <label for="crm_sel_price_custom"><?php _e('Custom Item field for Price (Optional)','woo-zoho'); ?></label>
</div> 
<div class="vx_col2">
  <input type="text" id="crm_sel_price_custom" name="meta[item_price_custom]" value="<?php echo $this->post('item_price_custom',$feed); ?>"  style="width: 100%;" autocomplete="off">
  <div class="howto"><?php echo __('Enter line item field name for getting item price , Leave it empty for getting default price.','woo-zoho'); ?></div>
  <?php ?>
   </div>

   <div class="clear"></div>
   </div>
<?php  
//if(isset($info['data']['type']) && $info['data']['type'] == 'books'){
 ?>
     <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="order_items_sku"><?php _e('Search Items ', 'woo-zoho'); ?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="crm_items_sku" name="meta[search_items_sku]" value="1" <?php echo !empty($feed["search_items_sku"]) ? "checked='checked'" : ""?> autocomplete="off"/>
    <label for="crm_items_sku"><?php _e('Match items by SKU in zoho, SKU field should be active in zoho account', 'woo-zoho'); ?></label>
  </div>
<div class="clear"></div>
</div>
<?php
 //}
if(isset($info['data']['type']) && $info['data']['type'] == 'inventory'){ ?>
     <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="order_items_ware"><?php _e('WareHouse ', 'woo-zoho'); ?></label>
  </div>
  <div class="vx_col2">
<select id="order_items_ware" name="meta[warehouse]" style="width: 100%">
<?php
 $wares_arr=array(''=>__('All Warehouses','woocommerce-zoho-crm'));
  if(is_array($wares)){
    $wares_arr+=$wares;  
  }  
  foreach($wares_arr as $secs=>$label){
   $sel="";
   if(!empty($feed['warehouse']) && $feed['warehouse'] == $secs){
       $sel='selected="selected"';
   }
  echo "<option value='$secs' $sel>$label</option>";     
  }   

?>
  </select>
  </div>
<div class="clear"></div>
</div>
<?php
 } 
?>
      
  </div>


  </div>
  </div>
<?php
}
if(in_array($module,$camp_support) && vxc_zoho::$is_pr){
      $panel_count++;
      $campaigns=$this->post('campaigns',$meta);
      $member_status_arr=$this->post('member_status',$meta);
  ?>
    <div class="vx_div vx_refresh_panel ">    
      <div class="vx_head ">
<div class="crm_head_div"> <?php  echo sprintf(__('%s. Add as Campaign Member',  'woo-zoho' ),$panel_count); ?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php _e('Expand / Collapse','woo-zoho') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>                 
    <div class="vx_group ">
   <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="crm_camp"><?php _e("Add to Campaign", 'woo-zoho'); $this->tooltip($tooltips['vx_camp_check']);?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="crm_camp" class="crm_toggle_check <?php if(empty($member_status_arr) && empty($campaigns)){echo 'vx_refresh_btn';} ?>" name="meta[add_to_camp]" value="1" <?php echo !empty($feed["add_to_camp"]) ? "checked='checked'" : ""?> autocomplete="off"/>
    <label for="crm_optin"><?php _e("Enable", 'woo-zoho'); ?></label>
  </div>
<div class="clear"></div>
</div>
    <div id="crm_camp_div" style="<?php echo empty($feed["add_to_camp"]) ? "display:none" : ""?>">

  <div class="vx_row">
  <div class="vx_col1">
  <label><?php _e('Campaign & Status Lists','woo-zoho'); $this->tooltip($tooltips['vx_camps']); ?></label>
  </div>
  <div class="vx_col2">
  <button class="button vx_refresh_data" data-id="refresh_campaigns" type="button" autocomplete="off" style="vertical-align: baseline;">
  <span class="reg_ok"><i class="fa fa-refresh"></i> <?php _e('Refresh Data','woo-zoho') ?></span>
  <span class="reg_proc"><i class="fa fa-refresh fa-spin"></i> <?php _e('Refreshing...','woo-zoho') ?></span>
  </button>
  </div> 
   <div class="clear"></div>
  </div> 
 
  <div class="vx_row">
   <div class="vx_col1">
  <label for="crm_sel_camp"><?php _e('Select Campaign','woo-zoho'); $this->tooltip($tooltips['vx_sel_camp']); ?></label>
</div> <div class="vx_col2">

  <select id="crm_sel_camp" name="meta[campaign]" style="width: 100%; <?php if($this->post('camp_type',$feed) != ""){echo 'display: none';} ?>" autocomplete="off">
  <?php echo $this->gen_select($campaigns,$feed['campaign'],__('Select Campaign','woo-zoho')); ?>
  </select>

   </div>

   <div class="clear"></div>
   </div>
  
  
  </div>
  

  </div>
  </div>
    <?php
}
  $contacts_support=array('invoices','estimates','customerpayments','recurringinvoices','creditnotes','purchaseorders','salesorders');
  $payment_support=array('customerpayments');
  $order_support=array('invoices');
  if(in_array($module,$contacts_support)){ 
$contact_feeds=$this->get_object_feeds('contacts',$this->account,$this->post_id);   
$email_feeds=$this->get_object_feeds('contactpersons',$this->account,$this->post_id);   
?>
<div class="vx_div vx_refresh_panel ">    
      <div class="vx_head ">
<div class="crm_head_div"> <?php echo sprintf(__('%s. Assign Contact',  'woo-zoho' ),++$panel_count); 
echo   $req_span2;
?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php _e('Expand / Collapse','woo-zoho') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>                 
    <div class="vx_group ">

        <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="vx_check1"><?php _e("Assign Contact", 'woo-zoho');?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="vx_check1" class="crm_toggle_check" name="meta[contact_check]" value="1" <?php echo !empty($feed["contact_check"]) ? "checked='checked'" : ""?> autocomplete="off"/>
    <label for="vx_check1"><?php _e("Enable", 'woo-zoho'); ?></label>
  </div>
<div class="clear"></div>
</div>
    <div id="vx_check1_div" style="<?php echo empty($feed["contact_check"]) ? "display:none" : ""?>">
         <div class="vx_row">
   <div class="vx_col1">
  <label><?php _e('Select Contact Feed','woo-zoho'); ?></label>
</div> 
<div class="vx_col2">

  <select name="meta[object_contact]" style="width: 100%;" autocomplete="off">
  <?php echo $this->gen_select($contact_feeds ,$feed['object_contact'],__('Select Contact Feed','woo-zoho')); ?>
  </select>

   </div>

   <div class="clear"></div>
   </div>
    </div>

  </div>
  </div>
<?php  

if(in_array($module,$order_support)){ 
  $invoices_feeds=$this->get_object_feeds('salesorders',$this->account,$this->post_id);     
  ?>  
  <div class="vx_div vx_refresh_panel ">    
      <div class="vx_head ">
<div class="crm_head_div"> <?php echo sprintf(__('%s. Assign SalesOrder',  'woo-zoho' ),++$panel_count); 
?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php _e('Expand / Collapse','woo-zoho') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>                 
    <div class="vx_group ">

        <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="vx_check2"><?php _e("Assign SalesOrder", 'woo-zoho');?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="vx_check3" class="crm_toggle_check" name="meta[order_check]" value="1" <?php echo !empty($feed["order_check"]) ? "checked='checked'" : ""?> autocomplete="off"/>
    <label for="vx_check3"><?php _e("Enable", 'woo-zoho'); ?></label>
  </div>
<div class="clear"></div>
</div>
    <div id="vx_check3_div" style="<?php echo empty($feed["order_check"]) ? "display:none" : ""?>">
         <div class="vx_row">
   <div class="vx_col1">
  <label><?php _e('Select SalesOrder Feed','woo-zoho'); ?></label>
</div> 
<div class="vx_col2">
  <select name="meta[object_order]" style="width: 100%;" autocomplete="off">
  <?php echo $this->gen_select($invoices_feeds ,$feed['object_order'],__('Select SalesOrder Feed','woo-zoho')); ?>
  </select>

   </div>

   <div class="clear"></div>
   </div>
    </div>

  </div>
  </div>
<?php
  }  
  if(in_array($module,$payment_support)){ 
  $invoices_feeds=$this->get_object_feeds('invoices',$this->account,$this->post_id);     
  ?>  
  <div class="vx_div vx_refresh_panel ">    
      <div class="vx_head ">
<div class="crm_head_div"> <?php echo sprintf(__('%s. Assign Invoice',  'woo-zoho' ),++$panel_count); 
echo   $req_span2;
?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php _e('Expand / Collapse','woo-zoho') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>                 
    <div class="vx_group ">

        <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="vx_check2"><?php _e("Assign Invoice", 'woo-zoho');?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="vx_check2" class="crm_toggle_check" name="meta[invoice_check]" value="1" <?php echo !empty($feed["invoice_check"]) ? "checked='checked'" : ""?> autocomplete="off"/>
    <label for="vx_check2"><?php _e("Enable", 'woo-zoho'); ?></label>
  </div>
<div class="clear"></div>
</div>
    <div id="vx_check2_div" style="<?php echo empty($feed["invoice_check"]) ? "display:none" : ""?>">
         <div class="vx_row">
   <div class="vx_col1">
  <label><?php _e('Select Invoice Feed','woo-zoho'); ?></label>
</div> 
<div class="vx_col2">

  <select name="meta[object_invoice]" style="width: 100%;" autocomplete="off">
  <?php echo $this->gen_select($invoices_feeds ,$feed['object_invoice'],__('Select Invoice Feed','woo-zoho')); ?>
  </select>

   </div>

   <div class="clear"></div>
   </div>
    </div>

  </div>
  </div>
<?php
  }else if(!in_array($module,array('creditnotes'))){
      ?>
        <div class="vx_div vx_refresh_panel ">    
      <div class="vx_head ">
<div class="crm_head_div"> <?php echo sprintf(__('%s. Send Email ',  'woo-zoho' ),++$panel_count); 
?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php _e('Expand / Collapse','woo-zoho') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>                 
    <div class="vx_group ">

        <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="vx_check3"><?php _e('Send Email ', 'woo-zoho');?></label>
  </div>
  <div class="vx_col3">
  <input type="checkbox" style="margin-top: 0px;" id="vx_check3" class="crm_toggle_check" name="meta[email_check]" value="1" <?php echo !empty($feed["email_check"]) ? "checked='checked'" : ""?> autocomplete="off"/>
    <label for="vx_check3"><?php _e("Enable", 'woo-zoho'); ?></label>
  </div>
<div class="clear"></div>
</div>
    <div id="vx_check3_div" style="<?php echo empty($feed["email_check"]) ? "display:none" : ""?>">
   
         <div class="vx_row">
   <div class="vx_col1">
  <label><?php _e('Custom Email Subject (optional)','woo-zoho'); ?></label>
</div> 
<div class="vx_col2">

  <input type="text" name="meta[email_subject]" value="<?php echo $this->post('email_subject',$feed); ?>" style="width: 100%;" autocomplete="off">

   </div>

   <div class="clear"></div>
   </div>
   
     <div class="vx_row">
   <div class="vx_col1">
  <label><?php _e('Custom Email Body (optional)','woo-zoho'); ?></label>
</div> 
<div class="vx_col2">

  <textarea name="meta[email_body]"  style="width: 100%;" autocomplete="off"><?php echo $this->post('email_body',$feed); ?></textarea>

   </div>

   <div class="clear"></div>
   </div>
   
    </div>

  </div>
  </div>
      <?php
  } }
   ?>  