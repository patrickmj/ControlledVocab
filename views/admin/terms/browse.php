<?php

$head = array('body_class' => 'controlled-vocab primary', 
              'title'      => 'Controlled Vocab -- Term',
              'content_class' => 'vertical-nav');
              
              
head($head);
?>
<?php if($vocabName): ?>
<h1>Terms in <?php echo $vocabName; ?></h1>
<?php else: ?>
<h1>Controlled Vocabulary Terms</h1>
<?php endif; ?>
<p class="add-button" id="add-item"><a href="<?php echo uri("controlled-vocab/terms/add") ?>" class="add">Add a Term</a></p>
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
	<td><a href='<?php echo uri("controlled-vocab/vocabs/show/$term->vocab_id") ?>'><?php echo $term->getVocabName(); ?></a></td>
	<td><?php echo $term->uri; ?></td>
	<td><?php $elements = $term->getElementSetAndElement(); 
		foreach($elements as $elSet=>$elements) {
			echo "<h2 class='controlled-vocab-element-set'>$elSet</h2>";
			echo "<ul class='controlled-vocab-elements'>";
			foreach($elements as $element) {
				echo "<li class='controlled-vocab-element'>$element</li>";
			}
			echo "</ul>";
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