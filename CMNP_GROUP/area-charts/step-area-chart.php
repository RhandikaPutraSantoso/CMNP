<?php include '../header.php'; ?>
<?php include '../sidebar.php'; ?>
<?php include '../content.php'; ?>

<h1>Step Area Chart</h1>
<div id="chartContainer"></div>

<?php
    $dataPoints = array(
        array("x" => 1167589800000 , "y" => 49505),
        array("x" => 1199125800000 , "y" => 31917),
        array("x" => 1230748200000 , "y" => 25972),
        array("x" => 1262284200000 , "y" => 23337),
        array("x" => 1293820200000 , "y" => 16086),
        array("x" => 1325356200000 , "y" => 13403),
        array("x" => 1356978600000 , "y" => 13820),
        array("x" => 1388514600000 , "y" => 18276),
        array("x" => 1420050600000 , "y" => 17372),
        array("x" => 1451586600000 , "y" => 13008)
    );
?>

<script>
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title:{
                text: "Net Energy Generation from Petroleum"
            },
            subtitles: [{
                text: "2007 - 2016"
            }],
            axisY: {
                title: "Generation (In Gigawatt Hour)",
                suffix: " GWh"
            },
            data: [{
                type: "stepArea",
                xValueType: "dateTime",
                xValueFormatString: "YYYY",
                yValueFormatString: "#,##0 GWh",
                dataPoints: <?php echo json_encode($dataPoints); ?>
            }]
        });

        chart.render();
    }
</script> 

<?php include '../footer.php'; ?>