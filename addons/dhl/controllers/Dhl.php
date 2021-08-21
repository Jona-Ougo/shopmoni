<?php namespace GoCart\Controller;
/**
 * DHL Class
 *
 * @package     GoCart
 * @subpackage  Controllers
 * @category    DHL
 * @author      Clear Sky Designs
 * @link        http://gocartdv.com
 */

class Dhl extends Front { 

    public function __construct()
    {
        parent::__construct();
        \CI::load()->model(array('Locations'));
        $this->customer = \CI::Login()->customer();
    }

    public function rates()
    {
        $settings = \CI::Settings()->get_settings('Dhl');
        
        if(isset($settings['enabled']) && (bool)$settings['enabled'])
        {
        
			$customer_address = (array)\CI::Customers()->get_address(\GC::getAttribute('shipping_address_id'));
			$messageTime = date('Y-m-d\TH:i:s.000-00:00');
			$messageRef = md5($messageTime);

			$items = \GC::getCartItems();

        	//Get rate
        	$xml = '<?xml version="1.0" encoding="UTF-8"?>
<p:DCTRequest xmlns:p="http://www.dhl.com" xmlns:p1="http://www.dhl.com/datatypes" xmlns:p2="http://www.dhl.com/DCTRequestdatatypes" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dhl.com DCT-req.xsd ">
   <GetQuote>
      <Request>
         <ServiceHeader>
            <MessageTime>' . $messageTime . '</MessageTime>
            <MessageReference>' . $messageRef . '</MessageReference>
            <SiteID>' . $settings['site_id'] . '</SiteID>
            <Password>' . $settings['password'] . '</Password>
         </ServiceHeader>
      </Request>
      <From>
         <CountryCode>NG</CountryCode>
         <City>Lagos</City>
      </From>
      <BkgDetails>
         <PaymentCountryCode>SG</PaymentCountryCode>
         <Date>' . date('Y-m-d') . '</Date>
         <ReadyTime>PT12H00M</ReadyTime>
         <ReadyTimeGMTOffset>+01:00</ReadyTimeGMTOffset>
         <DimensionUnit>CM</DimensionUnit>
         <WeightUnit>KG</WeightUnit>
         <Pieces>'; 
         
         foreach($items as $item) {
         	$xml .= '<Piece>
               <PieceID>' . $item->sku . '</PieceID>
               <Height>1</Height>
               <Depth>1</Depth>
               <Width>1</Width>
               <Weight>' . $item->weight . '</Weight>
            </Piece>';
         }

         $xml .= '</Pieces>
         <PaymentAccountNumber />
         <IsDutiable>N</IsDutiable>
         <NetworkTypeCode>AL</NetworkTypeCode>
         <QtdShp>
            <GlobalProductCode>N</GlobalProductCode>
            <LocalProductCode>N</LocalProductCode>
            <QtdShpExChrg>
               <SpecialServiceType>AA</SpecialServiceType>
            </QtdShpExChrg>
         </QtdShp>
      </BkgDetails>
      <To>
         <CountryCode>' . $customer_address['country_code'] . '</CountryCode>
         <City>' .  $customer_address['zone'] . '</City>
      </To>
   </GetQuote>
</p:DCTRequest>
 ';
			//Send request
			$response = $this->curl($xml);
			$response = simplexml_load_string($response);

			$amount = isset($response->GetQuoteResponse->BkgDetails->QtdShp->DimensionalWeight) ? (int)$response->GetQuoteResponse->BkgDetails->QtdShp->WeightChargeTax : 0;
	  	
            return ['DHL'=> $amount];
        }
        else
        {
            return [];
        }
    }
    
    function curl($request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://xmlpitest-ea.dhl.com/XMLShippingServlet',
          CURLOPT_VERBOSE => true,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER=> 0,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $request,
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
}