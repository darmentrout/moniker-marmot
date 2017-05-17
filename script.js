
// get all animals or just the ones from the search
$('#submit0').on('click keydown', function(e){
	e.preventDefault();
	$.get('mm.php', $('#form0').serialize(), function(data){
		animals = $.parseJSON(data);
		$('#theResults0').html("");
		for(i=0;i<animals.length;i++){
			if ( animals[i].animal === 'No Matches.' ) {
				$('#theResults0').append("<p>" + animals[i].animal + "</p>");
				break;
			}
			else {
				$('#theResults0').append("<p>" + animals[i].epithet + " <span class='species'>" + animals[i].animal + "</span></p>");
			}
		} // end for loop
		var srch = $('#animal').val();
		var reg = RegExp(srch, 'gi');
		$('.species').each(function(){
			var txt = $(this).text();
			$(this).html( txt.replace(reg, '<u>'+srch+'</u>') );
		});		
		$('#theResults0').slideDown();
	});
});


// match animals to the search term
$('#submit1').on('click keydown', function(e){
	e.preventDefault();
	var epithet = $('#find_match').val();
	if (epithet.length < 1){
		$('#matchError').slideDown();
	}
	else {
		$('#matchError').slideUp();
		$.get('mm.php', $('#form1').serialize(), function(data){
			animals = $.parseJSON(data);
			$('#theResults1').html("");
			for(i=0;i<animals.length;i++){
				if ( animals[i].animal === 'No Matches.' ) {
					$('#theResults1').append("<p>" + animals[i].animal + "</p>");
					break;
				}
				else {
					$('#theResults1').append("<p>" + epithet + " " + animals[i].animal + "</p>");
				}
			}
			$('#theResults1').slideDown();
		});
	}
});


