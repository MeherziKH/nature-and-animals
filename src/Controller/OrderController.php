<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Response, JsonResponse};
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/ordersPerMonth", name="ordersPerMonth")
     */
    public function ordersPerMonth(): Response
    {
        $first_day_this_month = date('Y-m-01');
        $last_day_this_month  = date('Y-m-t');
        $orderRepo = $this->em->getRepository(Order::class);
        $orders = $orderRepo->findByMonth($first_day_this_month, $last_day_this_month);
        return new JsonResponse(count($orders), Response::HTTP_OK);
    }

    /**
     * @Route("/sendMail/{id}", name="sendMail")
     */
    public function sendMail($id): Response
    {
        $order = new Order();
        $order = $this->getDoctrine()->getRepository(Order::class)->find($id);
        $ident= $order->getCurtomerId();
        $total= $order->getSum();

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
            $mail->setFrom('no-repeat@ePetCare.com', 'ePetCare');
            $mail->addAddress('khouloud.meherzi@esprit.tn', 'Khouloud Meherzi');     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Order Confirmation #'.$ident.'#';
            $mail->Body    = ' 
            <html>
                <p style="color:#000">Hello <b>Khouloud Meherzi</b>,</p>
                <p style="color:#000"> Thank you for your support,</p>
                <p style="color:#000">We confirm the receipt of your order with identifiant : <b> '.$ident.' </b> and total of : <b> '.$total.' TND </b>, we will contact you as soon as possible for your confirmation</p>
                <b style="color:#000">Stay Safe !</b>
            </html>
            ' ;
            $mail->send();
        } catch (Exception $e) {}
        return new Response(
            'OK',
            Response::HTTP_OK
        );
    }


}
