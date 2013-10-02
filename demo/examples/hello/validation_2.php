<?php
$form = new \ay\thorax\Form();

// Rule has to be applied before the form is generated.
// This allows Label to access Rule properties.
$form->addRule('is_eq_a', ['first_name']);

$label = $form->addLabel();
?>
<form action="" method="post">
	<?=$label->input('first_name', null, ['label' => 'Custom Label'])?>
	<?=$form->input('action[submit]', ['type' => 'submit', 'value' => 'Submit'])?>
</form>
<?php
if ($form->isSubmitted()) {
	$form->getErrors(true);
	
	header('Location: ' . $_SERVER['REQUEST_URI']);
}