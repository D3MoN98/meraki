<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
    <link rel="shortcut icon" href="<?= base_url('assets/meraki.ico')?>"> 
	<link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:800,900" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url('assets/css/master.css')?>">
	<style>
		#invoice_container {
		  padding: 40px;
		  font-size: 12px; }

		#invoice_header {
		  padding: 20px 0;
		  display: -webkit-box;
		  display: -ms-flexbox;
		  display: flex;
		  -webkit-box-pack: justify;
		  -ms-flex-pack: justify;
		  justify-content: space-between; }
		  #invoice_header h1 {
		    -webkit-box-flex: 0;
		    -ms-flex: 0 1 30%;
		    flex: 0 1 30%; }
		  #invoice_header > h1:nth-child(1) {
		    font-family: 'Montserrat', sans-serif;
		    letter-spacing: 2px;
		    font-weight: 800;
		    color: #5B5B5B; }
		  #invoice_header > h1:nth-child(2) {
		    font-family: 'Montserrat', sans-serif;
		    float: right;
		    letter-spacing: 2px;
		    font-weight: 800;
		    color: #3CBA7A; }

		#invoice_body_1 {
		  padding: 20px 0;
		  display: -webkit-box;
		  display: -ms-flexbox;
		  display: flex;
		  -webkit-box-orient: horizontal;
		  -webkit-box-direction: normal;
		  -ms-flex-flow: row wrap;
		  flex-flow: row wrap;
		  -webkit-box-pack: justify;
		  -ms-flex-pack: justify;
		  justify-content: space-between; }
		  #invoice_body_1 > div {
		    -webkit-box-flex: 0;
		    -ms-flex: 0 1 30%;
		    flex: 0 1 30%; }
		    #invoice_body_1 > div pre, #invoice_body_1 > div p {
		      padding: 2px; }
		    #invoice_body_1 > div b {
		      color: #3CBA7A;
		      letter-spacing: 2px; }

		#invoice_body_2 {
		  padding: 20px 0; }
		  #invoice_body_2 span {
		    margin-right: 100px; }

		#invoice_body_3 {
		  padding: 20px 0; }
		  #invoice_body_3 table {
		    width: 100%;
		    empty-cells: hide;
		    border-collapse: separate;
		    border-spacing: 0; }
		  #invoice_body_3 thead td {
		    padding: 10px;
		    font-size: 12px;
		    letter-spacing: 2px;
		    text-align: center;
		    border-bottom: 1px solid #3CBA7A;
		    font-weight: bold;
		    color: #3CBA7A; }
		  #invoice_body_3 tbody td {
		    padding: 15px;
		    font-size: 10px;
		    text-align: center; }
		  #invoice_body_3 tfoot td {
		    font-size: 12px;
		    letter-spacing: 2px;
		    font-weight: bold;
		    padding: 10px;
		    border-top: 1px solid #3CBA7A;
		    text-align: center;
		    border-spacing: 0;
		    color: #3CBA7A; }
	</style>
</head>
<body>
	<div id="invoice_container">
		<div id="invoice_header">
			<h1>MERAKI</h1>
			<h1>INVOICE</h1>
		</div>
		<div id="invoice_body_1">
			<div>
				<pre>Bill To - <b>Sudipta Jana</b></pre>
				<p><?= $order->location?></p>
			</div>
		</div>
		<div id="invoice_body_2">
			<span>Order Id - <?= $order->order_id?></span><span>Ordered on - <?= $order->order_date?></span>
		</div>
		<div id="invoice_body_3">
			<table>
				<thead>
					<tr>
						<td>Seller</td>
						<td>Description</td>
						<td>Qty</td>
						<td>Net Amount</td>
						<td>Tax(IGST)</td>
						<td>Total</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($order_details as $key) {
					$seller = $this->action->get('seller',['seller_id' => $key->seller_id])->row()->company_name;
					$product = $this->action->get('product',['product_id' => $key->product_id])->row()->name;
					 ?>
					<tr>
						<td><?= $seller?></td>
						<td><?= $product?></td>
						<td><?= $key->qty?></td>
						<td>$<?= $key->price?></td>
						<td>00.00 (0%)</td>
						<td>$<?= $key->price*$key->qty?></td>
					</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Sub Total</td>
						<td>$<?php print_r($sub_total)?></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</body>
</html>