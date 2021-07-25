<?php

namespace App\EventListener;
use App\Entity\Order;
use App\Entity\OrderDetails;
use Doctrine\ORM\Event\LifecycleEventArgs;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


class OrderEventListener
{
    public function __construct()
    {

    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        // Searching for some classes
        switch (true) {
            case $args->getEntity() instanceof OrderDetails:
                $this->postPersistOrder($args);
                break;
            default:
                // Do nothing
                break;
        }
    }

    private function postPersistOrder(LifecycleEventArgs $args): void
    {
        $em = $args->getEntityManager();
        $order = $args->getEntity();
        $details = $order->getQuantity();

        //$quantity = $details->getValues();

        $mail = new PHPMailer(true);
        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'meherzi.khouloud@gmail.com';                     //SMTP username
            $mail->Password   = '!Meherzi@123@&!';                               //SMTP password
            PHPMailer::ENCRYPTION_STARTTLS;        //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('no-repeat@ePetCare.com', 'Order');
            $mail->addAddress('khouloud.meherzi@esprit.tn', 'Joe User');     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'this is quantity : ' . json_encode($details);
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } catch (Exception $e) {}
        return ;
    }
}
