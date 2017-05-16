
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




// var srch = $('#animal').val();
// undefined
// srch.match(/ain/gi);
// null
// var reg = RegExp(srch);
// undefined
// reg
// /mo/
// var reg = RegExp(srch, gi);
// VM632:1 Uncaught ReferenceError: gi is not defined
//     at <anonymous>:1:24
// (anonymous) @ VM632:1
// var reg = RegExp(srch, 'gi');
// undefined
// reg
// /mo/gi
// srch.match(reg);
// ["mo"]

