<?php

function mec_shortcode_get_sed_method($widget = '',$shortcode_id = ''){

    global $MEC_Shortcode_id;
    if(!empty($shortcode_id)){

        $id = $shortcode_id;
    }elseif($MEC_Shortcode_id){

        $id = $MEC_Shortcode_id;
    }else{

        $id = get_the_ID();
    }

    $skin = get_post_meta($id,'skin',true);
    $options = get_post_meta($id,'sk-options',true);

    if(isset($options[$skin])){

        $sed_method = isset($options[$skin]['sed_method']) ? $options[$skin]['sed_method'] : '';
        switch($sed_method){
            case '0':

                $sed_method = '_self';
                break;
            case 'new':

                $sed_method = '_blank';
                break;
        }
    }

    return isset($sed_method) ? $sed_method :'_self' ;

}