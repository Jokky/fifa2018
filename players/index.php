<?php
require_once '../includes/db.php';

$sql = 'SELECT Avatar, firstName, lastName, nameCommand 
        from Players 
        inner join Commands on Commands.idCommand = Players.idCommand';

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