$(function() {
	$('.token-item').css('cursor', 'pointer');
 	var id = '';
 	$('#tokenChoices').on('click', '.token-item', function(e) {
 		console.log('clicked');
	 	e.stopPropagation();
		e.preventDefault();
		var tree = $(this).parentsUntil('#tokenChoices', 'li' );
		tree.push($(this));
		var token = [];
		$.each(tree, function( index, value ) {
			 token.push($(value).html().match(/[^\<]*/gi).slice(0,1));
		});
		tokenstring = '{{'+token.join('.')+'}}';
		console.log(tokenstring);
		insertAtCaret(tokenstring);
		
	});
	
	function insertAtCaret (token) {
		token = token.trim();
	    CKEDITOR.instances['NotificationTemplate'].insertText(tokenstring);
	};
		
});