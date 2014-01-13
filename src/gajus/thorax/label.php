<?php
namespace gajus\thorax;

class Label {
	private
		$form,
		$template;
	
	public function __construct (Form $form, \Closure $template = null) {
		$this->form = $form;
		
		if ($template === null) {
			$template = 'gajus\thorax\default_label_template';
		}
		
		if (!is_callable($template)) {
			throw new \InvalidArgumentException('Invalid template.');
		}
		
		$this->template = $template;
	}
	
	public function input ($name, array $attributes = null, array $properties = null) {
		$input = $this->form->input($name, $attributes, $properties);
		
		return new label\Template($this->form, $this, $input);
	}
	
	function getTemplate () {
		return $this->template;
	}
}

function default_label_template (form\Input $input, Form $form) {
	$errors = [];

	ob_start();?>
	<div class="thorax-input">
		<label for="<?=$input->getAttribute('id')?>"><?=$input->getProperty('name')?></label>
		<?=$input?>
		<?php if ($errors):?>
		<ul class="thorax-error">
			<li><?=implode('</li><li>', $errors)?></li>
		</ul>
		<?php endif;?>
	</div>
	<?php return ob_get_clean();

	/*$inbox = $input->getInbox();
	
	
	
	if ($inbox) {
		foreach ($inbox as $i) {
			if ($i instanceof \gajus\thorax\input\Error) {
				$errors[] = $i->getMessage();
			}
		}
	}

	$errors = [];
	*/
};