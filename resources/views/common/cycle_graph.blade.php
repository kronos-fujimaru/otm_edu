<script>
   (function(){
       $.getJSON("{{$apiUrl}}", function(cycleInfo){
           var data = {
               labels: cycleInfo.dates,
               datasets: [
                   {
                       label: "体調",
                       fillColor: "rgba(220,220,220,0.2)",
                       strokeColor: "rgba(220,220,220,1)",
                       pointColor: "rgba(220,220,220,1)",
                       pointStrokeColor: "#fff",
                       pointHighlightFill: "#fff",
                       pointHighlightStroke: "rgba(220,220,220,1)",
                       data: cycleInfo.conditions
                   },
                   {
                       label: "モチベーション",
                       fillColor: "rgba(151,187,205,0.2)",
                       strokeColor: "rgba(151,187,205,1)",
                       pointColor: "rgba(151,187,205,1)",
                       pointStrokeColor: "#fff",
                       pointHighlightFill: "#fff",
                       pointHighlightStroke: "rgba(151,187,205,1)",
                       data: cycleInfo.motivations
                   }
               ]
           };

           var options = {
               bezierCurve : true,
               scaleOverride : true,
               scaleSteps : 3,
               scaleStepWidth : 1,
               scaleStartValue : 1,
               legendTemplate :
              "<ul class=\"<%=name.toLowerCase()%>-legend\">"
              + "<% for (var i=0; i<datasets.length; i++){%>"
              + "<li><span style=\"background-color:<%=datasets[i].pointColor%>\">&nbsp;&nbsp;&nbsp;</span>" + "<%if(datasets[i].label){%><%=datasets[i].label%><%}%></li>"
              + "<%}%></ul>"
           };

           var graph = new Chart(document.getElementById("glaph-cycle").getContext("2d")).Line(data, options);
           $('#glaph-cycle-label').html(graph.generateLegend());
       });
   })();
</script>
