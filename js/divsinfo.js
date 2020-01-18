// $(document).ready(function(){
//     $('[data-toggle="popover"]').popover({
//         placement : 'top',
//         trigger : 'hover'
//     });
//" });
$("#menu").on({
	mouseover: function(){
		openNav()
	}	
});

    function openNav() {
		document.getElementById("myNav").style.height = "15%";
	  }
	  
	  function closeNav() {
		document.getElementById("myNav").style.height = "0%";
	  }
	
	var timeOut;
	$("#myNav").mouseleave(function(){
		timeOut = setTimeout("closeNav()",2000);
	
	});
	
	$("#myNav").mouseenter(function(){
		clearTimeout(timeOut);
	
	});
	
	$(".ico").hide(); // ukryj ikony
	
	var Ajax= "0";
	$( function() {
		var width = $("#container").width();
	
	//====================== skalowanie i przenoszenie
		$( ".block" ).resizable({containment: "#container",grid:[10, 5]});
		$( ".block" ).draggable({grid: [10, 10 ] });
	} );
	//===================== wysokość zdjęcia, dopasowanie do panelu
			$( ".sliderblock" ).mouseup(function() {	
				var divwidth = $(this).width();
				var sliderheight = $(this).height();
				if(divwidth<560)
					sliderheight = sliderheight - 77;
				else
					sliderheight = sliderheight - 49;
			
				$("#sdiv6").css("height",sliderheight+"px"); //ustawienie obliczonej wartości do zdjęcia
				
	//========= wysyłka wartości do bazy
				$.ajax({
					url: "./database/updateslider.php",
					type: "POST",
					data: {
						sliderheight:sliderheight
					},
					cache: false,
					success: function() {
					},
					error: function() {
						return false;
					},
				});
			});
	//=================================================
		
			$( ".block" ).mousedown(function() {
				$(this).css("zIndex",2);         //trzymany blok zawsze nad resztą
			});
			  $( ".block" ).mouseup(function() {
				
	//======================= responsywność===========================================================
				var id_panel = $(this).attr('id').substr(3);                                         //
				var height = $(this).height();                                                     //
				var percent_width = Math.round($(this).width()/$(this).parent().width()*100);          // procentowa szerokość
				var percent_left_margin = Math.round($(this).position().left/$(this).parent().width()*100);  // procentowy margines lewy
				var top_margin = $(this).position().top;                                                 // odległośc od góry
				
				$(this).width(percent_width+"%");     //ustawianie wartości
				$(this).css("left",percent_left_margin+"%");
	
			if(id_panel == 1)
				$(this).css("zIndex",1);
			else
				$(this).css("zIndex",0);
	//==================== wysyłka wartości o pozycji divów do bazy		
				$.ajax({
					url: "./database/panel/update.php",
					type: "POST",
					data: {
						id_panel:id_panel, 
						percent_width:percent_width, 
						height:height,
						percent_left_margin:percent_left_margin, 
						top_margin:top_margin
					},
					cache: false,
					success: function() {
					},
					error: function() {
						return false;
					},
				});
	   });
	 
	 //==================== manipulacja ikonami===============
	$(".showico").mouseenter(function(){
			 $(".ico").show();          
	 });                              
	 
	$(".showico").mouseleave(function(){
			 $(".ico").hide();
	 });
	   
	 //=================== slider ze zdjeciami
	 
	 var index = 1;
	
	function prepare() {
	
		function switchBackground() {
			if (index == 1) {
				//this switches to  the first background
				var div = document.getElementById("sdiv6");
				div.className = "animation--fade-bg-1";
				index = 2;
			}
			else if (index == 2) {
				//this switches to  the second background
				var div = document.getElementById("sdiv6");
				div.className = "animation--fade-bg-2";
				index = 0;
			}
			else {
				//this switches to  the third background
				var div = document.getElementById("sdiv6");
				div.className = "animation--fade-bg-3";
				index = 1;
			}
		}
		switchBackground();
		setInterval(function() {switchBackground()}, 8000);
	}
	 
	// var krotka =1;
	// var amount = 4;
	
		// function switchBackground() {
			// if(stop==1){
				// stop=0;    //warunek zatrzyujący pętlę
				// krotka=1;
				// return;
			// }
			// console.log(krotka);
			// var div2 = document.getElementById("sdiv6");
			// div2.className = "animation--fade-bg-"+krotka;
			// $("#sdiv6").fadeIn(1000);
			// if(amount>1)           //       jeśli więcej, niż 1 komunikat (gdy 1, to stałe)
			// {
				// setTimeout("fadeOut()",5000);
			// }
		// }
	
	
	// function fadeOut()
	// {
		// $("#sdiv6").fadeOut(1000);
		// krotka++;
			// if(krotka>amount) {krotka=1; stop=1}
		// setTimeout("switchBackground()",1000);
	// }
