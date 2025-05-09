<?php include '../header.php'; ?>
<?php include '../sidebar.php'; ?>
<?php include '../content.php'; ?>

<h1>Stacked Area Chart</h1>
<div id="chartContainer"></div>

<?php
    $dataPoints1 = array(
        array("label"=> "2007", "y"=> 2016456 ),
        array("label"=> "2008", "y"=> 1985801 ),
        array("label"=> "2009", "y"=> 1755904 ),
        array("label"=> "2010", "y"=> 1847290 ),
        array("label"=> "2011", "y"=> 1733430 ),
        array("label"=> "2012", "y"=> 1514043 ),
        array("label"=> "2013", "y"=> 1581115 ),
        array("label"=> "2014", "y"=> 1581710 ),
        array("label"=> "2015", "y"=> 1352398 ),
        array("label"=> "2016", "y"=> 1239149 )
    );
    
    $dataPoints2 = array(
        array("label"=> "2007", "y"=> 49505 ),
        array("label"=> "2008", "y"=> 31917 ),
        array("label"=> "2009", "y"=> 25972 ),
        array("label"=> "2010", "y"=> 23337 ),
        array("label"=> "2011", "y"=> 16086 ),
        array("label"=> "2012", "y"=> 13403 ),
        array("label"=> "2013", "y"=> 13820 ),
        array("label"=> "2014", "y"=> 18276 ),
        array("label"=> "2015", "y"=> 17372 ),
        array("label"=> "2016", "y"=> 13008 )
    );
    
    $dataPoints3 = array(
        array("label"=> "2007", "y"=> 896590 ),
        array("label"=> "2008", "y"=> 882981 ),
        array("label"=> "2009", "y"=> 920979 ),
        array("label"=> "2010", "y"=> 987697 ),
        array("label"=> "2011", "y"=> 1013689 ),
        array("label"=> "2012", "y"=> 1225894 ),
        array("label"=> "2013", "y"=> 1124836 ),
        array("label"=> "2014", "y"=> 1126609 ),
        array("label"=> "2015", "y"=> 1333482 ),
        array("label"=> "2016", "y"=> 1378307 )
    );
    
    $dataPoints4 = array(
        array("label"=> "2007", "y"=> 806425 ),
        array("label"=> "2008", "y"=> 806208 ),
        array("label"=> "2009", "y"=> 798855 ),
        array("label"=> "2010", "y"=> 806968 ),
        array("label"=> "2011", "y"=> 790204 ),
        array("label"=> "2012", "y"=> 769331 ),
        array("label"=> "2013", "y"=> 789016 ),
        array("label"=> "2014", "y"=> 797166 ),
        array("label"=> "2015", "y"=> 797178 ),
        array("label"=> "2016", "y"=> 805694 )
    );
    
    $dataPoints5 = array(
        array("label"=> "2007", "y"=> 247510 ),
        array("label"=> "2008", "y"=> 254831 ),
        array("label"=> "2009", "y"=> 273445 ),
        array("label"=> "2010", "y"=> 260203 ),
        array("label"=> "2011", "y"=> 319355 ),
        array("label"=> "2012", "y"=> 276240 ),
        array("label"=> "2013", "y"=> 268565 ),
        array("label"=> "2014", "y"=> 259367 ),
        array("label"=> "2015", "y"=> 249080 ),
        array("label"=> "2016", "y"=> 267812 )
    );
    
    $dataPoints6 = array(
        array("label"=> "2007", "y"=> 612 ),
        array("label"=> "2008", "y"=> 864 ),
        array("label"=> "2009", "y"=> 891 ),
        array("label"=> "2010", "y"=> 1212 ),
        array("label"=> "2011", "y"=> 1818 ),
        array("label"=> "2012", "y"=> 4327 ),
        array("label"=> "2013", "y"=> 9036 ),
        array("label"=> "2014", "y"=> 17691 ),
        array("label"=> "2015", "y"=> 24893 ),
        array("label"=> "2016", "y"=> 36054 )
    );
?>
<script>
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", { 
            theme: "light2",
            title: {
                text: "Generation of Electricity in US - 2007 to 2016"
            },
            subtitles: [{
                text: "In Gigawatt Hours"
            }],
            legend:{
                cursor: "pointer",
                itemclick: toggleDataSeries
            },
            toolTip: {
                shared: true
            },
            data: [{
                type: "stackedArea",
                name: "Coal",
                showInLegend: true,
                visible: false,
                yValueFormatString: "#,##0 GWh",
                dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
            },
            {
                type: "stackedArea",
                name: "Petroleum",
                showInLegend: true,
                yValueFormatString: "#,##0 GWh",
                dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
            },
            {
                type: "stackedArea",
                name: "Natual Gas",
                showInLegend: true,
                visible: false,
                yValueFormatString: "#,##0 GWh",
                dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
            },
            {
                type: "stackedArea",
                name: "Nuclear",
                showInLegend: true,
                visible: false,
                yValueFormatString: "#,##0 GWh",
                dataPoints: <?php echo json_encode($dataPoints4, JSON_NUMERIC_CHECK); ?>
            },
            {
                type: "stackedArea",
                name: "Hydroelectric",
                showInLegend: true,
                visible: false,
                yValueFormatString: "#,##0 GWh",
                dataPoints: <?php echo json_encode($dataPoints5, JSON_NUMERIC_CHECK); ?>
            },
            {
                type: "stackedArea",
                name: "Solar",
                showInLegend: true,
                yValueFormatString: "#,##0 GWh",
                dataPoints: <?php echo json_encode($dataPoints6, JSON_NUMERIC_CHECK); ?>
            }]
        });
        
        chart.render();
        
        function toggleDataSeries(e){
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            }
            else{
                e.dataSeries.visible = true;
            }
            chart.render();
        }
    }
</script>

<?php include '../footer.php'; ?>