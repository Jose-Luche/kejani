<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Invoice</title>
		<link rel="stylesheet" href={{asset('backend/css/style.css')}}>
		<link rel="stylesheet" href={{asset('backend/css/vendors_css.css')}}>

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(5) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(5) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(5) {
				text-align: left;
			}
		</style>
	</head>

	<body>
    
    
		<div class="invoice-box">
      <div style="text-align: center"><b>INVOICE #000{{$invoice->id}}</b></div>
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="4">
						<table>
							<tr>
								<td class="title">
									<!--<img src="{{asset(app('cLogo'))}}" style="height: 150px; width:150px" />-->
								</td>

								<td>
									
									
									
								</td>
							</tr>
						</table>
					</td>
				</tr>
        

				<tr class="information">
					<td colspan="5">
						<table>
							<tr>
								<td>
									{{$details->name}}<br />
									{{$details->mobile}}<br />
									{{$details->phLocation}}<br /><br>
                 <b>Invoice Date: {{ date("d M Y")}}  <br /></b> 
								</td>
                                
								<td style="float: right">
									
									@if($invoice->tenant != null)
									{{$invoice->tenant->name}}<br />
									{{$invoice->tenant->email}}<br />
									{{$invoice->tenant->mobile}}<br />	
								
									@else
										
									---
									@endif

								
									
								</td>
							</tr>
						</table>
					</td>
				</tr>

				

				<tr class="heading">
                    
					<td>Date</td>
                    <td>Fee Type</td>
                    <td>Bill Amount</td>
					<td>Amount Paid</td>
					<td>Balance</td>
				</tr>

				
				<tr class="item">
					<td>{{ date('d M Y', strtotime($invoice->date)) }}</td> 
					<td>{{$invoice->projId }}</td>
					<td>{{ $invoice->amount }}</td>
					<td>{{ $invoice->totalAmountPaid($invoice->id) }}</td>
					<td>{{ $invoice->projectionBalance($invoice->id) }}</td>
				</tr>
					

				<tr class="total" id="total">
					<td></td>
                    <td></td>
                    <td></td>
					<td></td>
                    

					<td> 
						<b>Total:{{number_format($invoice->projectionBalance($invoice->id),2)}} </b> 
						
                    </td>
				</tr>
			</table>
		</div>
		

		
		
	</body>
</html>
