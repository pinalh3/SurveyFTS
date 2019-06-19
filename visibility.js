	function busqueda ()
{
	var report=document.getElementById('b1');
	var action=document.getElementById('b2');
	if(report.checked)
	{
	
			
			document.getElementById("ac1").style.setProperty('visibility', 'visible');
			document.getElementById("ac2").style.setProperty('visibility', 'hidden');
			
				var i="";
					for (i=3;i<=6;i++)
					{
						document.getElementById("ac"+i).style.setProperty('visibility', 'hidden');
							
					}
			
			
	}
	else
	{
	document.getElementById("ac1").style.setProperty('visibility', 'hidden');
	
	
				
				if(action.checked)
				{
				document.getElementById("ac2").style.setProperty('visibility', 'visible');
				document.getElementById("ac1").style.setProperty('visibility', 'hidden');
				
				var i="";
					for (i=3;i<=6;i++)
					{
						
				      
				        document.getElementById("ac"+i).style.setProperty('visibility', 'hidden');
							
					}
				
				}
				else
				{
				document.getElementById("ac2").style.setProperty('visibility', 'hidden');
				
					var i="";
					for (i=3;i<=6;i++)
					{
						var getit=document.getElementById("b"+i);
				      
				      if (getit.checked)
							{
							document.getElementById("ac"+i).style.setProperty('visibility', 'visible');
							document.getElementById("ac1").style.setProperty('visibility', 'hidden');
							}
							else
							{
							document.getElementById("ac"+i).style.setProperty('visibility', 'hidden');
							
							}
					
					
					
					
							
					}
				}
			}
			
	
	
	
	
			
	
    
}


	document.getElementById("b1").addEventListener("change",busqueda);
	document.getElementById("b2").addEventListener("change",busqueda);
	document.getElementById("b3").addEventListener("change",busqueda);
	document.getElementById("b4").addEventListener("change",busqueda);
	document.getElementById("b5").addEventListener("change",busqueda);
	document.getElementById("b6").addEventListener("change",busqueda);
		