<?php
require_once '../includes/db.php';

$sql = 'select Q.idQuestion, nameQuestion, idAnswer, nameAnswer from Answers
  inner join Questions Q on Answers.idQuestion = Q.idQuestion';

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0){
    echo json_encode(['Error' => 'Нет данных']);
}
else{
    $rows = [];
    while($row = mysqli_fetch_array($result))
    {
        $rows[] = $row;
    }

    echo json_encode($rows, JSON_UNESCAPED_UNICODE);
}

mysqli_close($conn);