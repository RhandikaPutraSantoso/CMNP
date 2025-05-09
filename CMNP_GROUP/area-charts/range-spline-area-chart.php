<?php include '../header.php'; ?>
<?php include '../sidebar.php'; ?>
<?php include '../content.php'; ?>

<h1>Range Spline Area Chart</h1>
<div id="chartContainer"></div>

<?php
    $dataPoints = array(
        array("x" => 1451586600000 , "y" => array(30.840000, 27.480000)),
        array("x" => 1454265000000 , "y" => array(29.610001, 27.100000)),
        array("x" => 1456770600000 , "y" => array(32.049999, 29.309999)),
        array("x" => 1459449000000 , "y" => array(32.020000, 30.309999)),
        array("x" => 1462041000000 , "y" => array(30.990000, 29.059999)),
        array("x" => 1464719400000 , "y" => array(31.500000, 29.170000)),
        array("x" => 1467311400000 , "y" => array(33.000000, 31.080000)),
        array("x" => 1469989800000 , "y" => array(31.570000, 31.000000)),
        array("x" => 1472668200000 , "y" => array(31.450001, 29.400000)),
        array("x" => 1475260200000 , "y" => array(29.750000, 28.330000)),
        array("x" => 1477938600000 , "y" => array(31.490000, 28.190001)),
        array("x" => 1480530600000 , "y" => array(32.380001, 30.620001))
    );
?>

<script>
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title:{
                text: "General Electric Stock Price"
            },
            subtitles: [{
                text: "High and Low Prices - 2016"
            }],
            axisX: {
                valueFormatString: "MMM",
                intervalType: "month",
                interval: 1
            },
            axisY: {
                title: "Stock Price (in USD)",
                prefix: "$"
            },
            data: [{
                type: "rangeSplineArea",
                xValueType: "dateTime",
                xValueFormatString: "MMMM",
                yValueFormatString: "$#,##0.00",
                toolTipContent: "{x}<br><b>High:</b> {y[0]}<br><b>Low:</b> {y[0]}",
                dataPoints: <?php echo json_encode($dataPoints); ?>
            }]
        });
        
        chart.render();
    }
</script>

<?php include '../footer.php'; ?>