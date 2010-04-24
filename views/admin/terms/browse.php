<?php

$head = array('body_class' => 'controlled-vocab primary', 
              'title'      => 'Controlled Vocab -- Term',
              'content_class' => 'vertical-nav');
              
              
head($head);
?>

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
<?php foreach($controlledvocab_terms as $term):?>
<tr>
	<td><?php echo $term->name; ?></td>
	<td><?php echo $term->description; ?></td>
	<td><?php echo $term->getVocabName(); ?></td>
	<td><?php echo $term->uri; ?></td>
	<td><?php foreach(unserialize($term->element_ids) as $elId) {
			echo $elId;
	}
	?>
	</td>
	<td>
		<a class="edit" href="<?php echo uri("controlled-vocab/terms/edit/$term->id"); ?>">Edit</a>
	</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php foot(); ?>