<?php
require_once 'includes/db.php';

//$sql = 'SELECT Avatar, firstName, lastName, nameCommand
//        from Players
//        inner join Commands on Commands.idCommand = Players.idCommand';
//
//$result = mysqli_query($conn, $sql);
//
//echo $result;
//
//function answerQuestions(array $alist, array $contact){
//
//    $count = mysqli_query($conn, "SELECT * FROM Answers WHERE nameAnswer = '$alist[0]' and rightAnswer=TRUE");
//
//    if(mysqli_num_rows($count) == 0){
//        return "Вы ответиили не правильно";
//    } else {
//        mysqli_query($conn, "INSERT INTO RecipientsPromoKodes(fio, phone_number, email, idPromoCode) VALUES ($contact[fio], $contact[phone_number], $contact[email], 1)");
//
//        $kode = mysqli_query($conn, "SELECT promoKode FROM PromoKodes inner join RecipientsPromoKodes on idPromoCode = PromoKodes.idPromoKode WHERE fio = '$contact[fio]' AND phone_number = '$contact[phone_number]' AND email = '$contact[email]'");
//
//        return $kode;
//    }
//}
//
//function getCommand($idCommand){
//    require_once 'includes/db.php';
//
//    $res = mysqli_query($conn, "select firstName, lastName, type, nameCommand, Avatar from Players
//                                        inner join Commands on Commands.idCommand = Players.idCommand
//                                        inner join TypesPlayers on TypesPlayers.idType = Players.idType
//                                        where Players.idCommand = $idCommand");
//
//    return $res;
//}