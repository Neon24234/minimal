<?php
require_once "connect.php";

$sql = "SELECT * FROM todo_list";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo $row["task"] . " - ";
    echo $row["finished"] ? "Kész<br>" : "Nincs kész<br>";
}
?>
Hello world!