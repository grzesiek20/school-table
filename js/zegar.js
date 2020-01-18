
//===================== nazwa lekcji oraz godzina zakończenia		
function bazaAjax(){
	var time = new Date();
	var hour = time.getHours();
	var min = time.getMinutes();
	var sec = time.getSeconds();
	var timesend = hour+":"+min+":"+sec;
	$(function ajax () 
		{
			$.ajax({  
			  async: false,
			  cache: false,
			  url: "./database/confplanajax.php", 	  //the script to call to get data          
			  type: "POST",
			  data: {
				end_hour:timesend
			}, 
											  
			  success: function(data)
			  {
				  lekcja = data.split('-');
					Ajax = lekcja[1];
					var planBlock = $('.planblock');
					if (planBlock) {
						planBlock.html(lekcja[0]);
					}
				//$('#sdiv11').html(lekcja[0]);	

			  } 
			});
		}); 
}

function bazaAjax2(gkoniec){
	$(function ajax () 
		{
			$.ajax({  
			  async: false,
			  cache: false,
			  url: "./database/planajax.php",     
			  type: "POST",
			  data: {
					end_hour:gkoniec
			}, 
											  
			  success: function(data)
			  {
				  lekcja = data.split('-');
					Ajax = lekcja[1];
					//var end_hour = Ajax.toString();
					var planBlock = $('.planblock');
					if (planBlock) {
						planBlock.html(lekcja[0]);
					}
				// var countElements = document.getElementsByClassName("countblock");
				// [].forEach.call(countElements, function(element) {
				// 	element.innerHTML=rgodzina+":"+rminuta+":"+rsekunda;
				// });

			  } 
			});
		}); 
}

//===========================================================	
function odliczanie()
{

var dzisiaj = new Date();
var dzien = dzisiaj.getDate();
var dzienTygodnia = dzisiaj.getDay();
var miesiac = dzisiaj.getMonth()+1;
var rok = dzisiaj.getFullYear();
var godzina = dzisiaj.getHours();
var minuta = dzisiaj.getMinutes();
var sekunda = dzisiaj.getSeconds();

if(godzina<=0 && minuta<=0 && sekunda<=0)
{
			  //tylko o północy
	stop =1;
	newAjax();
	losowanieAjax(); 
}
if(Ajax=='23:59:59')   // korekta na potrzeby odliczania
	Ajax='24:00:00';

var gkoniec = Ajax.toString();
var czesci = gkoniec.split(':');

var aktualna = new Date(rok,miesiac,dzien,godzina,minuta,sekunda);
var koncowa = new Date(rok,miesiac,dzien,czesci[0],czesci[1],czesci[2]);
var roznica = new Date();
roznica = koncowa - aktualna;

if(parseInt(roznica/1000)<=0) // zawsze, kiedy dzwonek i o północy
{
	var audio = new Audio('dzwonek.mp3');
	audio.play();
}

if(parseInt(roznica/1000)<=0||parseInt(roznica/1000)==86400) // zawsze, kiedy dzwonek i o północy
{
	bazaAjax2(gkoniec);
}


 var rgodzina = parseInt(roznica/3600000);        // z milisekund na godz, min i sek
 var rminuta = parseInt((roznica%3600000)/60000);
 var rsekunda = parseInt(roznica%60000/1000);

	if(isNaN(rgodzina) && isNaN(rminuta) && isNaN(rsekunda)){
		bazaAjax();
		rgodzina = 0;
		rminuta = 0;
		rsekunda = 0;
	}
	
	
if(dzienTygodnia==1)
	dzienTygodnia="Poniedziałek";
if(dzienTygodnia==2)
	dzienTygodnia="Wtorek";
if(dzienTygodnia==3)
	dzienTygodnia="Środa";                       // dzień tygodnia
if(dzienTygodnia==4)
	dzienTygodnia="Czwartek";
if(dzienTygodnia==5)
	dzienTygodnia="Piątek";
if(dzienTygodnia==6)
	dzienTygodnia="Sobota";
if(dzienTygodnia==0)
	dzienTygodnia="Niedziela";

if(dzien<10)
	dzien="0"+dzien;
if(miesiac<10)
	miesiac="0"+miesiac;

if(sekunda<10)
	sekunda="0"+sekunda;
if(minuta<10)
	minuta="0"+minuta;                     // korekta numeracji
if(godzina<10)
	godzina="0"+godzina;

if(rsekunda<10)
	rsekunda="0"+rsekunda;
if(rminuta<10)
	rminuta="0"+rminuta;
if(rgodzina<10)
	rgodzina="0"+rgodzina;	

//document.getElementById("sdiv12").innerHTML=Ajax;
// var countElements = document.getElementsByClassName("countblock");
// [].forEach.call(countElements, function(element) {
// 	element.innerHTML=rgodzina+":"+rminuta+":"+rsekunda;
// });
var countBlock = $('.countblock');
if(countBlock) {
	countBlock.html(rgodzina+":"+rminuta+":"+rsekunda);
}
//[].forEach.call(els, function (el) {...});
var dateBlock = $('.dateblock');
if(dateBlock) {
	dateBlock.html(dzien+"."+miesiac+"."+rok+"</br>"+dzienTygodnia);
}
// var dateElements = document.getElementsByClassName("dateblock");
// [].forEach.call(dateElements, function(element) {
// 	element.innerHTML=dzien+"."+miesiac+"."+rok+"</br>"+dzienTygodnia;
// });

var clockBlock = $('.clockblock');
if (clockBlock) {
	clockBlock.html(godzina+":"+minuta+":"+sekunda);
}
// var clockElements = document.getElementsByClassName("clockblock");
// [].forEach.call(clockElements, function(element) {
// 	element.innerHTML=godzina+":"+minuta+":"+sekunda;
// });
//document.getElementsByClassName("clockblock")[0].innerHTML= godzina+":"+minuta+":"+sekunda;

setTimeout("odliczanie()",1000);
}

function playaudio(obj,audiofile) {
		obj.mp3 = new Audio(audiofile);
		obj.mp3.play();
	}      


