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

        // Get user IP address
        if ( isset($_SERVER['HTTP_CLIENT_IP']) && ! empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) && ! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
        }

        $ip = filter_var($ip, FILTER_VALIDATE_IP);
        $ip = ($ip === false) ? '0.0.0.0' : $ip;

        $date = new DateTime('now', new DateTimeZone('GMT'));

        $email_to="CoderDojoD15@gmail.com";
        $email_subject="Question from CoderDojo Website";

        $name = $_POST['questionform_name'];
        $email_from = $_POST['questionform_email'];
        $message = $_POST['questionform_message'];

        // create email headers
        $headers = "From: " . $name." <".$email_from . "\r\n";
        $headers .= "Reply-To: ". $name." <".$email_from . "\r\n";
//        $headers .= "CC: rdas@example.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();

        $email_message  ="<html><body>";
        $email_message .= "<p> A question from : ".$name." (".$email_from.").</br></p>";
        $email_message .= "<p> on : ".$date->format('d/M/Y H:i')."\r\n</p>";
        $email_message .= "<p> <b>".$message."</b></br>\r\n</p>";
        $email_message .= "<p> from ip : ".$ip."\r\n</p>";

        $email_message .= "</body></html>";

        //        echo("name: " . $name . "<br />\n");
        //        echo("email: " . $email_from . "<br />\n");
        //        echo("message: " . $email_message . "<br />\n");
        //        echo("sent: " . $sent . "<br />\n");

        $sent = @mail($email_to, $email_subject, $email_message, $headers);

        if ($sent) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo("We encountered an error sending your mail");
        }
    }

?>
