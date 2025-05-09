<?php include '../header.php'; ?>
<?php include '../sidebar.php'; ?>
<?php include '../content.php'; ?>

<h1>Spline Area Chart</h1>
<div id="chartContainer"></div>

<?php
    $dataPoints = array(
        array("x" => 1483381800000 , "y" => 650),
        array("x" => 1483468200000 , "y" => 700),
        array("x" => 1483554600000 , "y" => 710),
        array("x" => 1483641000000 , "y" => 658),
        array("x" => 1483727400000 , "y" => 734),
        array("x" => 1483813800000 , "y" => 963),
        array("x" => 1483900200000 , "y" => 847),
        array("x" => 1483986600000 , "y" => 853),
        array("x" => 1484073000000 , "y" => 869),
        array("x" => 1484159400000 , "y" => 943),
        array("x" => 1484245800000 , "y" => 970),
        array("x" => 1484332200000 , "y" => 869),
        array("x" => 1484418600000 , "y" => 890),
        array("x" => 1484505000000 , "y" => 930)
    );
?>

<script>
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title:{
                text: "Site Traffic"
            },
            axisX: {
                valueFormatString: "DD MMM"
            },
            axisY: {
                title: "Total Number of Visits",
                includeZero: true,
                maximum: 1200
            },
            data: [{
                type: "splineArea",
                color: "#6599FF",
                xValueType: "dateTime",
                xValueFormatString: "DD MMM",
                yValueFormatString: "#,##0 Visits",
                dataPoints: <?php echo json_encode($dataPoints); ?>
            }]
        });

        chart.render();
    }
</script>

<?php include '../footer.php'; ?>