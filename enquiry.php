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
        $phone = $_POST['phone'];
        $mentor = $_POST['mentor_student'] == "mentor" ? "mentor" : "student";
        $topics = $_POST['topic'];
        $topic_strings = implode(' ', $topics);
//        echo($topic_strings);
//          if(empty($aDoor)) {
//            echo("You didn't select any topics.");
//          }
//          else {
//            $N = count($aDoor);
//
//            echo("You selected $N topic(s): ");
//            for($i=0; $i < $N; $i++) {
//              echo($aDoor[$i] . " ");
//            }
//          }


        $message = $_POST['message'];
        $company = $_POST['company'];

        // create email headers
        $headers = 'From: '.$name." <".$email_from.">\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();

        //$sent = @mail($email_to, $email_subject, $message, $headers);
        echo("<br />\n");
        echo("name: " . $_POST['name'] . "<br />\n");
        echo("email: " . $_POST['email'] . "<br />\n");
        echo("message: " . $_POST['message'] . "<br />\n");
        echo("mentor: " . $mentor . "<br />\n");
        echo("company: " . $company . "<br />\n");

        $message_body= "<b>".$name."</b></br>"." of type ".$mentor."</br>"." is interested <b>";
        if(!empty($topic)) {
            $message_body=$message_body.$topic_strings." </b>from </br>";
        }

        $message_body=$message_body
        ." with company name  ".$company
        ."</br> with message </br>".$message;
        echo("message_body: " . $message_body . "<br />\n");
//        echo("sent: " . $sent . "<br />\n");

//        if ($sent) {
//            header('Location: ' . $_SERVER['HTTP_REFERER']);
//            exit();
//        } else {
//            echo("We encountered an error sending your mail");
//        }
    }

?>
