<?php
session_start();
unset($_SESSION['cLogin']);
//encaminha para o index
header("Location: ./");
?>