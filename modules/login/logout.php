<?php
    
    require_once('../../functions.php');
    
    unset($_SESSION['ets_credentials']);
    header('location:../../modules/login/index.php');

?>