<?php 
echo form_open(current_url(), $form_attributes);
//echo form_submit('submit', 'Save User', 'class="button blue save"');
?>

	<div class="row">
		<div class="span12">
			<div class="well">
				<div class="row">

					<div class="span5">
						<?php 
						echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('name'), 'name', array('class' => 'control-label')), array($name));
						?>
					</div>

					<div class="span6">
						<?php 
						echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('description'), 'description', array('class' => 'control-label')), array($description));
						?>				
					</div>

				</div>
			</div>
			<div class="well">
				<div class="row">

					<div class="span5">
						<?php 
						$groups = $this->ion_auth->getUserGroups();
						
						foreach ($groups as $key => $value) {
							echo form_checkbox('groups[]', $key);
							echo '<label class="title">'.$value.'</label>';
							echo '<br/>';
						}
						?>
					</div>

					<div class="span6">
						<?php 
						?>				
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="span12">
			<div class="form-actions">
				<button type="submit" class="btn btn-primary">Save changes</button>
				<button class="btn">Cancel</button>
			</div>
		</div>
	</div>

</form>
