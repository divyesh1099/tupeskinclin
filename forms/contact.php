<?php
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

if (!empty($name) || !empty($email) || !empty($subject) || !empty($message))
{
  $host="localhost";
  $dbUsername="root";
  $dbPassword="";
  $dbname="enquiry";
  $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
  if (mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
  }else{
    $SELECT = "SELECT email From enquiry Where email = ? Limit 1";
    $INSERT = "INSERT Into enquiry(name, email, subject, message) values(?,?,?,?)";
    $stmt=$conn->prepare($SELECT);
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum = $stmt->num_rows;
    if($rnum==0){
      $stmt->close();

      $stmt=$conn->prepare($INSERT);
      $stmt->bind_param("ssss",$name,$email,$subject,$message);
      $stmt->execute();
      echo "Message Sent Successfully";
    }else{
      echo "Someone already register using this email";
    }
    $stmt->close();
    $conn->close();
    }
    }
  }
}
else{
  echo "All Field are required";
  die();
}
?>
