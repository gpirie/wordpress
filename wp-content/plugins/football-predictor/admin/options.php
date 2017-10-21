<?php
	
	defined( 'ABSPATH' ) or die();
	
	function predictor_manage_options() {
		?>
			<div class="wrap">

				<div id="poststuff">

					<div id="post-body">

						<div id="post-body-content">

							<div class="postbox">

								<h3 class="hndle">Football Predictor Options</h3>

								<div class="inside">

									<form method="post" action="options.php">
										<?php
											settings_fields("predictor");
								            do_settings_sections("predictor-options");      
								            submit_button( 'Set Scoring' ); 
										?>

							        </form>
									
								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

		<?php
	}