<?php

 require_once 'vendor/autoload.php';

 use App\classes\FileUpload;
 use App\classes\LogOut;

 if(isset($_GET['pages'])) {
     if ($_GET['pages'] == 'file-upload') {
         include 'pages/fileUpload.php';
     } elseif ($_GET['pages'] == 'view-students') {
         $fileUpload = new FileUpload();
         $students = $fileUpload->getAllStudentsInfo();
         include 'pages/viewStudents.php';
     }

     elseif ($_GET['pages'] == 'login')
     {
         include 'pages/login.php';
     }
     elseif ($_GET['pages'] == 'logout')
     {
         $logout = new LogOut();
         $logout->Logout();
     }
 }
 elseif (isset($_POST['btn']))
 {
     $fileUpload = new FileUpload($_FILES, $_POST);
     $message = $fileUpload->index();
     include 'pages/fileUpload.php';
 }
 elseif (isset($_POST['loginBtn']))
 {
     $logout = new LogOut($_POST);
     $logout -> logIn();
     include 'pages/login.php';
 }