<?php

$head = array('body_class' => 'controlled-vocab primary', 
              'title'      => 'Controlled Vocab -- Term',
              'content_class' => 'vertical-nav');
              
              
head($head);
?>
<?php print_r($debug); ?>

<h1>Edit <?php echo $controlledvocab_term->name ?></h1>
<?php echo flash(); ?>
<fieldset class="set">
<form method="post" enctype="multipart/form-data" >

<div class="input">
<?php echo text(array('name'=>'name', 'value'=>$controlledvocab_term->name), $controlledvocab_term->name, 'Name'); ?>
</div>
<div class="input">


<?php echo textarea(array('name'=>'description', 'value'=>$controlledvocab_term->description, 'cols'=>'30', 'rows'=>'10'),  $controlledvocab_term->description, 'Description'); ?>
</div>
<div class="input">


<?php echo text(array('name'=>'uri',  'value'=>$controlledvocab_term->uri), $controlledvocab_term->uri, 'Uri'); ?>
</div>
<div class="input">
<?php echo select(array('name'=>'vocab_id'), $vocabs,  $controlledvocab_term->vocab_id, 'Vocabulary'); ?>

<p class="explanation">The Controlled Vocabulary this term belongs to.</p>
</div>
<div class="input">
<?php echo select_element(array('name'=>'element_ids', 'multiple'=>'true'),  unserialize($controlledvocab_term->element_ids), 'Elements'); ?>

</div>
<?php echo submit(array('class'=>'submit')); ?>
</form>

</fieldset>
<?php foot(); ?>