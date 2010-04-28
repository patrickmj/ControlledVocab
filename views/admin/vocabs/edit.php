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
<p class='controlled-vocab-explanation'>The name of the vocabulary.</p>
</div>
<div class="input">


<?php echo textarea(array('name'=>'description', 'value'=>$controlledvocab_vocab->description, 'cols'=>'30', 'rows'=>'10'),  $controlledvocab_vocab->description, 'Description'); ?>
<p class='controlled-vocab-explanation'>A description of the vocabulary.</p>
</div>
<div class="input">


<?php echo text(array('name'=>'uri',  'value'=>$controlledvocab_vocab->uri), $controlledvocab_vocab->uri, 'Uri'); ?>
<p class='controlled-vocab-explanation'>A URI that identifies the vocabular.</p>
</div>

<div class="input">


<?php echo text(array('name'=>'api_url',  'value'=>$controlledvocab_vocab->api_url), $controlledvocab_vocab->api_url, 'API URL'); ?>
<p class='controlled-vocab-explanation'>A URL of a service that provides a web service onto the vocabulary.</p>
</div>

<div class="input">
<?php echo select_collection(array('name'=>'collection_ids', 'multiple'=>'true'),  unserialize($controlledvocab_vocab->collection_ids), 'Collections'); ?>
<p class='controlled-vocab-explanation'>The collections to which the vocabulary applies.</p>
</div>

<?php echo submit(array('class'=>'submit')); ?>
</form>
<p id="delete_item_link">
	<a class="delete" href="<?php echo uri('controlled-vocab/vocabs/delete/delete/') . $controlledvocab_vocab->id ?>">Delete This Item</a>       
</p>
</fieldset>

<?php foot(); ?>