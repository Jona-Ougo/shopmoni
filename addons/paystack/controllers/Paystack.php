<?php namespace GoCart\Controller;
/**
 * Cod Class
 *
 * @package     GoCart
 * @subpackage  Controllers
 * @category    Cod
 * @author      Clear Sky Designs
 * @link        http://gocartdv.com
 */

class Paystack extends Front {

    public function __construct()
    {
        parent::__construct();
        \CI::lang()->load('paystack');
    }

    //back end installation functions
    public function checkoutForm()
    {	
		//set a default blank setting for flatrate shipping
		$this->partial('paystackCheckoutForm');
    }

    public function isEnabled()
    {
        $settings = \CI::Settings()->get_settings('paystack');
        return (isset($settings['enabled']) && (bool)$settings['enabled'])?true:false;
    }

    function processPayment()
    {
        $errors = \GC::checkOrder();
        if(count($errors) > 0)
        {
            echo json_encode(['errors'=>$errors]);
            return false;
        }
        else
        {
            $payment = [
                'order_id' => \GC::getAttribute('id'),
                'amount' => \GC::getGrandTotal(),
                'status' => 'processed',
                'payment_module' => 'Paystack',
                'description' => lang('paystack')
            ];

            \CI::Orders()->savePaymentInfo($payment);
			
			$amount = \GC::getGrandTotal() * 100;
			$total = \GC::getGrandTotal();
			$customer_address = (array)\CI::Customers()->get_address(\GC::getAttribute('shipping_address_id'));

            $orderId = \GC::submitOrder();
			
			$settings = \CI::Settings()->get_settings('paystack');


			//Get payment URL
            $getPaymentURL = $this->getTransactionDetails($settings['gateway_url'], ['order_id' => $orderId, 'amount' => $amount, 'email' => $customer_address['email']], ['authorization: Bearer ' . $settings['public_key'], 'cache-control: no-cache']);

            if (strpos($getPaymentURL, 'cURL Error') !== false) {
                echo json_encode([]);
            }

            $tranx = json_decode($getPaymentURL, true);
            $url = '';

            if (isset($tranx['data']['authorization_url'])) {
                $url = $tranx['data']['authorization_url'];
            }

            //send the order ID
            echo json_encode([
							  'gateway_url' => $url,
							  'custDetails' => $customer_address['email'],
							  'uniqueRef' => $orderId,
							  'responseUrl' => site_url('/paystack/response') . '&transRef=' . $orderId,
							  'cancelReturnPage' => ''
							]);
            return false;
        }
    }
    
    public function response()
    {
		if (!isset($_REQUEST['transRef'])) {
			//redirect(site_url('/'));
		}
		
		$orderObject = \CI::Orders()->getOrder($_REQUEST['transRef']);
		
		$transactionReference = isset($_REQUEST['transRef']) ? $_REQUEST['transRef'] : '';
		
		$settings = \CI::Settings()->get_settings('paystack');
		
		$url = $settings['gateway_url'];
		
		$data = [
				'merchantcode' => $settings['merchant_id'],
				'transactionref' => $transactionReference
		];
		
		//confirm for the transaction details
		$json_response = $this->getTransactionDetails($url, $data);
		$json_response = json_decode(strip_tags($json_response));

		$status_code = $response_description = $merch_amt = $amount = '';
		
		$status_code = @$json_response->ResponseCode;
		$response_description = @$json_response->ResponseDescription;
		$amount = @$json_response->Amount;
		$payment_reference = @$json_response->TransactionRef;
		
		//Payment status
		$paymentObj = \CI::Orders()->getPaymentInfo($orderObject->id);
		
		if($status_code == '00' && ($paymentObj[0]->status == 'processed' || $paymentObj[0]->status == 'paid'))
		{	
			\CI::db()->where('order_id', $paymentObj[0]->payment_id);
            \CI::db()->update('payments', ['status' => 'paid']);
			
			$reason ="<h2 style=\"color:green\">Payment Successful</h2>";
			$reason.="Order ID : ".$transactionReference;
			$reason.="<br>Transaction Reference : ".$payment_reference;
			$str='<div >'.$reason.'</div>';
		}
		else
		{
			
			\CI::db()->where('order_id', $paymentObj[0]->payment_id);
            \CI::db()->update('payments', ['status' => 'failed']);
			
			$reason ="<h2 style=\"color:red\">Transaction Unsuccessful</h2>";
			$reason.="Order ID : ".$transactionReference;
			$reason.="<br>Transaction Reference : ".$payment_reference;
			$reason.="<br>Error Reason : ".$response_description;
			$str='<div >'.$reason.'</div>';			
		}
		
		$data['body'] = $str;
		
		$this->partial('success', $data);
    }
	
	public function getTransactionDetails($url, $data, $header = [])
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_VERBOSE => true,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_SSL_VERIFYHOST => 0,
		  CURLOPT_SSL_VERIFYPEER=> 0,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTPHEADER => array_merge(array('Content-Type: application/json'), $header),
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => json_encode($data)
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  return "cURL Error #:" . $err;
		} else {
			return $response;
		}
	}

    public function getName()
    {
        echo lang('paystack');
    }
}
