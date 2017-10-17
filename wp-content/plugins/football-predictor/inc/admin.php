<?php
	function predictor_admin_page() {
		?>

			<div class="wrap">

				<div id="poststuff">

					<div id="post-body">

						<div id="post-body-content">

							<div class="postbox">

								<h3 class="hndle">Football Predictor</h3>

								<div class="inside">

									<?php predictor_admin_process_scores();?>

									<?php if ( array_key_exists( 'notice', $_GET ) && 'scores-updated' === $_GET['notice'] ) 
										{
											?>
												<div id="message" class="updated notice notice-success is-dismissible">
													<p>The Scores have been updated.</p>
													<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
												</div>
											<?php
										}
									?>

									<?php echo predictor_admin_manage_final_scores();?>
									
								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

		<?php
	}

	
