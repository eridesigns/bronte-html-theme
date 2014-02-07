//Avoiding conflicts
var $j = jQuery.noConflict();

//Making the plugins run
$j(document).ready(function() {
	//navigation drop down
    $j('ul.navbar').superfish();
});