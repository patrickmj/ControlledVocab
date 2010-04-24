<?php

$head = array('body_class' => 'controlled-vocab primary', 
              'title'      => 'Controlled Vocab -- Vocabulary',
              'content_class' => 'vertical-nav');
              
              
head($head);
?>




<h1>Add A Vocabulary</h1>
<?php echo flash(); ?>
<fieldset class="set">
<form method="post" enctype="multipart/form-data" >

<div class="input">
<?php echo text(array('name'=>'name', 'value'=>$controlledvocab_vocab->name), '', 'Name'); ?>
</div>
<div class="input">


<?php echo textarea(array('name'=>'description', 'value'=>$controlledvocab_vocab->description, 'cols'=>'30', 'rows'=>'10'),  '', 'Description'); ?>
</div>
<div class="input">


<?php echo text(array('name'=>'uri',  'value'=>$controlledvocab_vocab->uri), '', 'Uri'); ?>
</div>

<div class="input">


<?php echo text(array('name'=>'api_url',  'value'=>$controlledvocab_vocab->uri), '', 'API URL'); ?>
</div>

<div class="input">
<?php echo select_collection(array('name'=>'collection_ids', 'multiple'=>'true'),  '', 'Collections'); ?>
</div>

<?php echo submit(array('class'=>'submit')); ?>
</form>

</fieldset>

<?php foot(); ?>