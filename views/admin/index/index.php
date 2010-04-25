<?php

$head = array('body_class' => 'controlled-vocab primary', 
              'title'      => 'Controlled Vocab ',
              'content_class' => 'vertical-nav');
              
              
head($head);
?>

<div class="controlled-vocab-indexes">
	<div class="controlled-vocab-vocab-index">
		<h1>Controlled Vocabularies</h1>
		<a class="browse" href="<?php echo uri('controlled-vocab/vocabs/browse') ?>">Browse Details</a>
		<a class="add" href="<?php echo uri('controlled-vocab/vocabs/add') ?>">Add a vocabulary</a>
		<?php foreach($vocabs as $vocab):?>
		<div class="record">
			<a class="edit" href="<?php echo uri("controlled-vocab/vocabs/edit/$vocab->id")?>">Edit</a>
			<h2><?php echo $vocab->name; ?></h2>
		</div>	
		<?php endforeach; ?>
	</div>
	
	
	<div class="controlled-vocab-term-index">
		<h1>Terms</h1>
		<a class="browse" href="<?php echo uri('controlled-vocab/terms/browse') ?>">Browse Details</a>
		<a class="add" href="<?php echo uri('controlled-vocab/terms/add') ?>">Add a term</a>
		<?php foreach($terms as $term):?>
		<div class="record">
			<a class="edit" href="<?php echo uri("controlled-vocab/terms/edit/$term->id")?>">Edit</a>
			<h2><?php echo $term->name; ?></h2>
		</div>
		<?php endforeach; ?>
	</div>

</div>

<?php foot(); ?>