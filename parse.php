<?php
$result = <<<EOT
<html>
<head>


	<META http-equiv="refresh" content="1;url=https://stage.exoeso.com/payment/receive?ssl_email=lindsay%40exoeso.com&ssl_cvv2_response=&ssl_last_name=Whatever&ssl_eci_ind=&ssl_account_balance=50.00&ssl_company=&ssl_get_token=&ssl_token=&ssl_result_message=APPROVAL&ssl_token_response=&ssl_country=&ssl_city=Cleveland&ssl_phone=518555-1818&ssl_invoice_number=0030-0022-0003-20140603-R&ssl_promo_code=&ssl_txn_id=AA49315-239600A8-2A1D-45BF-8D04-AF5BD9B2C05D&ssl_result=0&ssl_avs_response=Z&ssl_approval_code=CMC290&ssl_avs_zip=40199&ssl_enrollment=&ssl_exp_date=1114&ssl_avs_address=123+Main+Street&recurring_index=3&ssl_address2=&source=home&ssl_first_name=+Lindsay&sale_index=22&client_index=30&ssl_amount=50.00&ssl_state=&ssl_card_number=51**********1064&ssl_issue_points=&ssl_txn_time=06%2F03%2F2014+05%3A42%3A41+PM">



<style type="text/css">
	BODY, TD, INPUT, SELECT, TEXTAREA, BUTTON, .normal {font-family:arial,helvetica,sans-serif; font-size:10pt; font-weight:normal; }
	.small {font-size: 10pt}
	.medium  {font-size: 14pt}
	.large  {font-size: 18pt}
</style>

</head>










<form name="frmMenu" action="#" method="POST">
<input type="hidden" name="dispatchMethod"/>
<input type="hidden" name="permissionDesc"/>
<input type="hidden" name="menuAction"/>
<input type="hidden" name="thClientID" value=""/>
</form>

</body>

</html>
EOT;
preg_match('/<META.+url=(.+?)>/', $result, $matches);
list($url, $paramString) = explode('?', $matches[1]);
$params = array();
foreach (explode('&', $paramString) as $item) {
	list($key, $value) = explode('=', $item);
	$params[$key] = urldecode($value);
}
var_dump($url, $params);
