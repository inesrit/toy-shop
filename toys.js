//js to showcase offers on homepage every 5 seconds
window.addEventListener('load', function () {
    "use strict";
	//get page where it will be displayed
    const URL = 'getOffers.php';
	
	//
const fetchData = function(){
	
    fetch(URL)
    .then(
        function (response) {
			if(response.status===200){
            return response.json();
			}else{
				throw new Error("Invalid response")
			}
        }
    )
    .then( 
		//add the json to the html page
        function(json) {
            document.getElementById("offers").innerHTML = "<h4>Toy name: "+json.toyName +"</h4>";
			document.getElementById("offers").innerHTML += "<p>Category: "+json.catDesc+"</p>";
			document.getElementById("offers").innerHTML += "<p>Price: "+json.toyPrice+"</p>";
			
        }
    )
    .catch(
        function (err) {
            console.log("Something went wrong!", err);
        }
    );
}
//display offers as soon as page loads
fetchData();

//change offers every 5 seconds
setInterval(fetchData, 5000);

});