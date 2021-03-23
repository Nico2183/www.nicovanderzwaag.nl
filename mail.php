<?php

if($_POST) {
    $name = "";
    $email = "";
    $phone = "";
    $option = "";
    $datepicker = "";
    $textarea = "";
    $email_body = "<div>";

    if(isset($_POST['name'])) {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Naam:</b></label>&nbsp;<span>".$name."</span>
                        </div>";
    }

    if(isset($_POST['email'])) {
        $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $email_body .= "<div>
                           <label><b>mail adres:</b></label>&nbsp;<span>".$email."</span>
                        </div>";
    }

    if(isset($_POST['phone'])) {
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Telefoon</b></label>&nbsp;<span>".$phone."</span>
                        </div>";
    }

    if(isset($_POST['optie'])) {
        $option = filter_var($_POST['optie'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Uw keuze:</b></label>&nbsp;<span>".$option."</span>
                        </div>";
    }

    if(isset($_POST['datepicker'])) {
        $datepicker = htmlspecialchars($_POST['datepicker']);
        $email_body .= "<div>
                           <label><b>Gewenste datum:</b></label>
                           <div>".$datepicker."</div>
                        </div>";
    }


    if(isset($_POST['textarea1'])) {
        $textarea = htmlentities($_POST['textarea1']);
        $email_body .= "<div>
                           <label><b>Vraag/Opmerking:</b></label>
                           <div>".$textarea."</div>
                        </div>";
    }

    else {
        $recipient = "info@nicovanderzwaag.nl";
    }

    $email_body .= "</div>";

    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $email . "\r\n";

    if(mail($recipient, $option, $textarea, $email_body, $headers)) {
        echo "<p>Bedankt , $name. U krijgt binnen 24 uur reactie.</p>";
    } else {
        echo '<p>Sorry uw formulier is niet verzonden.</p>';
    }

} else {
    echo '<p>Er ging wat mis.</p>';
}
?>
