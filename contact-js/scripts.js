/*
Creating an HTML5 enhanced responsive-ready contact form, with custom javascript feature detection
www.toddmotto.com
*/
(function() {

	// Create input element for testing
	var inputs = document.createElement('input');
	
	// Create the supports object
	var supports = {};
	
	supports.autofocus   = 'autofocus' in inputs;
	supports.required    = 'required' in inputs;
	supports.placeholder = 'placeholder' in inputs;

	// Fallback for autofocus attribute
	if(!supports.autofocus) {
		
	}
	
	// Fallback for required attribute
	if(!supports.required) {
		
	}

	// Fallback for placeholder attribute
	if(!supports.placeholder) {
		
	}
	
	// Change text inside send button on submit



	var send = document.getElementById('contact-submit');
	if(send) {
		send.onclick = function () {

			this.innerHTML = '...Creating Email';
			
			var d=new Date();
    		var timestamp = d.toLocaleString();
			
			var Firstname = document.getElementById('Firstname1').value;
			var Lastname = 	document.getElementById('Lastname2').value;
			var homeCountry = document.getElementById('Homecountry3').value;
			var GrowInYourWalkWithTheLord = document.querySelector('input[name = "GrowInYourWalkWithTheLord"]:checked').value;
			Message = document.getElementById('Message5').value;
			
			var Locale = document.getElementById('locale').innerHTML;
			var EmailTop = document.getElementById('emailtop').innerHTML; 
  			
  			//note: I changed Firstname= text to Firstname: - so it will work in chrome browser passing to gmail mail app - quirk with having = in mailto string
			var fullBody = EmailTop + encodeURIComponent('\r\n\r\n') + 'Firstname: ' + Firstname + encodeURIComponent('\r\n') + 'Lastname: ' + Lastname + encodeURIComponent('\r\n') + 
			'homeCountry: ' + homeCountry + encodeURIComponent('\r\n') + 'GrowInYourWalkWithTheLord: ' + GrowInYourWalkWithTheLord + encodeURIComponent('\r\n') + 
			'Message: ' + Message + encodeURIComponent('\r\n') + 'Language: ' + Locale + encodeURIComponent('\r\n') + 'Form Submit Date:' + timestamp + encodeURIComponent('\r\n') + 'EventId:WYD2016';


			//Needed to have a fake click event here from a hidden anchor to make this work in Android - since 
			//android requires a mobile touch event to launch an app like email client app
    		var link = document.createElement('a');
			link.setAttribute('href', 'mailto:fullycharged@cru.org?subject=Follow-up from Fully Charged&body=' + fullBody );
			link.innerHTML = "Send email";
			document.body.appendChild(link);
			link.click();
			
			//had to add this timer to get it to work in safari mobile browser - needs a timer delay
			var testTimerID;
			
			testTimerID = window.setTimeout(autoDirect, 30*250 );

			function autoDirect() {
  				window.location = 'http://FULLYcharged.lan/index.html';
  				
			}


		}

  

	}		


})();
