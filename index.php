<?php
    if ((isset($_POST['Submit'])) && $_POST['Submit'] == 'Enviar')
    {
        if ((isset($_POST['bill']))) {
            if (is_numeric($_POST['bill'])) {
                if ($_POST['bill'] > 0) {
                    $bill = $_POST['bill'];
                }
            }
        }

        if ((isset($_POST['percentage']))) {
            if (is_numeric($_POST['percentage'])) {
                if ($_POST['percentage'] > 0) {
                    $percentage = $_POST['percentage'];
                }
            }
        }

        if ((isset($_POST['custom-percentage']))) {
            if (is_numeric($_POST['custom-percentage'])) {
                if ($_POST['custom-percentage'] <= 100) {
                    $custompercentage = $_POST['custom-percentage'];
                }
            }
        }

        if ((isset($_POST['customers']))) {
            if (is_numeric($_POST['customers'])) {
                $customers = $_POST['customers'];
            }
        }

        if (isset($bill) && isset($percentage)) {
            $tip = ($bill * $percentage) / 100;
            $total = $bill + $tip;
        }

        if (isset($bill) && isset($custompercentage)) {
            $tip = ($bill * $custompercentage) / 100;
            $total = $bill + $tip;
        }

        if (isset($customers) && isset($tip) && isset($total)) {
            $tipC = $tip / $customers;
            $totalC = $total / $customers;
        }
    }
?>

<html>
    <head>
        <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha256-/SIrNqv8h6QGKDuNoLGA4iret+kyesCkHGzVUUV0shc=" crossorigin="anonymous"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <link rel="stylesheet" href="styles.css" crossorigin="anonymous">

        <title>Tip Calculator</title>
    </head>


    <body bgcolor="#375CFF" class="container">

        <div class="row">
            <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-6 col-lg-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h2 align="center">
                            Tip Calculator
                        </h2>
                    </div>

                    <div class="panel-body">
                        <form action="index.php" method="POST" style="margin-left:0 auto">
                            <div class="form-group">
                                <label>Bill subtotal:</label>
                                <div class="input-group">
                                  <div class="input-group-addon">$</div>
                                  <input type="text" class="form-control" id="bill" name="bill" value="<?php echo isset($bill) ? $bill : 0 ?>">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-xs-12">
                                    <label>Tip percentage</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php for ($i = 10; $i <= 20; $i = $i + 5): ?>
                                    <label class="radio-inline">
                                      <input <?php echo isset($percentage) && !isset($custompercentage) && $percentage == $i ? 'checked="checked"' : '' ?> type="radio" name="percentage" id="percentage<?php echo (($i / 5) - 1) ?>" value="<?php echo $i ?>"> <?php echo $i ?>%
                                    </label>
                                <?php endfor ?>
                            </div>

                            <div class="form-group">
                                <label>Custom Tip Percentage:</label>
                                <div class="input-group">
                                  <div class="input-group-addon">%</div>
                                  <input type="text" class="form-control" id="custom-percentage" name="custom-percentage" placeholder="0" <?php echo isset($custompercentage) ? 'value="' . $custompercentage . '"' : '' ?>>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Number of Customer:</label>
                                <div class="input-group">
                                  <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                  <input type="text" id="customers" class="form-control" name="customers" placeholder="0" <?php echo isset($customers) ? 'value="' . $customers . '"' : '' ?>>
                                </div>
                            </div>

                            <input class="btn btn-success" type="submit" name="Submit" value="Enviar">
                        </form>
                    </div>

                    <?php if (isset($tip) && isset($total)) { ?>
                        <div class="panel panel-default result">
                          <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <b>Tip: </b>
                                    $<?php echo  number_format($tip,2,".",",") ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <b>Total: </b>
                                    $<?php echo number_format($total,2,".",",") ?>
                                </div>
                            </div>

                            <?php if (isset($customers)): ?>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <b>Tip/Person: </b>
                                        $<?php echo number_format($tipC,2,".",",") ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <b>Total/Person: </b>
                                        $<?php echo number_format($totalC,2,".",",") ?>
                                    </div>
                                </div>
                            <?php endif ?>
                          </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

    </body>
</html>