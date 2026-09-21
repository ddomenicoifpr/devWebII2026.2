<?php

include_once("Connection.php");

$conn = Connection::getConnection();
print_r($conn);