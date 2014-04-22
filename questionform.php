<?php

    function flush_buffers(){
        ob_end_flush();
        ob_flush();
        flush();
        ob_start();
    }

    error_reporting(E_ALL);

    if(isset($_POST['submit'])) {

        function died($error) {
            echo "We are very sorry, but there were error(s) found with the form you submitted. ";
            echo "These errors appear below.<br /><br />";
            echo $error."<br /><br />";
            echo "Please go back and fix these errors.<br /><br />";
            die();
        }

        $email_to="rana.pratap.das@gmail.com";
        $email_subject="Question from CoderDojo Website";

        $name = $_POST['name'];
        $email_from = $_POST['email'];
        $message = $_POST['message'];

        // create email headers
        $headers = 'From: '.$name." <".$email_from.">\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();

        $sent = @mail($email_to, $email_subject, $message, $headers);

//        echo("name: " . $_POST['name'] . "<br />\n");
//        echo("email: " . $_POST['email'] . "<br />\n");
//        echo("message: " . $_POST['message'] . "<br />\n");
//        echo("sent: " . $sent . "<br />\n");

        if ($sent) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo("We encountered an error sending your mail");
        }
    }

?>
