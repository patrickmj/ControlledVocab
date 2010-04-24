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
<?php echo text(array('name'=>'name', 'value'=>$controlledvocab_vocab->name), $controlledvocab_vocab->name, 'Name'); ?>
</div>
<div class="input">


<?php echo textarea(array('name'=>'description', 'value'=>$controlledvocab_vocab->description, 'cols'=>'30', 'rows'=>'10'),  $controlledvocab_vocab->description, 'Description'); ?>
</div>
<div class="input">


<?php echo text(array('name'=>'uri',  'value'=>$controlledvocab_vocab->uri), $controlledvocab_vocab->uri, 'Uri'); ?>
</div>

<div class="input">


<?php echo text(array('name'=>'api_url',  'value'=>$controlledvocab_vocab->api_url), $controlledvocab_vocab->api_url, 'API URL'); ?>
</div>

<div class="input">
<?php echo select_collection(array('name'=>'element_ids', 'multiple'=>'true'),  unserialize($controlledvocab_vocab->collection_ids), 'Collections'); ?>
</div>

<?php echo submit(array('class'=>'submit')); ?>
</form>

</fieldset>

<?php foot(); ?>