$(document).ready(function(){
	refreshMatch();
});
function refreshMatch(){
    $('#match-jumbotron').load('php/match.php', function(){
		setTimeout(refreshMatch, 3000);
    });
}