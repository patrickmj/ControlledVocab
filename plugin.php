<?php



add_plugin_hook('install', 'ControlledVocabPlugin::install');
add_plugin_hook('uninstall', 'ControlledVocabPlugin::uninstall');
add_plugin_hook('define_routes', 'ControlledVocabPlugin::define_routes');
add_filter('admin_navigation_main', 'ControlledVocabPlugin::admin_navigation_main');

if(class_exists("ControlledVocab_Term")) {
	$termTable = get_db()->getTable('ControlledVocab_Term');
	$filterElements = $termTable->getElementSetsAndElements();
	foreach($filterElements as $elSet=>$elNames) {
		foreach($elNames as $elName) {
			add_filter(array('Form', 'Item', $elSet, $elName), 'ControlledVocabPlugin::filterItemForm');
			//add_filter(array('Form', 'Save', $elSet, $elName), 'ControlledVocabPlugin::filterItemSave');    
		}
	}
	
	
	
}
	


class ControlledVocabPlugin
{
	
    public static $dcSubjects = array(''       => '',
                                      'red'    => 'red',
                                      'yellow' => 'yellow',
                                      'green'  => 'green',
                                      'blue'   => 'blue',
                                      'brown'  => 'brown',
                                      'black'  => 'black',
                                      'white'  => 'white');
                                      
	public static function admin_navigation_main($tabs)
	{
		$tabs['Controlled Vocabs'] = uri('controlled-vocab');
		return $tabs;
	}

	public static function install()
	{
		$db = get_db();				

		$sql = "CREATE TABLE IF NOT EXISTS `{$db->prefix}controlled_vocab_vocabs` (
		  `id` int(11) NOT NULL auto_increment,
		  `name` text COLLATE utf8_unicode_ci NOT NULL,
		  `description` text COLLATE utf8_unicode_ci NULL,
		  `collection_ids`  text COLLATE utf8_unicode_ci NOT NULL,	  		
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
	  `vocab_id` int(10) unsigned NOT NULL,	  		
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
		        'controlled-vocab/terms/:action/:id', 
		        array(
		            'module'       => 'controlled-vocab', 
		            'controller'   => 'terms',  
		            'id'           => '/d+'
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

    public static function filterItemForm($html, $inputNameStem, $value,
                                          $options, $record, $element)
    {
     	//TODO: grab the stored data about terms and build up the array for each Element
     	$controlledVocabs = get_db()->getTable('ControlledVocab_Term')->findByCollectionAndElementForSelect($record->collection_id, $element->id);
     	     	
     	$taOptions = array('rows'=>'2', 'cols'=>'50');  
        $html .= __v()->formTextarea($inputNameStem . '[text][0]', $value, $taOptions);
        
        $html .= "<br/>";
        $html .= "<div class='controlled-vocabs'>";
        $html .= radio(array('class'=>'controlled-vocab-vocabs', 'name'=>'controlled-vocab-radio-' . $element->name), array_keys($controlledVocabs), null, null);
        $vocabCount = 0;
        foreach($controlledVocabs as $vocab=>$termPairs) {        	
        	$html .= select(array('name'=>'controlled-vocab-select-' . $element->name . '-' . $vocabCount , 'class'=>'controlled-vocab-terms'), $termPairs, null);
        	$vocabCount++;
        }
        $html .= "</div";
        
        
        //$html .= __v()->formSelect($inputNameStem . '[text][1]', $value, $options, ControlledVocabPlugin::$dcSubjects);
       
        $html .= "<p>Use Controlled Vocabulary Options</p>";
        return $html;
    }
/*
    public static function filterItemSave($elementText, $record, $element)
    {
    	
        if (strlen(trim($elementText[0]))) {
            return $elementText[0];
        }
        return $elementText[1];
    }
    */
}
?>
