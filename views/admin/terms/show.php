<?php

$head = array('body_class' => 'controlled-vocab primary', 
              'title'      => 'Controlled Vocab ',
              'content_class' => 'vertical-nav');
              
              
head($head);
?>
<h1><?php echo $controlledvocab_term->name; ?></h1>
<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Vocabulary</th>
			<th>URI</th>
			<th>Elements</th>
			<th>Edit?</th>
		</tr>
	</thead>
	<tbody>
<tr>
	<td><?php echo $controlledvocab_term->name; ?></td>
	<td><?php echo $controlledvocab_term->description; ?></td>
	<td><?php echo $controlledvocab_term->getVocabName(); ?></td>
	<td><?php echo $controlledvocab_term->uri; ?></td>
	<td><?php foreach(unserialize($controlledvocab_term->element_ids) as $elId) {
			echo $elId;
	}
	?>
	</td>
	<td>
		<a class="edit" href="<?php echo uri("controlled-vocab/terms/edit/$controlledvocab_term->id"); ?>">Edit</a>
	</td>
</tr>

</tbody>
</table>

<?php foot(); ?>
