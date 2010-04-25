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
	<td><a href='<?php echo uri("controlled-vocab/vocabs/show/$controlledvocab_term->vocab_id");?>'><?php echo $controlledvocab_term->getVocabName(); ?></a></td>
	<td><?php echo $controlledvocab_term->uri; ?></td>
	<td><?php $elements = $controlledvocab_term->getElementSetAndElement(); 
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
		<a class="edit" href="<?php echo uri("controlled-vocab/terms/edit/$controlledvocab_term->id"); ?>">Edit</a>
	</td>
</tr>

</tbody>
</table>

<?php foot(); ?>
