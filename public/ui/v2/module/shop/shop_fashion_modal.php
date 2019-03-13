<?php
echo <<<EOT
-->
<!-- Modal -->
<div class="modal fade modal-primary" id="shop-fashion-option" aria-hidden="true" aria-labelledby="shop-fashion-option"
role="dialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content radius0">
			<div class="modal-header radius0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
			<h4 class="modal-title">{$lang_shop_modal_title}</h4>
			</div>
			<div class="modal-body">
<!--
EOT;
require_once template('module/shop/shop_option');
echo <<<EOT
-->
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->
<!--
EOT;
?>