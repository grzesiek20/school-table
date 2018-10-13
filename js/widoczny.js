function visibleAjax(){
		$(function ajax () 
			{
				$.ajax({  
				  cache:false,
				  async: false,
				  url: "./database/visible.php", 	  //plany na wykorzystanie do ustawiania widoczności   
				  type: "GET",
				  data: {id_sdiv:id_sdiv},
												  
				  success: function(data)
				  {

				  } 
				});
			}); 
}