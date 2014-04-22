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

        $name = $_POST['questionform_name'];
        $email_from = $_POST['questionform_email'];
        $message = $_POST['questionform_message'];

        // create email headers
        $headers = 'From: '.$name." <".$email_from.">\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();

        $sent = @mail($email_to, $email_subject, $message, $headers);

//        echo("name: " . $name . "<br />\n");
//        echo("email: " . $email_from . "<br />\n");
//        echo("message: " . $message . "<br />\n");
//        echo("sent: " . $sent . "<br />\n");

        if ($sent) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo("We encountered an error sending your mail");
        }
    }

?>
