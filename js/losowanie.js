function wykluczAjax(a){
		$(function ajax () 
			{
				$.ajax({  
				  cache:false,
				  async: false,
				  url: "./database/randomizeajax.php", 	       
				  type: "POST",
				  data: {number:a},
												  
				  success: function(data)
				  {

				  } 
				});
			}); 
}

var liczby = "";
var index =0;
function losowanieAjax(){ //pobranie wszystkich niewylosowanych

		$(function ajax () 
			{
				$.ajax({  
				  cache:false,
				  async: false,
				  url: "./database/randomizeajax.php", 	  //the script to call to get data          
				  type: "POST",
				  data: "", 
												  
				  success: function(data)
				  {
					  liczby = data.split('-');
					  los = Math.seedrandom();
					  index = Math.round((Math.random(los) * liczby.length)); //losowanie
					  var drawBlock = $('.drawblock');
					  if (drawBlock) {
						  drawBlock.html(liczby[index]);
					  }
					
					wykluczAjax(liczby[index]);  //wykluczenie wylosowanej liczby
				  } 
				});
			}); 
}