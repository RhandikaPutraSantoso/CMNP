<?php include '../header.php'; ?>
<?php include '../sidebar.php'; ?>
<?php include '../content.php'; ?>

<h1>Range Area Chart</h1>
<div id="chartContainer"></div>

<?php
    $dataPoints = array(
        array("x" => 1512441720000 , "y" => array(120, 78)),
        array("x" => 1512447240000 , "y" => array(147, 89)),
        array("x" => 1512453960000 , "y" => array(139, 85)),
        array("x" => 1512461700000 , "y" => array(160, 95)),
        array("x" => 1512466320000 , "y" => array(130, 84)),
        array("x" => 1512472020000 , "y" => array(138, 87)),
        array("x" => 1512475440000 , "y" => array(127, 78)),
        array("x" => 1512477540000 , "y" => array(119, 76)),
        array("x" => 1512482280000 , "y" => array(135, 82)),
        array("x" => 1512486900000 , "y" => array(122, 78)),
        array("x" => 1512490800000 , "y" => array(130, 82)),
        array("x" => 1512494160000 , "y" => array(122, 75))
    );
?>

<script>
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title:{
                text: "Blood Pressure Readings over a Day"
            },
            axisY: {
                title: "Pressure (in mmHg)",
                gridThickness: 0
            },
            data: [{
                type: "rangeArea",
                xValueType: "dateTime",
                xValueFormatString: "hh:MM TT",
                yValueFormatString: "#,##0 mmHg",
                toolTipContent: "{x}<br><b>Systolic:</b> {y[0]}<br><b>Diastolic:</b> {y[1]}",
                dataPoints: <?php echo json_encode($dataPoints); ?>
            }]
        });

        chart.render();
    }
</script>

<?php include '../footer.php'; ?>