<script type="text/javascript">
		
		document.getElementById("sestate").addEventListener("change", select12);
		
		
		function select12()
		{
		//reset municipality select to 0 every time estate is changed
		document.getElementById("smunic").selectedIndex=0;
		document.getElementById("scity").selectedIndex=0;
		//hide when selection has not been made
		var n=document.getElementById("smunic");
		var d=n.getElementsByTagName("option");
		let y;
			for (y = 0; y < d.length; y++)
				{
				d[y].style.display = 'none';
				console.log(d[y]);
				}
		
		let i=document.getElementById("scity");
		let j=i.getElementsByTagName("option");
		let k;
			for (k = 0; k < j.length; k++)
				{
				j[k].style.display = 'none';
				console.log(j[k]);
				}		
		
				
				
				
				
		//display when selection has been made on estate
		var e=document.getElementById("sestate").value;
		//console.log(e);
		let c="e"+e;
		//console.log(c);
		
		
		let a=document.getElementsByClassName(c);
		let x;
		
			for (x = 0; x < a.length; x++)
				{
				a[x].style.display = 'block';
				//console.log(a[x]);
				}
		}		
				
		//Select municipality
		document.getElementById("smunic").addEventListener("change", select2);
		
		
		function select2()
		{
		//reset city select to 0 every time estate is changed
		document.getElementById("scity").selectedIndex=0;
		//hide when selection has not been made
		let p=document.getElementById("scity");
		let z=p.getElementsByTagName("option");
		let q;
			for (q = 0; q < z.length; q++)
				{
				z[q].style.display = 'none';
				//console.log(z[q]);
				}
				
		//display when selection has been made on estate
		var h=document.getElementById("smunic").value;
		//console.log(h);
		let c="m"+h;
		//console.log(c);
		
		
		let a=document.getElementsByClassName(c);
		let x;
		
			for (x = 0; x < a.length; x++)
				{
				a[x].style.display = 'block';
				//console.log(a[x]);
				}
				
		
		}
		
		
	
	</script>