<?php

class Payfort_Fort_Helper extends Payfort_Fort_Super
{

    private static $instance;
    private $pfConfig;
    private $log;
    
    public function __construct()
    {
        parent::__construct();
        $this->pfConfig = Payfort_Fort_Config::getInstance();
    }

    /**
     * @return Payfort_Fort_Config
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Payfort_Fort_Helper();
        }
        return self::$instance;
    }
    
    public function getBaseCurrency()
    {
        return get_woocommerce_currency();
    }

    public function getFrontCurrency()
    {
        return get_woocommerce_currency();
    }
    
    public function getFortCurrency($baseCurrencyCode, $currentCurrencyCode)
    {
        $gateway_currency = $this->pfConfig->getGatewayCurrency();
        $currencyCode     = $baseCurrencyCode;
        if ($gateway_currency == 'front') {
            $currencyCode = $currentCurrencyCode;
        }
        return $currencyCode;
    }

    public function getReturnUrl($path)
    {
        return get_site_url().'?wc-api=wc_gateway_payfort_fort_'.$path;
    }

    public function getUrl($path)
    {
        $url = get_site_url().$path;
        return $url;
    }

    /**
     * Convert Amount with decimal points
     * @param decimal $amount
     * @param decimal $currency_value
     * @param string  $currency_code
     * @return decimal
     */
    public function convertFortAmount($amount, $currency_value, $currency_code)
    {
        $gateway_currency = $this->pfConfig->getGatewayCurrency();
        $new_amount       = 0;
        //$decimal_points = $this->currency->getDecimalPlace();
        $decimal_points   = $this->getCurrencyDecimalPoints($currency_code);
        if ($gateway_currency == 'front') {
            $new_amount = round($amount * $currency_value, $decimal_points);
        }
        else {
            $new_amount = round($amount, $decimal_points);
        }
        $new_amount = $new_amount * (pow(10, $decimal_points));
        return "$new_amount";
    }

    /**
     * 
     * @param string $currency
     * @param integer 
     */
    public function getCurrencyDecimalPoints($currency)
    {
        $decimalPoint  = 2;
        $arrCurrencies = array(
            'JOD' => 3,
            'KWD' => 3,
            'OMR' => 3,
            'TND' => 3,
            'BHD' => 3,
            'LYD' => 3,
            'IQD' => 3,
        );
        if (isset($arrCurrencies[$currency])) {
            $decimalPoint = $arrCurrencies[$currency];
        }
        return $decimalPoint;
    }

    /**
     * calculate fort signature
     * @param array $arrData
     * @param sting $signType request or response
     * @return string fort signature
     */
    public function calculateSignature($arrData, $signType = 'request')
    {
        $shaString = '';

        ksort($arrData);
        foreach ($arrData as $k => $v) {
            $shaString .= "$k=$v";
        }

        if ($signType == 'request') {
            $shaString = $this->pfConfig->getRequestShaPhrase() . $shaString . $this->pfConfig->getRequestShaPhrase();
        }
        else {
            $shaString = $this->pfConfig->getResponseShaPhrase() . $shaString . $this->pfConfig->getResponseShaPhrase();
        }
        $signature = hash($this->pfConfig->getHashAlgorithm(), $shaString);

        return $signature;
    }

    /**
     * Log the error on the disk
     */
    public function log($messages, $forceDebug = false)
    {
        $debugMode = $this->pfConfig->isDebugMode();
        if (!$debugMode && !$forceDebug) {
            return;
        }
        if ( ! class_exists( 'WC_Logger' ) ) {
                include_once( 'class-wc-logger.php' );
        }
        if ( empty( $this->log ) ) {
                $this->log = new WC_Logger();
        }
        $this->log->add( 'payfort_fort', $messages );
    }

    public function getCustomerIp()
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    public function getGatewayHost()
    {
        if ($this->pfConfig->isSandboxMode()) {
            return $this->getGatewaySandboxHost();
        }
        return $this->getGatewayProdHost();
    }

    public function getGatewayUrl($type = 'redirection')
    {
        $testMode = $this->pfConfig->isSandboxMode();
        if ($type == 'notificationApi') {
            $gatewayUrl = $testMode ?  'https://sbpaymentservices.payfort.com/FortAPI/paymentApi' :  'https://paymentservices.payfort.com/FortAPI/paymentApi';
        }
        else {
            $gatewayUrl = $testMode ? $this->pfConfig->getGatewaySandboxHost() . 'FortAPI/paymentPage' : $this->pfConfig->getGatewayProdHost() . 'FortAPI/paymentPage';
        }

        return $gatewayUrl;
    }

    public function setFlashMsg($message, $status = PAYFORT_FORT_FLASH_MSG_ERROR, $title = '')
    {
        global $woocommerce;
        if(function_exists("wc_add_notice")) {
            // Use the new version of the add_error method
            wc_add_notice($message, $status);
        } else {
            // Use the old version
            if($status == PAYFORT_FORT_FLASH_MSG_ERROR){
                $woocommerce->add_error($message);
            }
            else{
                $woocommerce->add_message($message);
            }
            
        }
    }
    
    public static function loadJsMessages($messages, $isReturn = true, $category = 'payfort_fort') {
        $result = '';
        foreach($messages as $label => $translation) {
            $result .= "arr_messages['{$category}.{$label}']='" . $translation ."';\n";
        }
        if($isReturn) {
            return $result;
        }
        else{
            echo $result; 
        }
    }

    public function calculateSignatureAp1(array $arrData, $signType = 'request')
    {
        $shaString = '';

        foreach ($arrData as $key => $val) {
            if ($key === 'signature') {
                continue;
            }
            if (gettype($val) !== 'array') {
                $shaString .= "$key=$val";
            } else {
                $sub_str = $key . '={';
                $index = 0;
                // ksort($val);
                foreach ($val as $k => $v) {
                    $sub_str .= "$k=$v";
                    if ($index < count($val) - 1) {
                        $sub_str .= ', ';
                    }
                    $index++;
                }
                $sub_str .= '}';
                $shaString .= $sub_str;
            }
        }
        if ($signType == 'request') {
            $shaString = '74ZDvrk8yY8S/EvJyvgH.Y#)' . $shaString . '74ZDvrk8yY8S/EvJyvgH.Y#)';
        } else {
            $shaString = '76qkT6UuW6IQxVWI/xomSi&{' . $shaString . '76qkT6UuW6IQxVWI/xomSi&{';
        }

        $signature = hash('sha256', $shaString);

        return $signature;
    }

    public function pfsupportsignature($arrData, $signType = 'request')
    {
        $apple_header = '{apple_transactionId='.$arrData['apple_header']['apple_transactionId'].', '.
            'apple_ephemeralPublicKey='.$arrData['apple_header']['apple_ephemeralPublicKey'].', '.'apple_publicKeyHash='.$arrData['apple_header']['apple_publicKeyHash'].'}';

        $apple_paymentMethod = '{apple_displayName='.$arrData['apple_paymentMethod']['apple_displayName'].', apple_network='.$arrData['apple_paymentMethod']['apple_network'].', apple_type='.$arrData['apple_paymentMethod']['apple_type'].'}';

        $apple_signature = $arrData['apple_signature'];

        $shaStr = "access_code={$arrData['access_code']}amount={$arrData['amount']}apple_data={$arrData['apple_data']}apple_header=".$apple_header."apple_paymentMethod=".$apple_paymentMethod."apple_signature=".$apple_signature."command={$arrData['command']}currency={$arrData['currency']}customer_email={$arrData['customer_email']}customer_name={$arrData['customer_name']}digital_wallet={$arrData['digital_wallet']}language={$arrData['language']}merchant_identifier={$arrData['merchant_identifier']}merchant_reference={$arrData['merchant_reference']}";

        $finalShaStr = "518CfOMyr26Oc9qILV1Y2R@[".$shaStr."518CfOMyr26Oc9qILV1Y2R@[";

        $signature = hash("sha256", $finalShaStr);
        
        return $signature;
    }

}

?>