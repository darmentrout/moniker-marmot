
// get all animals or just the ones from the search
$('#submit0').on('click keydown', function(e){
	e.preventDefault();
	$.get('mm1.php', $('#form0').serialize(), function(data){
		animals = $.parseJSON(data);
		$('#theResults0').html("");
		for(i=0;i<animals.length;i++){
			$('#theResults0').append("<li>" + animals[i].epithet + " " + animals[i].animal + "</li>");
		}
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
			$('#theResults1').append("<li>" + epithet + " " + animals[i].animal + "</li>");
		}
	});
});