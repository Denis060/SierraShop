<?php

function updateCountView($id)
{
    global $linkConnectDB;
    $id = intval($id);
    $sql = "Update posts set totalView = totalView + 1 WHERE id =$id";

    return mysqli_query($linkConnectDB, $sql);
}
