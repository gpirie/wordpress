<?php
	
	defined( 'ABSPATH' ) or die();
	
	function predictor_manage_leagues() {
		?>
			<div class="wrap">

				<div id="poststuff">

					<div id="post-body">

						<div id="post-body-content">

							<div class="postbox">

								<h3 class="hndle">Football Predictor Leagues</h3>

								<div class="inside">
								<?php predictor_create_league();?>
								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

		<?php
	}