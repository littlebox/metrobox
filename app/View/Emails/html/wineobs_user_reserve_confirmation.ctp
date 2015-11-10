<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
	<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
		<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;font-weight:bold;font-size:24px;line-height:28px;padding-bottom:10px">
			<?php echo __("Thank you for booking with WineObs!"); ?>
		</div>
	</div>
	<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;margin-top:1em">
		<?php echo __("Your reservations:"); ?>
	</div>
</div>
<br style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
<br style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
	<table style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;border-spacing:0;line-height:150%;width:100%">
		<tbody>
			<tr style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
				<td style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif"></td>
				<td style="padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;display:block!important;margin:0 auto!important;clear:both!important;max-width:610px!important">
					<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
						<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;background-color:#ffffff;padding-bottom:15px;padding-left:15px;padding-right:15px;padding-top:15px;border-bottom-width:1px;border-style:solid;border-top-left-radius:3px;border-left-width:1px;border-right-width:1px;border-top-width:0;border-top-right-radius:3px;border-color:#dbdbdb;border-top:1px solid #dbdbdb!important">
							<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;font-weight:bold;font-size:24px;line-height:28px;padding-bottom:10px">
								<?php echo __("Itinerary"); ?>:
							</div>
							<strong style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
								<?php echo __("Date"); ?>: <?php echo $date; ?>
							</strong>
							<br>
							<strong style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
								<?php echo __("Language"); ?>: <?php echo $language; ?>
							</strong>
							<br>
							<strong style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
								<?php echo __("Adults"); ?>: <?php echo $number_of_adults; ?>
							</strong>
							<br>
							<?php if (!empty($number_of_minors)): ?>
							<strong style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
								<?php echo __("Childs"); ?>: <?php echo $number_of_minors; ?>
							</strong>
							<?php endif; ?>
						</div>
					</div>
				</td>
				<td style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif"></td>
			</tr>
		</tbody>
	</table>

	<?php foreach ($reserves as $reserve): ?>
	<table style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;border-spacing:0;line-height:150%;width:100%">
		<tbody>
			<tr style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
				<td style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif"></td>
				<td style="padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;display:block!important;margin:0 auto!important;clear:both!important;max-width:610px!important">
					<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
						<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;padding-top:15px;padding-bottom:15px;padding-left:15px;padding-right:15px;border-bottom-width:1px;background-color:#ffffff;border-style:solid;border-color:#dbdbdb;border-left-width:1px;border-right-width:1px;border-top-width:0">
							<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
								<table style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;border-spacing:0;line-height:150%;width:100%">
									<tbody>
										<tr style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
											<td style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
												<strong style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
												<?php echo $reserve['Tour']['Winery']['name']; ?>
												</strong>
												<br style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
												<?php echo __("Time"); ?>: <b><?php echo substr($reserve['Reserve']['time'], 0, -3); ?></b>
												<br style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
												<?php echo __("Tour"); ?>: <b><?php echo $reserve['Tour']['name']; ?></b>
												<br style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
												<?php echo __("Length"); ?>: <b><?php echo $reserve['Tour']['length']; ?>Hs</b>
												<br style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
												<?php echo __("Address"); ?>: <b><?php echo $reserve['Tour']['Winery']['address']; ?></b>
												<br style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
												<?php echo __("GPS Coord."); ?>: <b><?php echo $reserve['Tour']['Winery']['latitude']; ?>, <?php echo $reserve['Tour']['Winery']['longitude']; ?></b>
												<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
													<a href="https://www.google.com/maps?q=loc:<?php echo $reserve['Tour']['Winery']['latitude']; ?>,<?php echo $reserve['Tour']['Winery']['longitude']; ?>" style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;color:#9E4B55;text-decoration:none" target="_blank">
														<?php echo __("Show map"); ?>
													</a>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</td>
				<td style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif"></td>
			</tr>
		</tbody>
	</table>
	<?php endforeach; ?>

	<table style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;border-spacing:0;line-height:150%;width:100%">
		<tbody>
			<tr style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
				<td style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif"></td>
				<td style="padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;display:block!important;margin:0 auto!important;clear:both!important;max-width:610px!important">
					<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
						<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;padding-top:15px;padding-bottom:15px;padding-left:15px;padding-right:15px;border-bottom-width:1px;background-color:#ffffff;border-style:solid;border-color:#dbdbdb;border-left-width:1px;border-right-width:1px;border-top-width:0">
							<a href="http://alpha.wineobs.com/cancelar?code=<?php echo $encoded_data; ?>" style="margin:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;display:block;padding:10px 16px;text-decoration:none;border-radius:2px;border:1px solid;text-align:center;vertical-align:middle;font-weight:bold;white-space:nowrap;border-color:#dbdbdb;background:#ffffff;color:#565a5c" target="_blank">
								<?php echo __("Cancel reservations"); ?>
							</a>
						</div>
					</div>
				</td>
				<td style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif"></td>
			</tr>
		</tbody>
	</table>

	<table style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;border-spacing:0;line-height:150%;width:100%">
		<tbody>
			<tr style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
				<td style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif"></td>
				<td style="padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;display:block!important;margin:0 auto!important;clear:both!important;max-width:610px!important">
					<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
						<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;padding-top:15px;padding-bottom:15px;padding-left:15px;padding-right:15px;border-bottom-width:1px;background-color:#ffffff;border-style:solid;border-color:#dbdbdb;border-left-width:1px;border-right-width:1px;border-top-width:0">
							<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;font-weight:bold;font-size:24px;line-height:28px;padding-bottom:10px">
								<?php echo __("Cancellation policy"); ?>
							</div>
							<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
								<?php echo __("Full refund until 3 days before booking date."); ?>
							</div>
						</div>
					</div>
				</td>
				<td style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif"></td>
			</tr>
		</tbody>
	</table>
</div>

<br style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
<br style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">

<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
	<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;background-color:#ffffff;padding-bottom:15px;padding-left:15px;padding-right:15px;padding-top:15px;border-bottom-width:1px;border-style:solid;border-top-left-radius:3px;border-left-width:1px;border-right-width:1px;border-top-width:0;border-top-right-radius:3px;border-color:#dbdbdb;border-top:1px solid #dbdbdb!important">
		<table style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;border-spacing:0;line-height:150%;width:100%">
			<tbody>
				<tr style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
					<td width="50%" style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;color:#9ca299;text-align:left"><?php echo __("Payment method"); ?></td>
					<td width="50%" style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;text-align:right">Mercado Pago</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;padding-left:15px;padding-bottom:15px;border-bottom-width:1px;padding-right:15px;padding-top:15px;border-style:solid;border-color:#dbdbdb;border-left-width:1px;border-right-width:1px;border-top-width:0;background-color:#f7f7f7;color:#565a5c">
		<table style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;border-spacing:0;line-height:150%;width:100%">
			<tbody>
				<tr style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
					<td width="80%" style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;text-align:right">Total</td>
					<td width="20%" style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;text-align:right">$834</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<br style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
<br style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif">
