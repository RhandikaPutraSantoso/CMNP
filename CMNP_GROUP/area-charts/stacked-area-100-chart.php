<?php include '../header.php'; ?>
<?php include '../sidebar.php'; ?>
<?php include '../content.php'; ?>

<h1>Stacked Area 100% Chart</h1>
<div id="chartContainer"></div>

<?php
    $dataPoints1 = array(
        array("label"=> "2006", "y"=> 60.1),
        array("label"=> "2007", "y"=> 59.1),
        array("label"=> "2008", "y"=> 57.9),
        array("label"=> "2009", "y"=> 57.0),
        array("label"=> "2010", "y"=> 56.4),
        array("label"=> "2011", "y"=> 54.8),
        array("label"=> "2012", "y"=> 53.4),
        array("label"=> "2013", "y"=> 50.6),
        array("label"=> "2014", "y"=> 47.4),
        array("label"=> "2015", "y"=> 44.7),
        array("label"=> "2016", "y"=> 43.9)
    );
    
    $dataPoints2 = array(
        array("label"=> "2006", "y"=> 4.1),
        array("label"=> "2007", "y"=> 4.2),
        array("label"=> "2008", "y"=> 4.1),
        array("label"=> "2009", "y"=> 4.3),
        array("label"=> "2010", "y"=> 4.3),
        array("label"=> "2011", "y"=> 4.5),
        array("label"=> "2012", "y"=> 4.5),
        array("label"=> "2013", "y"=> 4.8),
        array("label"=> "2014", "y"=> 5.4),
        array("label"=> "2015", "y"=> 5.3),
        array("label"=> "2016", "y"=> 5.2)
    );
    
    $dataPoints3 = array(
        array("label"=> "2006", "y"=> 20.8),
        array("label"=> "2007", "y"=> 21.7),
        array("label"=> "2008", "y"=> 23.0),
        array("label"=> "2009", "y"=> 23.8),
        array("label"=> "2010", "y"=> 24.4),
        array("label"=> "2011", "y"=> 24.9),
        array("label"=> "2012", "y"=> 25.6),
        array("label"=> "2013", "y"=> 26.1),
        array("label"=> "2014", "y"=> 26.9),
        array("label"=> "2015", "y"=> 27.0),
        array("label"=> "2016", "y"=> 25.8)
    );
    
    $dataPoints4 = array(
        array("label"=> "2006", "y"=> 15.0),
        array("label"=> "2007", "y"=> 15.0),
        array("label"=> "2008", "y"=> 15.1),
        array("label"=> "2009", "y"=> 14.9),
        array("label"=> "2010", "y"=> 14.9),
        array("label"=> "2011", "y"=> 15.8),
        array("label"=> "2012", "y"=> 16.5),
        array("label"=> "2013", "y"=> 18.6),
        array("label"=> "2014", "y"=> 20.4),
        array("label"=> "2015", "y"=> 23.0),
        array("label"=> "2016", "y"=> 25.0)
    );
?>

<script>
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            title: {
                text: "Employement In the Beverage Industry"
            },
            axisY:{
                suffix: "%"
            },
            toolTip: {
                shared: true,
                reversed: true
            },
            legend:{
                cursor: "pointer",
                itemclick: toggleDataSeries
            },
            data: [
                {
                    type: "stackedArea100",
                    name: "Soft drink and Ice",
                    showInLegend: true,
                    yValueFormatString: "#0.0#\"%\"",
                    dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                },
                {
                    type: "stackedArea100",
                    name: "Distilleries",
                    showInLegend: true,
                    yValueFormatString: "#0.0#\"%\"",
                    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                },
                {
                    type: "stackedArea100",
                    name: "Wineries",
                    showInLegend: true,
                    yValueFormatString: "#0.0#\"%\"",
                    dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
                },
                {
                    type: "stackedArea100",
                    name: "Breweries",
                    showInLegend: true,
                    yValueFormatString: "#0.0#\"%\"",
                    dataPoints: <?php echo json_encode($dataPoints4, JSON_NUMERIC_CHECK); ?>
                }
            ]
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