
(function(){
    var t;
    function size(animate){
        if (animate == undefined){
            animate = false;
        }
        clearTimeout(t);
        t = setTimeout(function(){
            $("canvas").each(function(i,el){
                $(el).attr({
                    "width":$(el).parent().width(),
                    "height":$(el).parent().outerHeight()
                });
            });
            redraw(animate);
            var m = 0;
            $(".chartJS").height("");
            $(".chartJS").each(function(i,el){ m = Math.max(m,$(el).height()); });
            $(".chartJS").height(m);
        }, 30);
    }
    $(window).on('resize', function(){ size(false); });


    function redraw(animation){
        var options = {};
        if (!animation){
            options.animation = false;
        } else {
            options.animation = true;
        }

        // var BarChart_BatchCollection = {
        //     labels : ["January","February","March","April","May","June","July","August","September","October","November","December"],
        //     datasets : [{
        //         fillColor : "#4EC9B4",
        //         strokeColor : "#4EC9B4",
        //         data : [1,2,3,4,5]
        //     }]
        // }
        // var myLine = new Chart(document.getElementById("BarChart_BatchCollection").getContext("2d")).Bar(BarChart_BatchCollection);

        var PieChart_ResourceAdmsn = [
            {
                value: 2,
                color:"#4EC9B4"
            },
            {
                value : 1,
                color : "#FF834D"
            },
            {
                value : 1,
                color : "#868BB8"
            },
            {
                value : 1,
                color : "#868BB8"
            }
        ]
        var myPie = new Chart(document.getElementById("PieChart_ResourceAdmsn").getContext("2d")).Pie(PieChart_ResourceAdmsn);

        var Linedata = {
            labels : ["January","February","March","April","May","June","July"],
            datasets : [
                {
                    fillColor : "#4EC9B4",
                    strokeColor : "#4EC9B4",
                    pointColor : "#4EC9B4",
                    pointStrokeColor : "#fff",
                    data : [150,119,190,281,156,55,140]
                },
                {
                    fillColor : "#81CDEA",
                    strokeColor : "#81CDEA",
                    pointColor : "#81CDEA",
                    pointStrokeColor : "#fff",
                    data : [165,59,90,181,56,155,40]
                },
                {
                    fillColor : "#ffea80",
                    strokeColor : "#ffea80",
                    pointColor : "#ffea80",
                    pointStrokeColor : "#fff",
                    data : [28,148,40,19,96,27,100]
                }

            ]
        }
        var myLineChart = new Chart(document.getElementById("line-chart-js").getContext("2d")).Line(Linedata);

        var donutData = [
            {
                value: 40,
                color:"#4EC9B4"
            },
            {
                value : 60,
                color : "#FF834D"
            },
            {
                value : 130,
                color : "#868BB8"
            },
            {
                value : 70,
                color : "#81CDEA"
            },
            {
                value : 80,
                color : "#ffd200"
            }

        ]
        var myDonut = new Chart(document.getElementById("donut-chart-js").getContext("2d")).Doughnut(donutData);
    }


    size(true);

}());
