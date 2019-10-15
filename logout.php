<?php
//include('log.php');
session_start();
//registra_log($_SESSION['usuario'], "LogoutSistema", "Logout realizado", date('Y/m/d H:i:s'));
session_destroy();
header('Location: index.php');
exit();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

