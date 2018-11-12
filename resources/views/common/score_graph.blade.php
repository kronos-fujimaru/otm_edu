<script>
(function(){
    $.getJSON("{{$apiUrl}}",
        function(scoreInfo){
            var data = {
                  labels: scoreInfo.dates,
                  datasets: [
                      {
                          label: "平均点",
                          fillColor: "rgba(220,220,220,0.2)",
                          strokeColor: "rgba(220,220,220,1)",
                          pointColor: "rgba(220,220,220,1)",
                          pointStrokeColor: "#fff",
                          pointHighlightFill: "#fff",
                          pointHighlightStroke: "rgba(220,220,220,1)",
                          data: scoreInfo.avgs
                      },
                      {
                          label: "点数",
                          fillColor: "rgba(151,187,205,0.2)",
                          strokeColor: "rgba(151,187,205,1)",
                          pointColor: "rgba(151,187,205,1)",
                          pointStrokeColor: "#fff",
                          pointHighlightFill: "#fff",
                          pointHighlightStroke: "rgba(151,187,205,1)",
                          data: scoreInfo.points
                      }
                  ]
              };
            var options = {
                bezierCurve : false,
                scaleOverride : true,
                scaleSteps : 10,
                scaleStepWidth : 10,
                scaleStartValue : 0,
                legendTemplate :
               "<ul class=\"<%=name.toLowerCase()%>-legend\">"
               + "<% for (var i=0; i<datasets.length; i++){%>"
               + "<li><span style=\"background-color:<%=datasets[i].pointColor%>\">&nbsp;&nbsp;&nbsp;</span>" + "<%if(datasets[i].label){%><%=datasets[i].label%><%}%></li>"
               + "<%}%></ul>"
            };
            var graph = new Chart(document.getElementById("glaph-score")
                                 .getContext("2d")).Line(data, options);
            $('#glaph-score-label').html(graph.generateLegend());
        }
   );
})();

</script>
