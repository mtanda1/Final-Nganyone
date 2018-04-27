<!DOCTYPE html>
<html>
<head>
<title>insert data in database</title>
<link href="prettyform.css" rel="stylesheet">
</head>
<body>
<div class="form-style-2">
<div class="maindiv">
<!--HTML Form -->
<div class="form_div">
<div class="title">
<h2>Insert Data In Database</h2>
</div>
<form action="contact.php" method="post" onsubmit = "return validateEmail()">
<br><label>First Name:</label>
<input class="input" name="f_name" type="text" value="" required><br>
<br><label>Last Name:</label>
<input class="input" name="l_name" type="text" value="" required><br>
<br><label>Email:</label>
<input id = "emails" class="input" name="email" type="text" value="" required><br>

<p id="demo"></p>

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
<br><label>Phone Number:</label>
<input class="input" name="phone_number" type="number" value="" ><br>
<br><label>uid:</label>
<input class="input" name="uid" type="number" value="" ><br>
<br><label>Message:</label>
<textarea cols="25" name="message" rows="5"></textarea><br>
<br><label>wanna get spammed?:</label>
<input class="input" name="spam_bool" type="radio" value="no" checked> no<br>
<input class="input" name="spam_bool" type="radio" value="yes" >yes<br>
<input name = "submit" class="submit" class="submit" type="submit" value="Insert">
<var id = iswrong></var>
</form>
</div>
</div>
</body>
</html>






<?php
$conn = new mysqli('localhost', 'root', '' , 'infosci', 3306);
    // Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully <br>";
if(isset($_POST['submit'])){ // Fetching variables of the form which travels in URL

$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$message = $_POST['message'];
$uid = $_POST['uid'];
$spam_bool = $_POST['spam_bool'];
if($f_name !=''||$l_name !=''||$email !='' ||$message !=''){
//Insert Query of SQL
    echo 'hello';
$query = "insert into infosci.contact(f_name, l_name, email, phone_number, uid, message, spam_bool) values ('$f_name','$l_name', '$email', '$phone_number', '$uid', '$message', '$spam_bool')";
$result = $conn->query($query);
echo "<br/><br/><span>Data Inserted successfully...!!</span>";
$q = "select * from infosci.contact";
    $result = $conn->query($q);
    if (!$result) die($conn->error);
    $rows = $result->num_rows;
    echo "There are " . $rows . " rows in the contact table.";
}
else{
echo "<p>Insertion Failed <br/> Some Fields are Blank....!!</p>";
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
