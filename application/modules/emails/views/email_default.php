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
						<p>Hi there,</p>
						<p>Sometimes you just want to send a simple HTML email with a simple design and clear call to action. This is it.</p>
						<table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
							<tbody>
								<tr>
									<td align="left">
										<table border="0" cellpadding="0" cellspacing="0">
											<tbody>
												<tr>
													<td> <a href="http://htmlemail.io" target="_blank">Call To Action</a> </td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<p>This is a really simple email template. Its sole purpose is to get the recipient to click the button with no distractions.</p>
						<p>Good luck! Hope it works.</p>
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

