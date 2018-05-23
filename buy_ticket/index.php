<?php

require_once '../includes/db.php';

$fio = $_POST['fio'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$promo_kod = $_POST['promo_kod'];

if(!trim($promo_kod) == '')
{
    $id_promo_kod = mysqli_query($conn, "SELECT idPromoKode FROM PromoKodes WHERE promoKode = '$promo_kod'");

    $id_promo_kod = mysqli_fetch_row($id_promo_kod)[0];
} else{
    $id_promo_kod = 0;
}

if($id_promo_kod == 0)
    echo json_encode(['text' => 'Не верный промо-код'], JSON_UNESCAPED_UNICODE);
else
{
    $sql = "INSERT INTO RecipientsPromoKodes(fio, phone_number, email, idPromoCode) VALUES ('$fio', '$phone_number', '$email', '$id_promo_kod')";

    $result = mysqli_query($conn, $sql);
    echo json_encode(['text' => 'Ждите ответа'], JSON_UNESCAPED_UNICODE);
}

mysqli_close($conn);