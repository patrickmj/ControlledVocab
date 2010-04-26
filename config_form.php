<?php

include CONTROLLED_VOCAB_PLUGIN_DIR . DIRECTORY_SEPARATOR . "models" . DIRECTORY_SEPARATOR . "ControlledVocabInstaller.php"; 

$files = scandir(CONTROLLED_VOCAB_PLUGIN_DIR . DIRECTORY_SEPARATOR . "files");
unset($files[0]);
unset($files[1]);
?>

<p>The following vocabularies are available to import.</p>
<?php
foreach($files as $file) {
	$installer = new ControlledVocabInstaller($file);
	echo "<h1>$installer->vocabName</h1>";
	if($installer->isInstalled() ) {
		echo "<p>Already Installed</p>";
	} else {
		echo checkbox(array('name'=>'files[]' ), false, $installer->fileName, "Install?");
	}

}
?>




