<?php

$head = array('body_class' => 'controlled-vocab primary', 
              'title'      => 'Controlled Vocab -- Vocabulary',
              'content_class' => 'vertical-nav');
              
              
head($head);
?>
<h1>Controlled Vocabularies</h1>
<p class="add-button" id="add-item"><a href="<?php echo uri("controlled-vocab/vocabs/add") ?>" class="add">Add a Vocabulary</a></p>
<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Vocabulary</th>
			<th>URI</th>
			<th>API URL</th>
			<th>Edit?</th>
		</tr>
	</thead>
	<tbody>
<?php foreach($controlledvocab_vocabs as $controlledvocab_vocab): ?>	
<tr>
	<td><?php echo $controlledvocab_vocab->name; ?></td>
	<td><?php echo $controlledvocab_vocab->description; ?></td>
	<td><?php echo $controlledvocab_vocab->getVocabName(); ?></td>
	<td><?php echo $controlledvocab_vocab->uri; ?></td>
	<td><?php echo $controlledvocab_vocab->api_url; ?></td>

	<td>
		<a class="edit" href="<?php echo uri("controlled-vocab/vocabs/edit/$controlledvocab_vocab->id"); ?>">Edit</a>
	</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<?php foot(); ?>