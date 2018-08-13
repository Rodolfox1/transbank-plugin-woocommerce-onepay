<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->

<?php
require(dirname(__FILE__, 6) .'/wp-blog-header.php');
    use Transbank\Onepay\Transaction;
    use Transbank\Onepay\OnepayBase;
    global $woocommerce, $order;

    OnepayBase::setSharedSecret("P4DCPS55QB2QLT56SQH6#W#LV76IAPYX");
    OnepayBase::setApiKey("mUc0GxYGor6X8u-_oB3e-HWJulRG01WoC96-_tUA3Bg");
    $externalUniqueNumber = $_POST['externalUniqueNumber'];
    $transactionCommitResponse = Transaction::commit($_POST['occ'], $externalUniqueNumber);

?>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
</head>
<body>
<table>
    <tr>
        <td>OCC:</td>
        <td><?php echo $transactionCommitResponse->getOcc() ?> </td>
    </tr>
    <tr>
        <td>Número de carro:</td>
        <td><?php echo $externalUniqueNumber ?> </td>
    </tr>
    <tr>
        <td>Código de autorización:</td>
        <td><?php echo  $transactionCommitResponse->getAuthorizationCode() ?></td>
    </tr>
    <tr>
        <td>Orden de compra:</td>
        <td><?php echo $transactionCommitResponse->getBuyOrder() ?></td>
    </tr>
    <tr>
        <td>Descripción:</td>
        <td> <?php echo $transactionCommitResponse->getDescription() ?></td>
    </tr>
    <tr>
        <td>Monto compra:</td>
        <td><?php echo $transactionCommitResponse->getAmount() ?></td>
    </tr>
    <tr>
        <td>Numero de cuotas:</td>
        <td><?php echo $transactionCommitResponse->getInstallmentsNumber() ?></td>
    </tr>
    <tr>
        <td>Monto cuota:</td>
        <td><?php echo $transactionCommitResponse->getInstallmentsAmount() ?></td>
    </tr>
    <tr>
        <td>Fecha:</td>
        <td> <?php echo $transactionCommitResponse->getIssuedAt() ?> </td>
    </tr>
    <tr>
        <td>Anulación</td>
        <td>
            <a href='/refund/?amount=<?php echo urlencode($transactionCommitResponse->getAmount())?>&occ=<?php echo urlencode($transactionCommitResponse->getOcc()) ?>&externalUniqueNumber=<?php echo urlencode($externalUniqueNumber)?>&authorizationCode=<?php echo urlencode($transactionCommitResponse->getAuthorizationCode())?>'
            >Anular esta compra</a>
        </td>
    </tr>
</table>
</body>
</html>
