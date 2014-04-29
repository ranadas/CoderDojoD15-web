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

        $email_to="CoderDojoD15@gmail.com";
        $email_subject="Enquiry from CoderDojo Website";

        $name = $_POST['enquiry_name'];
        $email_from = $_POST['enquiry_email'];
        $phone = $_POST['enquiry_phone'];
        $mentor = $_POST['mentor_student'] == "mentor" ? "mentor" : "student";
        if (isset($_POST['topic'])) {
            $topics = $_POST['topic'];
//            $topic_strings = implode(' ', $topics);
            $topic_strings ="With topic(s) : ";
            $topic_strings .= implode(", ", $topics);
//            $nCount = count($topics);
//            for($i=0; $i < $nCount; $i++) {
//                $topic_strings .= "".$topics[$i].",";
//            }
        }

        $message = $_POST['enquiry_message'];
        $company = $_POST['enquiry_company'];

        // create email headers
        $headers = "From: " . $name." <".$email_from . "\r\n";
        $headers .= "Reply-To: ". $name." <".$email_from . "\r\n";
//        $headers .= "CC: rdas@example.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//        $headers .= 'X-Mailer: PHP/' . phpversion();

        //$sent = @mail($email_to, $email_subject, $message, $headers);
//        echo("<br />\n");
//        echo("name: " . $name . "<br />\n");
//        echo("email: " . $email_from . "<br />\n");
//        echo("message: " . $message. "<br />\n");
//        echo("mentor: " . $mentor . "<br />\n");
//        echo("company: " . $company . "<br />\n");

//        $message_body=$message_body
//        ." with company name  ".$company
//        ."</br> with message </br>".$message;

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

        $email_message  ="<html><body>";
        $email_message .= "<p> An enquiry message from : ".$name." (".$email_from.").</br></p>";
        $email_message .= "<p> on : ".$date->format('d/M/Y H:i')."\r\n</p>";
        $email_message .= "<p> <b>".$message."</b></br>\r\n</p>";

        $email_message .= "</br></br> <u>Additional info :</u></br>\r\n";
        $email_message .= "<p>Type : ".$mentor;
        $email_message .= "</br>\r\n</p>";


        if(!empty($topics)) {
            rtrim($topic_strings,',');
            $email_message .= "<p>".$topic_strings."</p>";
        }

        if(!empty($company)) {
            $email_message .= "<p>From company:".$company."</p>\r\n";
        }
        $email_message .= "<p> from ip : ".$ip."\r\n</p>";
        $email_message .= "</body></html>";

        //echo("</br>email_message: " . $email_message . "<br />\n");
        $sent = @mail($email_to, $email_subject, $email_message, $headers);
//        echo("sent: " . $sent . "<br />\n");

        if ($sent) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo("We encountered an error sending your mail");
        }
    }
?>
