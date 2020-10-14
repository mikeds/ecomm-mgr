<div class="row"> 
	<div class="col-md-12">
		<?=(isset($notification) ? (!empty($notification) ? $notification : '' ) : '') ?>
	</div>
</div>
<div class="card-deck">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">CASH IN via OTC</h5>
			<p class="card-text">On the counter payment.</p>
		</div>
		<div class="card-footer">
			<a href="#" class="btn btn-warning disabled">OTC Payment</a>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">CASH IN via Dragonpay</h5>
			<p class="card-text">Cash-in using dragonpay gateway.</p>
		</div>
		<div class="card-footer">
			<a href="<?=isset($redirect_dragonpay) ? $redirect_dragonpay : "#"?>" class="btn btn-warning">Dragonpay Payment</a>
		</div>
	</div>
</div>