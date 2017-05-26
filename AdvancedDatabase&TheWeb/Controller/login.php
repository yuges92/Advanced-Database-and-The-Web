<?php
require_once '../Model/dbConn.php';

if (isset($_POST['checkLogin'])) {
    if (isset($_SESSION['user'])) {
        echo  'true';
    } else {
        echo 'false';
    }
} elseif (isset($_POST['checkUser'])) {
    if (isset($_SESSION['user'])) {
        if ($_POST['user']->userType=='Admin') {
            echo "admin";
        } else {
            echo "false";
        }
    }

    if (isset($_POST['changePassword'])) {
        parse_str($_POST['changePassword'], $data);
        if (empty($data['oldPassword'])||
    empty($data['newPassword'])) {
            echo "Empty Field";
        } else {
            $oldPassword=htmlentities($data['oldPassword']);
            $newPassword=htmlentities($data['newPassword']);
            $confirmPassword=htmlentities($data['confirmPassword']);
            if (password_verify($oldPassword, $_SESSION['user']->password)) {
                if ($newPassword==$confirmPassword) {
                    $username=$_SESSION['user']->username;
                    $change=changePassword($username, $newPassword);

                    if ($change) {
                        echo "password changed";
                    } else {
                        echo "password not changed";
                    }
                } else {
                    echo "new password do not match";
                }
            } else {
                echo "Old password do not match";
            }
        }
    }
} elseif (!isset($_SESSION['user'])) {
    if (isset($_POST['login'])) {
        $username=htmlentities($_POST['username']);
        $password=htmlentities($_POST['password']);
        $user=login($username, $password);
        if ($user) {
            $_SESSION['user']=$user;
            if ($user->userType=='Admin') {
                echo 'Admin';
            } else {
                echo "Customer";
            }
        } else {
            echo "false";
        }
    }
} else {
    header('location:../index.php');
}
