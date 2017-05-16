
// get all animals or just the ones from the search
$('#submit0').on('click keydown', function(e){
	e.preventDefault();
	$.get('mm1.php', $('#form0').serialize(), function(data){
		animals = $.parseJSON(data);
		$('#theResults0').html("");
		for(i=0;i<animals.length;i++){
			if ( animals[i].animal === 'No Matches.' ) {
				$('#theResults0').append("<li>" + animals[i].animal + "</li>");
				break;
			}
			else {
				$('#theResults0').append("<li>" + animals[i].epithet + " <span class='species'>" + animals[i].animal + "</span></li>");
			}
		} // end for loop
		var srch = $('#animal').val();
		var reg = RegExp(srch, 'gi');
		$('.species').each(function(){
			var txt = $(this).text();
			$(this).html( txt.replace(reg, '<u>'+srch+'</u>') );
		});		
	});
});


// match animals to the search term
$('#submit1').on('click keydown', function(e){
	e.preventDefault();
	$.get('mm1.php', $('#form1').serialize(), function(data){
		var epithet = $('#find_match').val();
		animals = $.parseJSON(data);
		$('#theResults1').html("");
		for(i=0;i<animals.length;i++){
			if ( animals[i].animal === 'No Matches.' ) {
				$('#theResults1').append("<li>" + animals[i].animal + "</li>");
				break;
			}
			else {
				$('#theResults1').append("<li>" + epithet + " " + animals[i].animal + "</li>");
			}
		}
	});
});


