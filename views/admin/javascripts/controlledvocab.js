ControlledVocab = {
	
	updateField : function(e) {
		var newVal = jQuery(':selected', e.target).attr('label');
		jQuery('textarea' , e.target.parentNode.parentNode).val(newVal);
	},
	
	showTerms: function(e) {
		
		var vocabNodeId = e.target.id;
		var termsNodeId = vocabNodeId.replace('radio', 'select');
		//Omeka isn't expecting me to append more data to the inputNameStem, so it closes it off with a ]
		jQuery('.controlled-vocab-terms', e.target.parentNode.parentNode).each(function(index) {
			if(this.id.replace(']', '') == termsNodeId) {
				this.show();
			} else {
				this.hide();
			}
		});	
	}
};
