<?php
require_once '../includes/db.php';

$answers = $_POST['answers'];

$idQuestion = 0;
$nameAnswer = 0;
$count = 0;
$sql = "SELECT rightAnswer FROM Answers WHERE (nameAnswer = '$nameAnswer' AND idQuestion = $idQuestion)";

for($i = 0; $i <= count($answers); $i++){
    $idQuestion = $i++;
    $nameAnswer = $answers[$i++];
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) != 0){
        $count++;
    }
}

if($count < 1)
    echo json_encode(['Error' => 'Вы не правильно ответили на вопросы', '1' => count($count)]);
else{
    $sql = 'SELECT promoKode FROM PromoKodes';
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_row($result);
    echo json_encode($result[0], JSON_UNESCAPED_UNICODE);
}

mysqli_close($conn);