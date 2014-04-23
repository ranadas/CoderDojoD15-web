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
        $email_subject="Enquiry from CoderDojo Website";

        $name = $_POST['enquiry_name'];
        $email_from = $_POST['enquiry_email'];
        $phone = $_POST['enquiry_phone'];
        $mentor = $_POST['mentor_student'] == "mentor" ? "mentor" : "student";
        if (isset($_POST['topic'])) {
            $topics = $_POST['topic'];
            $topic_strings = implode(' ', $topics);
            //echo( count($topics)."</br>");
            //echo("str : ".$topic_strings."</br>");
//            $N=count($topics);
//            for($i=0; $i < $N; $i++) {
//                echo($topics[$i] . " ===== </br>");
//            }
        }

        $message = $_POST['enquiry_message'];
        $company = $_POST['enquiry_company'];

        // create email headers
        $headers = 'From: '.$name." <".$email_from.">\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();

        //$sent = @mail($email_to, $email_subject, $message, $headers);
//        echo("<br />\n");
//        echo("name: " . $name . "<br />\n");
//        echo("email: " . $email_from . "<br />\n");
//        echo("message: " . $message. "<br />\n");
//        echo("mentor: " . $mentor . "<br />\n");
//        echo("company: " . $company . "<br />\n");

//        $message_body= "<b>".$name."</b></br>"." of type ".$mentor."</br>"." is interested <b>";
//        if(!empty($topic)) {
//            $message_body=$message_body.$topic_strings." </b>from </br>";
//        }

//        $message_body=$message_body
//        ." with company name  ".$company
//        ."</br> with message </br>".$message;
//
        $email_message="<p> Message from : ".$name." (".$email_from.").</br>"
        ."".$message
        ."</br></br> Additional info :</br>"
        ." Type : ".$mentor
        ."</br>";
        if(!empty($topics)) {
            $email_message = $email_message."</br>"
            ."with topic(s) ".$topic_strings;
        }

        if(!empty($company)) {
            $email_message = $email_message."</br>"
            ."from company ".$company;
        }

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
