
$(document).ready(function($) {
	$(function() {
		$( "#datepicker" ).datetimepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true
		});
	});	    

	 $('#title').change(function(){
			var title=$(this).val();				
			title=title.toLowerCase();
			title=title.replace(/\s+/g,'-').replace(/;|\.|\,|\(|\)|:|;|'|"|\?|>|<|\[|\]|\{|\}|\*|&|\^|\%|\$|#|@|\!|/g, '');				
			$('#alias').val(title);
	 });
	 

	$( "select[name='clink']" ).change( function(){		
		//$("select[name='template']").prop('disabled', function(i, v) { return !v; });
		//$("select[name='template']").attr('disabled', false);
		$("select[name='plink']").val("");
		$("input[name='elink']").val("");
	});
	
	$( "select[name='plink']" ).change( function(){				
		$("select[name='clink']").val("");
		//$("select[name='template']").val('default').attr('disabled', true);
		$("input[name='elink']").val("");		
	});	
	
	$( "input[name='elink']" ).change( function(){				
		$("select[name='clink']").val("");
		//$("select[name='template']").val('default').attr('disabled', true);
		$("select[name='plink']").val("");
	});		
	
});


	