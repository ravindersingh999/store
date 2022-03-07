<?php
session_start();
// include('config.php');
include('classes/DB.php');

?>
<?php
$msg = "";
if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if ($email != "" && $password != "") {
        try {
            $stmt = DB::getInstance()->prepare("select * from users where `email`=:email and `password`=:password");
            $stmt->bindParam('email', $email, PDO::PARAM_STR);
            $stmt->bindValue('password', $password, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row   = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($count == 1 && !empty($row)) {

                $_SESSION['email']   = $row['email'];
                $_SESSION['password'] = $row['password'];
                if($row['role']=="admin" && $row['status']=="approved"){
                    header('location:dashboard.html');
                }
                   elseif($row['role']=="user" && $row['status']=="approved"){
                       header('location:user.php');
                   } 
                else{
                    $_SESSION['msg']="Your request is yet pending";
                    header('location:loginHtml.php');
                }
            } 
            else {
                $_SESSION['msg'] = "Invalid email and password!";
                header('location:loginHtml.php');            
            }
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    } else {
     $_SESSION['msg'] = "Both fields are required!";
     header('location:loginHtml.php');  
    }
}
?>