
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Receipt</title>
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

			.invoice-box table tr td:nth-child(2) {
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

			.invoice-box table tr.total td:nth-child(2) {
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

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
    
    
		<div class="invoice-box">
      <div style="text-align: center"><b>OFFICIAL RECEIPT #000{{$receipt->id}}</b></div>
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<!--<img src="{{(app('cLogo'))}}" style="height: 150px; width:150px" />-->
								</td>

								<td>
									
									
									
								</td>
							</tr>
						</table>
					</td>
				</tr>
        

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									@if($details != null)
									{{$details->name}}<br/>
									{{$details->mobile}}<br/>
									{{$details->phLocation}}<br/>
									@endif
									
                  Payment Date: {{$receipt->regDate}}<br />
								</td>

								<td>
									{{$receipt->tenant->name}}.<br />
									{{$receipt->tenant->email}}<br />
									{{$receipt->tenant->mobile}}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Payment Method</td>

					<td>Reference</td>
				</tr>

				<tr class="details">
					<td>{{$receipt->payMode}}</td>

					<td>{{$receipt->reference}}</td>
				</tr>

				<tr class="heading">
					<td>Item</td>

					<td>Price</td>
				</tr>
				@if($receipt->receiptAllocations)
					@foreach ($receipt->receiptAllocations as $row)
						<tr class="item">
				
							<td>{{$row->projId}}</td>
		
							<td>{{$row->amount}}</td>
						</tr>
					@endforeach
				@endif

				

				

				<tr class="total">
					<td></td>

					<td>Total: {{$receipt->receiptAllocations->sum('amount')}}</td>
				</tr>
			</table>
		</div>
		
		
	</body>
</html>
