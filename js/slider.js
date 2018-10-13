var news = " ";
var ile = 0;
var stop=0;
var table = new Array();
function newAjax(){
		$(function ajax () 
			{
				$.ajax({    
				cache:false,
				async:false,
				  url: "./database/sliderajax.php", 	  // pobranie komunikatów      
				  type: "POST",
				  data: "", 
												  
				  success: function(data)
				  {
					
						newsAjax= data.split('~');
						 ile = newsAjax[1];
						 news = newsAjax[0];
						 table = news.split(';;');
					//$('#sdiv7').html(ile);	
						slajdy();
				  } 
				});
			}); 
}


var k =0;
function slajdy()
{
		if(stop==1){
			stop=0;    //warunek zatrzyujący pętlę
			k=0;
			return;
		}
		var div = document.getElementsByClassName("anim");
		div[0].innerHTML=table[k];
		$(".anim").fadeIn(1000);
		console.log(k);
		if(ile>1)           //       jeśli więcej, niż 1 komunikat (gdy 1, to stałe)
		{
			setTimeout("fOut()",5000);
		}
}
function fOut()
{
	$(".anim").fadeOut(1000);
	k++;
		if(k>=ile)
			k=0;
	setTimeout("slajdy()",1000);
}