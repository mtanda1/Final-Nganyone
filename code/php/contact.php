<?php
session_start();

$conn = new mysqli('localhost', 'root', '' , 'infosci', 3306);
    // Check connection
if ($conn->connect_error) {
    die();#"Connection failed: " . $conn->connect_error);
}
#echo "Connected successfully <br>";
if(isset($_POST['submit'])){ // Fetching variables of the form which travels in URL
$prep = "insert into infosci.contact(f_name, l_name, email, phone_number, uid, message, spam_bool) values (?,?,?,?,?,?,?)";
$stmt = $conn->prepare($prep);//creates prepared statement
$stmt -> bind_param("sssssss",$f_name,$l_name,$email,$phone_number,$uid,$message,$spam_bool);//binds variables

$f_name = mysqli_real_escape_string($conn,$_POST['f_name']);
$l_name = mysqli_real_escape_string($conn,$_POST['l_name']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$phone_number = mysqli_real_escape_string($conn,$_POST['phone_number']);
$message = mysqli_real_escape_string($conn,$_POST['message']);
$uid = mysqli_real_escape_string($conn,$_POST['uid']);
$spam_bool = mysqli_real_escape_string($conn,$_POST['spam_bool']);
//$stmt -> execute();
if($f_name !=''||$l_name !=''||$email !='' ||$message !=''){
//Insert Query of SQL
    //echo 'hello';
//$query = "insert into infosci.contact(f_name, l_name, email, phone_number, uid, message, spam_bool) values ('$f_name','$l_name', '$email', '$phone_number', '$uid', '$message', '$spam_bool')";

#$result = $conn->query($query);
#echo "<br/><br/><span>Data Inserted successfully...!!</span>";
/*$q = "select * from infosci.contact";
    $result = $conn->query($q);
    if (!$result) die();
    $rows = $result->num_rows;
    #echo "There are " . $rows . " rows in the contact table.";
  }
  else{
    echo "<p>Insertion Failed <br/> Some Fields are Blank....!!</p>";
  }*/
  include_once $_SERVER['DOCUMENT_ROOT'] . '/infosciwebsite/code/securimage/securimage.php';
  $securimage = new Securimage();
  if ($securimage->check($_POST['captcha_code']) == false) {
  // the code was incorrect
  // you should handle the error so that the form processor doesn't continue

  // or you can use the following code if there is no validation or you do not know how
  echo "The security code entered was incorrect.<br /><br />";
  echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
  exit;
  }else{
    $stmt -> execute();
  }

}
}
//mysql_close($connection); // Closing Connection with Server
//header( 'Location: http://localhost/formtoinsert.html' );

//display data
/*$displaydata = "SELECT contact_id, f_name, l_name FROM infosci.contact";
$res = $conn->query($displaydata);

if ($res->num_rows > 0) {
    // output data of each row
    while($row = $res->fetch_assoc()) {
        echo "id: " . $row["contact_id"]. "     " . " - Name: " . $row["f_name"]. "     ". "- date added: " . $row["l_name"]. "<br>";
    }
} else {
    echo "0 results";
}*/

$conn->close();
?>




<html>
<!--Contact us Page-->
<head>
<link rel ="stylesheet" href="../css/main.css">
    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"/>
<!--JS input validation to prevent SQL injection-->
<script>
function validateEmail()
{
    //stop = true;
    txt = "";
    var re = /\S+@\S+\.\S+/;
    if(re.test(emails.value)){
        //stop = false;
        return true;
    }else{txt = 'Email should be in the format email@provider.com; please fix the email';
        alert(txt)
        return false;
    }
    document.getElementById("demo").innerHTML = txt;
    // document.getElementById("iswrong").innerHTML = stop;
}
</script>
<title>Contact Us!</title>
</head>
<body>
<!-- Main Icon on header, pulled from Marco's github -->
  <div class='header'>
    <div class="image">
      <img src="https://raw.githubusercontent.com/mtanda1/infosciwebsite/master/code/images/large.jpg" width="50" height="50">
    </div>
  </div>
  <!-- Bootstrap Navigation Bar -->
  <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="../html/info.html">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="../html/about.html">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="../html/members.html">Members</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="../php/contact.php">Contact Us</a>
        </li>
      <li class="nav-item">
          <a class="nav-link active" href="../html/faq.html">FAQs</a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Bootstrap Navigation Bar -->

<!--Web Content -->

<div class="jumbotron">
  <div class="container">
    <h1>Contact Us!</h1>
  </div>
</div>

<!--HTML Form: Each form input will have different inputs needed, which will all be added in their own column into the SQL database. Calls validateEmail method to ensure security -->

<form action="contact.php" method="post" onsubmit = "return validateEmail()">
  <img id="captcha" src="../securimage/securimage_show.php" alt="CAPTCHA Image" />
    <input type="text" name="captcha_code" size="10" maxlength="6" />
  <a href="#" onclick="document.getElementById('captcha').src = '../securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>First Name:</label>
      <input class="form-control" name="f_name" type="text" value="" required>
    </div>
    <div class="form-group col-md-6">
      <label>Last Name:</label>
      <input class="form-control" name="l_name" type="text" value="" required>
    </div>
  </div>
  <div class="form-row">
    <div class = "form-group col-md-6">
      <label>University ID #:</label>
      <input class="form-control" name="uid" type="text" value="" >
    </div>
    <div class="form-group col-md-4">
      <label>Email:</label>
      <input id = "emails" class="form-control" name="email" type="text" value="" required>
    </div>
    <div class="form-group col-md-2">
      <label>Phone Number:</label>
      <input class="form-control" name="phone_number" type="text" value="" >
    </div>
  </div>
    <div class="form-group col-md-6">
      <label>Message:</label>
      <textarea cols="25" class="form-control" name="message" rows="5"></textarea>
    </div>
    <div class="form-inline">
    <div class="col-sm-4">Would you like to receive e-mails notifications from the iSchool?</div>
    <div class="col-sm-2">
    <div class="form-check">
      <div class="col-sm-2">
      <input class="form-check-input" name="spam_bool" type="radio" value="no" id = "radio1"checked>
      <label class="form-check-label" for="radio1">No</label>
    </div>
    <div class="col-sm-2">
      <input class="form-check-input" name="spam_bool" type="radio" value="yes" id="check1">
      <label class="form-check-label" for="radio2">Yes</label>
    </div>
    </div>
    </div>
    </div>
    <button name = "submit" class="btn btn-primary" type="submit" value="Insert">Submit</button>

    
</form>

<!--Web Content -->

<!-- Footer -->
<footer class='footer'>
<div class="container">
  <p>Visit us on Social Media!</p>
  <!-- Social Media Icons -->
  <a href="#"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
   width="50" height="50"
   viewBox="0 0 50 50"
   style="fill:#000000;"><path d="M41,4H9C6.24,4,4,6.24,4,9v32c0,2.76,2.24,5,5,5h32c2.76,0,5-2.24,5-5V9C46,6.24,43.76,4,41,4z M37,19h-2c-2.14,0-3,0.5-3,2 v3h5l-1,5h-4v15h-5V29h-4v-5h4v-3c0-4,2-7,6-7c2.9,0,4,1,4,1V19z"></path></svg></a>
   <aria-controls="">
   <a href="#"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
   width="50" height="50"
   viewBox="0 0 50 50"
   style="fill:#000000;"><g id="surface1"><path style=" " d="M 50.0625 10.4375 C 48.214844 11.257813 46.234375 11.808594 44.152344 12.058594 C 46.277344 10.785156 47.910156 8.769531 48.675781 6.371094 C 46.691406 7.546875 44.484375 8.402344 42.144531 8.863281 C 40.269531 6.863281 37.597656 5.617188 34.640625 5.617188 C 28.960938 5.617188 24.355469 10.21875 24.355469 15.898438 C 24.355469 16.703125 24.449219 17.488281 24.625 18.242188 C 16.078125 17.8125 8.503906 13.71875 3.429688 7.496094 C 2.542969 9.019531 2.039063 10.785156 2.039063 12.667969 C 2.039063 16.234375 3.851563 19.382813 6.613281 21.230469 C 4.925781 21.175781 3.339844 20.710938 1.953125 19.941406 C 1.953125 19.984375 1.953125 20.027344 1.953125 20.070313 C 1.953125 25.054688 5.5 29.207031 10.199219 30.15625 C 9.339844 30.390625 8.429688 30.515625 7.492188 30.515625 C 6.828125 30.515625 6.183594 30.453125 5.554688 30.328125 C 6.867188 34.410156 10.664063 37.390625 15.160156 37.472656 C 11.644531 40.230469 7.210938 41.871094 2.390625 41.871094 C 1.558594 41.871094 0.742188 41.824219 -0.0585938 41.726563 C 4.488281 44.648438 9.894531 46.347656 15.703125 46.347656 C 34.617188 46.347656 44.960938 30.679688 44.960938 17.09375 C 44.960938 16.648438 44.949219 16.199219 44.933594 15.761719 C 46.941406 14.3125 48.683594 12.5 50.0625 10.4375 Z "></path></g></svg></a>
   <!-- Social Media Icons -->
</div>
</footer>
<!-- Footer -->

<!-- Bootstrap JQuery & Javascript -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<!-- Bootstrap JQuery & Javascript -->
</body>
</html>




<!--PHP Action script which will input information into SQL database-->
