const urlBase = 'http://cop4331team21.site/LAMPAPI';
const extension = 'php';

let contactId = 0;

function searchContacts()
{
	let srch = document.getElementById("searchbox").value;
	document.getElementById("searchResult").innerHTML = "";
	
	let contactsList = "";
	// var table = document.getElementById("myTable");

	let tmp = {search:srch,contactId:contactId};
	let jsonPayload = JSON.stringify( tmp );

	let url = urlBase + '/SearchContact.' + extension;
	
	let xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				document.getElementById("searchResult").innerHTML = "Search Initiated";
				let jsonObject = JSON.parse( xhr.responseText );
				
				for( let i=0; i<jsonObject.results.length; i++ )
				{
					contactsList += jsonObject.results[i];
					if( i < jsonObject.results.length - 1 )
					{
						contactsList += "<br />\r\n";
					}
				}
				
				document.getElementById("contacts_table").innerHTML = contactsList;
			}
		};
		xhr.send(jsonPayload);
	}
	catch(err)
	{
		document.getElementById("searchResult").innerHTML = err.message;
	}
	
}