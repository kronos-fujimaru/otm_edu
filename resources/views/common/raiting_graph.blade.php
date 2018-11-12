<script>
$(function(){

    (function(){
        if($("#data-raiting") != null){
             var myRaitingSet = [
                 $("#data-raiting").data('my-skill-a'),
                 $("#data-raiting").data('my-skill-b'),
                 $("#data-raiting").data('my-skill-c'),
                 $("#data-raiting").data('my-skill-d'),
                 $("#data-raiting").data('my-skill-e'),
                 $("#data-raiting").data('my-skill-f')
             ];

             var data = {
                 labels: ["技術1", "技術2", "技術3", "積極性", "徹底性", "誠実さ"],
                 datasets: [
                     {
                         label: "MyScore",
                         fillColor: "rgba(151,187,205,0.2)",
                         strokeColor: "rgba(151,187,205,1)",
                         pointColor: "rgba(151,187,205,1)",
                         pointStrokeColor: "#fff",
                         pointHighlightFill: "#fff",
                         pointHighlightStroke: "rgba(151,187,205,1)",
                         data: myRaitingSet
                     },
                     {
                         label: "MyScore",
                         fillColor: "rgba(0,0,0,0)",
                         strokeColor: "rgba(0,0,0,0)",
                         pointColor: "rgba(0,0,0,0)",
                         data: [4,4,4,4,4,4]
                     }

                 ]
             };
             var myRadarChart = new Chart(document.getElementById("glaph-raiting").getContext("2d")).Radar(data);
        }
    })();
});
</script>
