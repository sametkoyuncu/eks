$(document).ready(function(){
	

	var data = [
		{
			value: 270,
			color: "cornflowerblue",
			highlight: "lightskyblue",
			label: "JavaScript"
		},
		{
			value: 50,
			color: "lightgreen",
			highlight: "yellowgreen",
			label: "HTML"
		},
		{
			value: 40,
			color: "orange",
			highlight: "darkorange",
			label: "CSS"
		}
	];
	var ctx = $("#mycanvas").get(0).getContext("2d");	
	var mychart = new Chart(ctx).Doughnut(data);
});