
function crvenaBoja(){

	document.getElementById('name').style.color = "red";
	document.getElementById('addr').style.color = "red";
	document.getElementById('cityy').style.color = "red";
	document.getElementById('State').style.color = "red";
	document.getElementById('tPhone').style.color = "red";
	document.getElementById('Email').style.color = "red";
	document.getElementById('confEmail').style.color = "red";
	
	Inicijalni.style.color = "red";
	Inicijalni.innerHTML = "<h3>Please enter your information below !</h3>";				
	document.getElementById("submit").disabled = true;

}

function provera(){
	podaci = new Array();

	var imePrezime = document.getElementById('fullname');
	var imePrezimeSpan = document.getElementById('name');
	var regImePrezime = /^[A-Z][a-z]{0,}\s[A-Z][a-z]{0,}$/;

	if (!regImePrezime.test(imePrezime.value)) {
		imePrezimeSpan.style.color = "red";

	} else {
		imePrezimeSpan.style.color = "yellow";
		podaci.push(imePrezime.value);
	}
		

	var adresa = document.getElementById('address');
	var adresaSpan = document.getElementById('addr');
	var regAdresa = /^([A-Z](\w+\s?))+\s(\d+)$/;

	if (!regAdresa.test(adresa.value)) {
		adresaSpan.style.color = "red";

	} else {
		adresaSpan.style.color = "yellow";
		podaci.push(adresa.value);
	}
				

				
	var grad = document.getElementById('city');
	var gradSpan = document.getElementById('cityy');
	var regGrad = /^([A-Z][a-z]{0,}\s?)+$/;
				
	if (!regGrad.test(grad.value)) {
		gradSpan.style.color = "red";

	} else {
		gradSpan.style.color = "yellow";
		podaci.push(grad.value);
	}
			

	var phone = document.getElementById('phone');
	var phoneSpan = document.getElementById('tPhone');
	var regPhone = /^\+(381)(6)[\d]{6,}$/;

	if (!regPhone.test(phone.value)) {
		phoneSpan.style.color = "red";

	} else {
		phoneSpan.style.color = "yellow";
		podaci.push(phone.value);
	}
				

			
	var email = document.getElementById('email');
	var emailSpan = document.getElementById('Email');
	var regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

	if (!regEmail.test(email.value)) {
		emailSpan.style.color = "red";

	} else {
		emailSpan.style.color = "yellow";
	}

	var confemail = document.getElementById('confemail');
	var confemailSpan = document.getElementById('confEmail');

	if (confemail.value != email.value) {
		confemailSpan.style.color = "red";

	} else if (email.value == "") {
		confemailSpan.style.color = "red";

	} else {
		confemailSpan.style.color = "yellow";
		podaci.push(confemail.value);
	}
				

	var state = document.getElementById('state');
	var stateSpan = document.getElementById('State');

	if (state.value == "0") {
		stateSpan.style.color = "red";

	} else {
		stateSpan.style.color = "yellow";
		podaci.push(state.value);
	}

	if (podaci.length == 6) {
		Inicijalni.innerHTML = "";
		document.getElementById("submit").disabled = false;
					
		return true;
					
	} else {
		return false;
	}
}
   

function submitData(){

    if (provera = true){
    	// ako je provera uspesna salji na sopstveni mejl
	    var sendData = "mailto:toma.joksimovic@gmail.com?subject=SignupData&body=Name: "+ podaci[0] +"%0D%0A"+
	    "Address: "+ podaci[1] +"%0D%0A"+
	    'City: '+ podaci[2] +"%0D%0A"+
	    'Phone: '+ podaci[3] +"%0D%0A"+
	    'Mail: '+ podaci[4] +"%0D%0A"+
	    'State: '+ podaci[5];

		window.location.href = sendData;

	    cookieName = podaci[0];
	    var cookieMail = podaci[4];
	    var cookiePhone = podaci[3];
	    var expireDate = new Date();
	    expireDate.setMonth(expireDate.getMonth() + 1);
	    document.cookie = "CookieName" +"="+cookieName +'&'+cookieMail+'&'+cookiePhone+"; expires=" + expireDate.toGMTString();  
    }
}
        

// funkcija proverava da li ima kolacica i ako ima prikazuje podatke iz kolacica u formi
function cookie(){
    if (document.cookie == ''){
    } else {
		var niz = document.cookie.split(';');

		for (var i=0;i<niz.length;i++){
			var cookieName = niz[i].split(';')[0].split('=')[0];

			if (cookieName== "CookieName"){
				var valuesCookie = niz[i].split(';')[0].split('=')[1];
				var nameCookie = valuesCookie.split('&')[0];
				var mailCookie = valuesCookie.split('&')[1];
				var phoneCookie = valuesCookie.split('&')[2];

				Inicijalni.innerHTML = "";
				naslov.innerHTML = nameCookie + " je registrovan !";
				document.getElementById('fullname').value = nameCookie;
				document.getElementById('email').value = mailCookie;
				document.getElementById('phone').value = phoneCookie;
			};
		};
	};
};