<div class="row">
  	<div class="col-xl-4">
    	<form role="form" action="<?=isset($form_url) ? $form_url : '#'?>" method="POST" enctype="multipart/form-data">
			<div class="row">
				<div class="col-xl-12">
					<div class="card">
						<div class="card-header">
							<?=isset($title) ? $title : ""?>
						</div>
						<div class="card-body">
							<div class="row"> 
								<div class="col-md-12">
									<?=(isset($notification) ? (!empty($notification) ? $notification : '' ) : '') ?>
								</div>     
							</div>
							<div class="row ">
								<div class="col-xl-12">
									<div class="form-group">
										<label>Amount </label>
										<input type="number" min="100" name="amount" class="form-control" value="100">
										<span class="text-danger"><?=form_error('amount')?></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-12">
									<div class="form-group">
										<button type="submit" class="btn btn-block btn-success">PROCEED</button>
									</div>
								</div>
							</div>
							<div class="row"> 
								<div class="col-md-12">
									<?=(isset($note_message) ? (!empty($note_message) ? $note_message : '' ) : '') ?>
								</div>     
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
  	</div>
</div>