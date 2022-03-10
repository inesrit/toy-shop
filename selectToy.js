//js to add functionality to order toys page 
  window.addEventListener('load', function() {
    'use strict';
    //alert("Hi");
	
	//create variables
		let l_total =  0;
    let l_delivery = 0;
	let l_form = document.getElementById('orderForm');
		
		//change terms and condition color and boldness if checked or not
		const _selector = document.querySelector('input[name=termsChkbx]');
		_selector.addEventListener('change',function (event){
			if (_selector.checked){
		    document.getElementById("termsText").style.fontWeight = "normal";
			_selector.parentNode.style.color='black';
			} else {
			document.getElementById("termsText").style.fontWeight = "bold";
		    _selector.parentNode.style.color='red';
			}
		});
		
		
	l_form.addEventListener("change", calculateTotal);
	l_form.submit.addEventListener("click", checkForm);

	//function to calculate total
    function calculateTotal() {
	l_total = 0;
	
	//see what toy is checked and add to total variable
	const l_adverts = l_form.querySelectorAll('div.item');
        const l_advertsCount = l_adverts.length;
		for (let t_i = 0; t_i < l_adverts.length; t_i++) {
            const t_advert = l_adverts[t_i];
			const t_checkbox = t_advert.querySelector('input[data-price][type=checkbox]');
			if (t_checkbox.checked){
				l_total+=parseFloat(t_checkbox.dataset.price);
			}
        }//for
		
		// see which collection option is checked and add to collection variable
		const l_collection =l_form.querySelector('input[data-price][value=home]');
			if (l_collection.checked){
				l_delivery=parseFloat(l_collection.dataset.price);
			}else{
				 l_delivery = 0;
			}
		  
				// add collection price and total to grand total
				let grand_total=l_total+l_delivery;
				grand_total=grand_total.toFixed(2);
				l_form.total.value = grand_total;
				
			//check if terms and conditions box is checked, forename and surname is not empty, and total is above zero to enable submit button
		   if (_selector.checked && grand_total>0 && l_form.forename.value!=='' && l_form.surname.value!=='' ){
			 l_form.submit.disabled=false;
		   }else{
			l_form.submit.disabled=true;  	
		   }
   
	}

	// H validation
    function checkForm(_evt){
		alert("checking form");
		_evt.preventDefault();
    } //checkForm()
	
});