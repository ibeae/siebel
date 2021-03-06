<?php
$customerName = trim($this->siebel->getCustomerdata($customernumber, param('param_asw_database_column_customername')));

if(isset($id) && !empty($id))
{
	$this->load->view('holidays/edit');
}
else 
{
?>
	<div class="row">

		<div class="span12">

				<?= form_open(current_url(), array('class' => 'subnav')); ?>

					<ul class="nav nav-pills">
						<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('from')); ?></a></li>
						<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('until')); ?></a></li>
						<li class="span6"><a><?php echo ucfirst($this->siebel->getLang('comment')); ?></a></li>
						<li class="float-right align-right">
							<p>
								<span class="btn btn-small create href" data-href="<?php echo current_url() ?>/new"><i class="icon-plus"></i> <?php //echo $this->siebel->getLang('create') ?></span>
							</p>
						</li>

					</ul>

				</form>

		</div> <!-- End span12 -->

	</div> <!-- end row -->

	<div class="container list list-striped">

	<?php foreach($items as $item) { 
	?>
		<div class="row">
			<div class="span12">
				<div class="row">
					<div class="span2">
						<p><?php echo date('d/m/Y',  mysql_to_unix($item->from)) ?><br /></p>
					</div>
					<div class="span2">
						<p><?php echo date('d/m/Y',  mysql_to_unix($item->until)) ?><br /></p>
					</div>
					<div class="span6">
						<p><?php echo $item->comment ?><br /></p>
					</div>
					<div class="align-right">
						<p>
							<a href="<?php echo current_url().'/'. $item->id; ?>" class="btn btn-small edit"><i class="icon-pencil"></i> <?php echo $this->siebel->getLang('edit') ?></a>
						</p>
					</div>
				</div>
			</div>
		</div>

	<?php } ?>
	</div>
<?php } ?>
