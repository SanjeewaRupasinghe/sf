<?php
class Payfort_Fort_Payment extends Payfort_Fort_Super
{

    private static $instance;
    private $pfHelper;
    private $pfConfig;
    private $pfOrder;

    public function __construct()
    {
        parent::__construct();
        $this->pfHelper   = Payfort_Fort_Helper::getInstance();
        $this->pfConfig   = Payfort_Fort_Config::getInstance();
        $this->pfOrder    = new Payfort_Fort_Order();
    }

    /**
     * @return Payfort_Fort_Config
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Payfort_Fort_Payment();
        }
        return self::$instance;
    }
    
    public function getPaymentRequestParams($paymentMethod, $integrationType = PAYFORT_FORT_INTEGRATION_TYPE_REDIRECTION)
    {
        $orderId = $this->pfOrder->getSessionOrderId();
        $this->pfOrder->loadOrder($orderId);

        $gatewayParams = array(
            'merchant_identifier' => $this->pfConfig->getMerchantIdentifier(),
            'access_code'         => $this->pfConfig->getAccessCode(),
            'merchant_reference'  => $orderId,
            'language'            => $this->pfConfig->getLanguage(),
        );
        if ($integrationType == PAYFORT_FORT_INTEGRATION_TYPE_REDIRECTION) {
            $baseCurrency                    = $this->pfHelper->getBaseCurrency();
            $orderCurrency                   = $this->pfOrder->getCurrencyCode();
            $currency                        = $this->pfHelper->getFortCurrency($baseCurrency, $orderCurrency);
            $gatewayParams['currency']       = strtoupper($currency);
            $gatewayParams['amount']         = $this->pfHelper->convertFortAmount($this->pfOrder->getTotal(), $this->pfOrder->getCurrencyValue(), $currency);
            $gatewayParams['customer_email'] = $this->pfOrder->getEmail();
            $gatewayParams['command']        = $this->pfConfig->getCommand();
            $gatewayParams['return_url']     = $this->pfHelper->getReturnUrl('responseOnline');
            if ($paymentMethod == PAYFORT_FORT_PAYMENT_METHOD_SADAD) {
                $gatewayParams['payment_option'] = 'SADAD';
            }
            elseif ($paymentMethod == PAYFORT_FORT_PAYMENT_METHOD_NAPS) {
                $gatewayParams['payment_option']    = 'NAPS';
                $gatewayParams['order_description'] = $orderId;
            } else if($paymentMethod == PAYFORT_FORT_PAYMENT_METHOD_INSTALLMENTS) {
                $gatewayParams['installments'] = 'STANDALONE';
                $gatewayParams['command']      = 'PURCHASE';
            }
        }
        elseif ($integrationType == PAYFORT_FORT_INTEGRATION_TYPE_MERCAHNT_PAGE || $integrationType == PAYFORT_FORT_INTEGRATION_TYPE_MERCAHNT_PAGE2) {
                $gatewayParams['service_command'] = 'TOKENIZATION';
                $gatewayParams['return_url']      = $this->pfHelper->getReturnUrl('merchantPageResponse');
                
                if($paymentMethod == PAYFORT_FORT_PAYMENT_METHOD_INSTALLMENTS && $integrationType == PAYFORT_FORT_INTEGRATION_TYPE_MERCAHNT_PAGE ){
                    $baseCurrency                    = $this->pfHelper->getBaseCurrency();
                    $orderCurrency                   = $this->pfOrder->getCurrencyCode();
                    $currency                        = $this->pfHelper->getFortCurrency($baseCurrency, $orderCurrency);
                    $gatewayParams['currency']       = strtoupper($currency);
                    $gatewayParams['installments']          = 'STANDALONE';
                    $gatewayParams['amount']         = $this->pfHelper->convertFortAmount($this->pfOrder->getTotal(), $this->pfOrder->getCurrencyValue(), $currency);
                }
        }
        $signature                  = $this->pfHelper->calculateSignature($gatewayParams, 'request');
        $gatewayParams['signature'] = $signature;

        $gatewayUrl = $this->pfHelper->getGatewayUrl();
        
        $this->pfHelper->log("Payfort Request Params for payment method ($paymentMethod) \n\n" . print_r($gatewayParams, 1));
        return array('url' => $gatewayUrl, 'params' => $gatewayParams);
    }

    public function getPaymentRequestForm($paymentMethod, $integrationType = PAYFORT_FORT_INTEGRATION_TYPE_REDIRECTION)
    {
        $paymentRequestParams = $this->getPaymentRequestParams($paymentMethod, $integrationType);

        $form = '<form style="display:none" name="frm_payfort_fort_payment" id="frm_payfort_fort_payment" method="post" action="' . $paymentRequestParams['url'] . '">';
        foreach ($paymentRequestParams['params'] as $k => $v) {
            $form .= '<input type="hidden" name="' . $k . '" value="' . $v . '">';
        }
        $form .= '<input type="submit">';
        return $form;
    }

    /**
     * 
     * @param array  $fortParams
     * @param string $responseMode (online, offline)
     * @retrun boolean
     */
    public function handleFortResponse($fortParams = array(), $responseMode = 'online', $integrationType = 'redirection')
    {
        try {
            $responseParams  = $fortParams;
            $success         = false;
            $responseMessage = Payfort_Fort_Language::__('error_transaction_error_1');
            //$this->session->data['error'] = Payfort_Fort_Language::__('text_payment_failed').$params['response_message'];
            if (empty($responseParams)) {
                $this->pfHelper->log('Invalid fort response parameters (' . $responseMode . ')');
                throw new Exception($responseMessage);
            }

            if (!isset($responseParams['merchant_reference']) || empty($responseParams['merchant_reference'])) {
                $this->pfHelper->log("Invalid fort response parameters. merchant_reference not found ($responseMode) \n\n" . print_r($responseParams, 1));
                throw new Exception($responseMessage);
            }

            $orderId = $responseParams['merchant_reference'];
            $this->pfOrder->loadOrder($orderId);

            $paymentMethod = $this->pfOrder->getPaymentMethod();
            $this->pfHelper->log("Fort response parameters ($responseMode) for payment method ($paymentMethod) \n\n" . print_r($responseParams, 1));

            $notIncludedParams = array('signature', 'wc-ajax', 'wc-api',  'payfort_fort', 'integration_type', 'WordApp_launch', 'WordApp_mobile_site', 'WordApp_demo', 'WordApp_demo');

            $responseType          = $responseParams['response_message'];
            $signature             = $responseParams['signature'];
            $responseOrderId       = $responseParams['merchant_reference'];
            $responseStatus        = isset($responseParams['status']) ? $responseParams['status'] : '';
            $responseCode          = isset($responseParams['response_code']) ? $responseParams['response_code'] : '';
            $responseStatusMessage = $responseType;

            $responseGatewayParams = $responseParams;
            foreach ($responseGatewayParams as $k => $v) {
                if (in_array($k, $notIncludedParams)) {
                    unset($responseGatewayParams[$k]);
                }
            }
            $responseSignature = $this->pfHelper->calculateSignature($responseGatewayParams, 'response');
            // check the signature
            if (strtolower($responseSignature) !== strtolower($signature)) {
                $responseMessage = Payfort_Fort_Language::__('error_invalid_signature');
                $this->pfHelper->log(sprintf('Invalid Signature. Calculated Signature: %1s, Response Signature: %2s', $signature, $responseSignature));
                // There is a problem in the response we got
                if ($responseMode == 'offline') {
                    $r = $this->pfOrder->declineOrder('Invalid Signature.');
                    if ($r) {
                        throw new Exception($responseMessage);
                    }
                }
                else {
                    throw new Exception($responseMessage);
                }
            }
            if (empty($responseCode)) {
                //get order status
                $orderStaus = $this->pfOrder->getStatusId();
                if ($orderStaus == $this->pfConfig->getSuccessOrderStatusId()) {
                    $responseCode   = '00000';
                    $responseStatus = '02';
                }
                else {
                    $responseCode   = 'failed';
                    $responseStatus = '10';
                }
            }

            if ($integrationType == 'cc_merchant_page_h2h') {
                if ($responseCode == '20064' && isset($responseParams['3ds_url'])) {
                    if($integrationType == PAYFORT_FORT_INTEGRATION_TYPE_MERCAHNT_PAGE2) {
                        header('location:' . $responseParams['3ds_url']);
                    }
                    else{
                        header('location:' . $responseParams['3ds_url']);   
                        // echo '<script>window.top.location.href = "'.$responseParams['3ds_url'].'"</script>'; 
                    }
                    exit;
                }
            }
            if ($responseStatus == '01') {
                $responseMessage = Payfort_Fort_Language::__('text_payment_canceled');
                if ($responseMode == 'offline') {
                    $r = $this->pfOrder->cancelOrder();
                    if ($r) {
                        throw new Exception($responseMessage);
                    }
                }
                else {
                    throw new Exception($responseMessage);
                }
            }
            if (substr($responseCode, 2) != '000') {
                $responseMessage = sprintf(Payfort_Fort_Language::__('error_transaction_error_2'), $responseStatusMessage);
                if ($responseMode == 'offline') {
                    $r = $this->pfOrder->declineOrder($responseStatusMessage);
                    if ($r) {
                        throw new Exception($responseMessage);
                    }
                }
                else {
                    throw new Exception($responseMessage);
                }
            }
            if (substr($responseCode, 2) == '000') {
                if (($paymentMethod == PAYFORT_FORT_PAYMENT_METHOD_CC && ($integrationType == PAYFORT_FORT_INTEGRATION_TYPE_MERCAHNT_PAGE || $integrationType == PAYFORT_FORT_INTEGRATION_TYPE_MERCAHNT_PAGE2)) || ($paymentMethod == PAYFORT_FORT_PAYMENT_METHOD_INSTALLMENTS && $integrationType == PAYFORT_FORT_INTEGRATION_TYPE_MERCAHNT_PAGE)) {
                    $host2HostParams = $this->merchantPageNotifyFort($responseParams, $orderId);
                    return $this->handleFortResponse($host2HostParams, 'online', 'cc_merchant_page_h2h');
                }
                else { //success order
                    $this->pfOrder->successOrder($responseParams, $responseMode);
                }
            }
            else {
                $responseMessage = sprintf(Payfort_Fort_Language::__('error_transaction_error_2'), Payfort_Fort_Language::__('error_response_unknown'));
                if ($responseMode == 'offline') {
                    $r = $this->pfOrder->declineOrder('Unknown Response');
                    if ($r) {
                        throw new Exception($responseMessage);
                    }
                }
                else {
                    throw new Exception($responseMessage);
                }
            }
        } catch (Exception $e) {
            unset( WC()->session->order_awaiting_payment );
            $this->pfHelper->setFlashMsg($e->getMessage(), PAYFORT_FORT_FLASH_MSG_ERROR);
            return false;
        }
        return true;
    }

    private function merchantPageNotifyFort($fortParams, $orderId)
    {
        //send host to host
        $this->pfOrder->loadOrder($orderId);

        $baseCurrency  = $this->pfHelper->getBaseCurrency();
        $orderCurrency = $this->pfOrder->getCurrencyCode();
        $currency      = $this->pfHelper->getFortCurrency($baseCurrency, $orderCurrency);
        $language      = $this->pfConfig->getLanguage();
        $paymentMethod = $this->pfOrder->getPaymentMethod();
        $postData      = array(
            'merchant_reference'  => $fortParams['merchant_reference'],
            'access_code'         => $this->pfConfig->getAccessCode(),
            'command'             => $this->pfConfig->getCommand(),
            'merchant_identifier' => $this->pfConfig->getMerchantIdentifier(),
            'customer_ip'         => $this->pfHelper->getCustomerIp(),
            'amount'              => $this->pfHelper->convertFortAmount($this->pfOrder->getTotal(), $this->pfOrder->getCurrencyValue(), $currency),
            'currency'            => strtoupper($currency),
            'customer_email'      => $this->pfOrder->getEmail(),
            'token_name'          => $fortParams['token_name'],
            'language'            => $language,
            'return_url'          => $this->pfHelper->getReturnUrl('responseOnline')
        );
        
        if($paymentMethod == PAYFORT_FORT_PAYMENT_METHOD_INSTALLMENTS) {
            $postData['installments']            = 'YES';
            $postData['plan_code']               = $fortParams['plan_code'];
            $postData['issuer_code']             = $fortParams['issuer_code'];
            $postData['command']                 = 'PURCHASE';
        }
        
        $customerName = $this->pfOrder->getCustomerName();
        if (!empty($customerName)) {
            $postData['customer_name'] = $this->pfOrder->getCustomerName();
        }
        //calculate request signature
        $signature             = $this->pfHelper->calculateSignature($postData, 'request');
        $postData['signature'] = $signature;

        $gatewayUrl = $this->pfHelper->getGatewayUrl('notificationApi');
        $this->pfHelper->log('Merchant Page Notify Api Request Params : ' . print_r($postData, 1));

        $response = $this->callApi($postData, $gatewayUrl);

        return $response;
    }

    public function merchantPageCancel()
    {
        $orderId = $this->pfOrder->getSessionOrderId();
        $this->pfOrder->loadOrder($orderId);

        if ($orderId) {
            $this->pfOrder->cancelOrder();
        }
        $this->pfHelper->setFlashMsg(Payfort_Fort_Language::__('text_payment_canceled'));
        return true;
    }
    
    public function callApi($postData, $gatewayUrl)
    {
        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        $useragent = "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:20.0) Gecko/20100101 Firefox/20.0";
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json;charset=UTF-8',
                //'Accept: application/json, application/*+json',
                //'Connection:keep-alive'
        ));
        curl_setopt($ch, CURLOPT_URL, $gatewayUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_ENCODING, "compress, gzip");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // allow redirects		
        //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return into a variable
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); // The number of seconds to wait while trying to connect
        //curl_setopt($ch, CURLOPT_TIMEOUT, Yii::app()->params['apiCallTimeout']); // timeout in seconds
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

        $response = curl_exec($ch);

        curl_close($ch);

        $array_result = json_decode($response, true);

        if (!$response || empty($array_result)) {
            return false;
        }
        return $array_result;
    }

    
    // APPLE PAY WEB REQUESTS

    public function apwMerchantValidation($validation_url){
        
        $this->pfHelper->log('apw merchant valildation url => : ' . $validation_url);
        
        if("https" == parse_url($validation_url, PHP_URL_SCHEME) && substr(parse_url($validation_url, PHP_URL_HOST), -10 ) == ".apple.com"){

            $apw_merchant_identifier = APW_MERCHANT_IDENTIFIER;
            $apw_domain_name = APW_DOMAIN_NAME;
            $apw_display_name = APW_DISPLAY_NAME;
            $apw_certificate_path = APW_CERTIFICATE_PATH;
            $apw_certificate_key = APW_CERTIFICATE_KEY;
            $apw_certificate_key_pass = APW_CERTIFICATE_KEY_PASS;

            $ch = curl_init();

            $data = '{"merchantIdentifier":"'.$apw_merchant_identifier.'", "domainName":"'.$apw_domain_name.'", "displayName":"'.$apw_display_name.'"}';
$this->pfHelper->log('json Data => : ' . $data);
$this->pfHelper->log('apw_certificate_key => : ' . $apw_certificate_key);
$this->pfHelper->log('apw_certificate_path => : ' . $apw_certificate_path);
$this->pfHelper->log('apw_certificate_key_pass => : ' . $apw_certificate_key_pass);
            curl_setopt($ch, CURLOPT_URL, $validation_url);
            curl_setopt($ch, CURLOPT_SSLCERT, $apw_certificate_path);
            curl_setopt($ch, CURLOPT_SSLKEY, $apw_certificate_key);
            curl_setopt($ch, CURLOPT_SSLKEYPASSWD, $apw_certificate_key_pass);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

            $respData = curl_exec($ch);

            if($respData === false)
            {
                $this->pfHelper->log('apw merchant valildation => : ' . print_r(curl_error($ch)));
            }

            curl_close($ch);

        }else{
            $this->pfHelper->log('apw merchant valildation url issue ');
        }
    }

    public function setParamsForApplePay($formData, $tokenData, $totalPay, $orderId){
        
        $this->pfOrder->loadOrder($orderId);
        
        $this->pfHelper->log("Right After Client Ajax orderData => " . json_encode($formData) . " Token Data => ".  json_encode($tokenData));
        
        $baseCurrency  = $this->pfHelper->getBaseCurrency();
        $orderCurrency = $this->pfOrder->getCurrencyCode();
        $orderCurrency = 'AED';
        $currency      = $this->pfHelper->getFortCurrency($baseCurrency, $orderCurrency);
        $language      = $this->pfConfig->getLanguage();

        $customerName = $this->pfOrder->getCustomerName();

        $this->pfHelper->log("Order Paid Amount => " . $this->pfHelper->convertFortAmount($this->pfOrder->getTotal(), $this->pfOrder->getCurrencyValue(), $currency));

        $parameters = [
            'digital_wallet'        => 'APPLE_PAY',
            'command'               => 'PURCHASE',
            'access_code'           => '5QPetxvrJ79qoH4F23nL',
            'merchant_identifier'   => 'xyKdBdwl',
            'merchant_reference'    => $orderId.'-'.rand(0, time()),
            'amount'                => intval($totalPay*100),
            'currency'              => strtoupper($currency),
            'language'              => $language,
            'customer_email'        => $this->pfOrder->getEmail(),
            'apple_data'            => $tokenData['paymentData']['data'],
            'apple_signature'       => $tokenData['paymentData']['signature'],

            'apple_header'          => [
                'apple_transactionId' => $tokenData['paymentData']['header']['transactionId'],
                'apple_ephemeralPublicKey' => $tokenData['paymentData']['header']['ephemeralPublicKey'],
                'apple_publicKeyHash' => $tokenData['paymentData']['header']['publicKeyHash']
            ],

            'apple_paymentMethod'   => [
                'apple_displayName'=> $tokenData['paymentMethod']['displayName'],
                'apple_network'=> $tokenData['paymentMethod']['network'],
                'apple_type'=> $tokenData['paymentMethod']['type']
            ],

            // 'customer_ip'           => $this->pfHelper->getCustomerIp(),
            'customer_name'         => $customerName,
        ];

        $parameters['signature'] = $this->pfHelper->pfsupportsignature($parameters);
        
        $this->pfHelper->log("Before Curl Payfort setParamsForApplePay => " . json_encode($parameters) . "");
        
        $response = $this->requestApplePayWeb($parameters);

        return $response;

    }

    public function requestApplePayWeb($allData){

        if (WP_DEBUG) {
            $uri = 'https://paymentservices.payfort.com/FortAPI/paymentApi';
        } else {
            $uri = 'https://sbpaymentservices.payfort.com/FortAPI/paymentApi';
        }
        $uri = 'https://paymentservices.payfort.com/FortAPI/paymentApi';

        $this->pfHelper->log("apple pay web data before => " . json_encode($allData) . "");

        $curl = curl_init();

        curl_setopt_array($curl, [

            CURLOPT_URL => $uri,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($allData),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ]);

        $result = curl_exec($curl);

        $this->pfHelper->log("apple pay web data after => " . json_encode($result) . "");

        curl_close($curl);

        // return json_decode($result, true);
        return $result;
    }

    function onlyLetters($string)
    {
        // $string = "sdsdتجربة٢ تجربة١ dfdfdf _!@#$%^&*()_+-0123456789 ١٢٣٤٥٦٧٨٩ \/";
        $string = preg_replace('/[^a-zA-Z\d\p{Arabic} ]/iu', '', $string);
        $string = trim($string);

        return $string;
    }
}

?>