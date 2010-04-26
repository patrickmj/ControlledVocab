<?php
define('CONTROLLED_VOCAB_PLUGIN_DIR', dirname(__FILE__));


add_plugin_hook('install', 'ControlledVocabPlugin::install');
add_plugin_hook('uninstall', 'ControlledVocabPlugin::uninstall');
add_plugin_hook('admin_theme_header', 'ControlledVocabPlugin::admin_theme_header');
add_plugin_hook('define_routes', 'ControlledVocabPlugin::define_routes');
add_plugin_hook('config', 'ControlledVocabPlugin::config');
add_plugin_hook('config_form', 'ControlledVocabPlugin::config_form');

add_filter('admin_navigation_main', 'ControlledVocabPlugin::admin_navigation_main');

try{
	ControlledVocabPlugin::addFilters();	
} catch (Exception $e) {
	
}

class ControlledVocabPlugin
{
                                      
                                                                            
	public static function admin_navigation_main($tabs)
	{
		$tabs['Controlled Vocabs'] = uri('controlled-vocab');
		return $tabs;
	}

	public static function addFilters()
	{

		//TODO:: how do I check if tables have been set up?
		if(class_exists("ControlledVocab_Term")) {
			$termTable = get_db()->getTable('ControlledVocab_Term');
			$filterElements = $termTable->getElementSetsAndElements();
			foreach($filterElements as $elSet=>$elNames) {
				foreach($elNames as $elName) {
					add_filter(array('Form', 'Item', $elSet, $elName), 'ControlledVocabPlugin::filterItemForm');    
				}
			}
		}		
	}

	public static function install()
	{
		$db = get_db();				

		$sql = "CREATE TABLE IF NOT EXISTS `{$db->prefix}controlled_vocab_vocabs` (
		  `id` int(11) NOT NULL auto_increment,
		  `name` text COLLATE utf8_unicode_ci NOT NULL,
		  `description` text COLLATE utf8_unicode_ci NULL,
		  `collection_ids`  text COLLATE utf8_unicode_ci  NULL,	  		
		  `uri` text COLLATE utf8_unicode_ci NULL,
		  `api_url` text COLLATE utf8_unicode_ci NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";


	$db->exec($sql);		
		
		
	$sql = "CREATE TABLE IF NOT EXISTS `{$db->prefix}controlled_vocab_terms` (
	  `id` int(10) unsigned NOT NULL  auto_increment,
	  `name` text COLLATE utf8_unicode_ci NOT NULL,
	  `description` text COLLATE utf8_unicode_ci NULL,
	  `uri` text COLLATE utf8_unicode_ci NULL,
	  `vocab_id` int(10) unsigned NULL,	  		
	  `element_ids`  text COLLATE utf8_unicode_ci NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

	$db->exec($sql);

		
	}

	public static function define_routes($router)
	{
		$router->addRoute(
		    'controlled_vocab_terms',
		    new Zend_Controller_Router_Route(
		        'controlled-vocab/terms/:action/:id/', 
		        array(
		            'module'       => 'controlled-vocab', 
		            'controller'   => 'terms',  
		            'id'           => '/d+',

		        )
		    )
		);
		
		$router->addRoute(
		    'controlled_vocab_browse_terms',
		    new Zend_Controller_Router_Route(
		        'controlled-vocab/terms/browse/:vocab/', 
		        array(
		            'module'       => 'controlled-vocab', 
		            'controller'   => 'terms'  
		        )
		    )
		);		
		$router->addRoute(
		    'controlled_vocab_vocabs',
		    new Zend_Controller_Router_Route(
		        'controlled-vocab/vocabs/:action/:id', 
		        array(
		            'module'       => 'controlled-vocab', 
		            'controller'   => 'vocabs',  
		            'id'           => '/d+'
		        )
		    )
		);		
		
	}
	public static function uninstall()
	{
		$db = get_db();
		$sql = "DROP TABLE IF EXISTS `{$db->prefix}controlled_vocab_terms`";
		$db->exec($sql);
				
		$sql = "DROP TABLE IF EXISTS `{$db->prefix}controlled_vocab_vocabs`";
		$db->exec($sql);		
	}   
	public static function admin_theme_header()
	{
		echo js('controlledvocab', 'javascripts');
		echo "<link rel='stylesheet' href='" . css('controlledvocab') . "' />";
	}

    public static function filterItemForm($html, $inputNameStem, $value,
                                          $options, $record, $element)
    {
     	//TODO: grab the stored data about terms and build up the array for each Element
     	$controlledVocabs = get_db()->getTable('ControlledVocab_Term')->findByCollectionAndElementForSelect($record->collection_id, $element->id);
     	     	
     	$taOptions = array('rows'=>'2', 'cols'=>'50');  
        $html .= __v()->formTextarea($inputNameStem . '[text]', $value, $taOptions);
        
        if(count($controlledVocabs) != 0 ) {	        	
	        $html .= "<br/>";
	        $html .= "<div class='controlled-vocab-vocabs'>";        
	        $html .= "<h3 class='controlled-vocab-heading'>Controlled Vocabularies</h3>";
	        $html .= radio(array('class'=>'controlled-vocab-vocabs', 'onchange'=>'ControlledVocab.showTerms(event)', 'name'=>'controlled-vocab-radio-' . $inputNameStem), array_keys($controlledVocabs), null, null);
	        $vocabCount = 0;
	        foreach($controlledVocabs as $vocab=>$termPairs) {        	
	        
	        //have to do inline style to make jQuery play nicely with hiding and showing.
	       	$html .= select(array('name'=>'controlled-vocab-select-' . $inputNameStem . '-' . $vocabCount , 'class'=>'controlled-vocab-terms', 'style'=>'display:none;', 'onchange'=>'ControlledVocab.updateField(event)'), $termPairs, null);
	        	$vocabCount++;
	        }
	        $html .= "</div";        	        	
        }

        return $html;
    }
    
    public static function config_form() {
    	include 'config_form.php';
    }

	public static function config() {
		//print_r($_POST['files']);
		foreach($_POST['files'] as $fileName) {
			$installer = new ControlledVocabInstaller($fileName);
			$installer->install();
		}
	}
}    

?>
