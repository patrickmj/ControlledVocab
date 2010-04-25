<?php

$head = array('body_class' => 'controlled-vocab primary', 
              'title'      => 'Controlled Vocab -- Vocabulary',
              'content_class' => 'vertical-nav');
              
              
head($head);
?>




<h1>Edit Vocabulary <?php echo $controlledvocab_vocab->name; ?></h1>
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
<?php echo select_collection(array('name'=>'collection_ids', 'multiple'=>'true'),  unserialize($controlledvocab_vocab->collection_ids), 'Collections'); ?>
</div>

<?php echo submit(array('class'=>'submit')); ?>
</form>
<p id="delete_item_link">
	<a class="delete" href="/workspace/omeka/admin/controlled-vocab/vocabs/delete/<?php echo $controlledvocab_vocab->id ?>">Delete This Item</a>       
</p>
</fieldset>

<?php foot(); ?>