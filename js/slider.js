
	//var news = " ";
	//var ile = 0;
	var stop=0;
	//var table = new Array();
	var newsBlocks = $('.multipleblock');
	function newAjax(){
		var aIds=[];
		if (newsBlocks) {
			for (i=0;i<newsBlocks.length; i++){
				var parentClass = newsBlocks[i].parentElement.classList[1];
				var parentId = parentClass.substr(4);
				aIds.push({parentId:parentId, sdivId:newsBlocks[i].id.substr(4)});
			}
			aIds.forEach(id => {
				$(function ajax () 
				{
					$.ajax({    
					cache:false,
					async:false,
					  url: "./database/sliderajax.php", 	  // pobranie komunikatów      
					  type: "POST",
					  data: {
						  parentId:id.parentId
						},
													  
					  success: function(data)
					  {
						
							var table= data.split(';;');
							var k = 0;
						//$('#sdiv7').html(ile);	
							slajdy(id.sdivId, table, k);
					  } 
					});
				}); 
			});
				
	
	
		}
	}
	
	

	function slajdy(id, table, k)
	{
			if(stop==1){
				stop=0;    //warunek zatrzymujący pętlę
				k=0;
				return;
			}
			var animBlock = $("#sdiv" + id);
			if (animBlock) {
				animBlock.html(table[k]);
				animBlock.fadeIn(1000);
	
				console.log(k);
				if(table.length>1)           //       jeśli więcej, niż 1 komunikat (gdy 1, to stałe)
				{
					setTimeout(fOut, 5000, id, table, k);
				}
			}
			// var div = document.getElementsByClassName("anim");
			// div[0].innerHTML=table[k];
	}
	function fOut(id, table, k)
	{
		var animBlock = $("#sdiv" + id);
		if (animBlock) {
			animBlock.fadeOut(1000);
			k++;
			if(k>=table.length)
				k=0;
		setTimeout(slajdy, 1000, id, table, k);
		}
	}


