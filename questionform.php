<?php
error_reporting(E_ALL);

    //if(isset($_POST['submit']) {

    function died($error) {

            // your error code can go here
            echo "We are very sorry, but there were error(s) found with the form you submitted. ";
            echo "These errors appear below.<br /><br />";
            echo $error."<br /><br />";
            echo "Please go back and fix these errors.<br /><br />";
            die();
        }

        echo("First name: " . $_POST['name'] . "<br />\n");
        echo("Last name: " . $_POST['email'] . "<br />\n");
        echo("Last name: " . $_POST['message'] . "<br />\n");


        $email_to="rana.pratap.das@gmail.com";
        $email_subject="question from website";

        $email_from = $_POST['email']; //
        $message = $_POST['message']; // required

        // create email headers
        $headers = 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();

        @mail($email_to, $email_subject, $message, $headers);

    //}
?>