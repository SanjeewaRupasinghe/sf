<?php
if ( ! defined( 'WFACP_TEMPLATE_DIR' ) ) {
	return '';
}
$id = WFACP_Common::get_id();
do_action( 'wfacp_meta_added', $id );
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<meta name="wfacp_aero_checkout_id" id="wfacp_aero_checkout_id" content="<?php echo $id; ?>"/>
<script type="text/javascript">
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) {
        var script = document.createElement('script');
        script.setAttribute('src', 'https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.7.2/bluebird.min.js');
        document.head.appendChild(script);
    }
</script>
