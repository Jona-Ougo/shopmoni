<?php 
$view = \GoCart\Libraries\View::getInstance();
$view->show('email_header');
?>
<table class="main">
	<tr>
		<td class="wrapper">
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<?=$content; ?>
						<br><br>
						<table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
							<tbody>
								<tr>
									<td align="left">
										<table border="0" cellpadding="0" cellspacing="0">
											<tbody>
												<tr>
													<td> <a href="<?=$link ?>" target="_blank">Confirm</a> </td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php 
$view = \GoCart\Libraries\View::getInstance();
$view->show('email_footer');
?>

