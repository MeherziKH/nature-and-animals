<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Membre;
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
     * @Route("/sendMail/{id}/{status}", name="sendMail")
     */
    public function sendMail($id, $status): Response
    {
        $order = new Order();
        $membre = new Membre();
        
        $order = $this->getDoctrine()->getRepository(Order::class)->find($id);
        $ident= $order->getCurtomerId();
        $total= $order->getSum();
        $membre = $order->getMembre();
        $email = $membre->getEmail();
        $full_name = $membre->getNom() .' '. $membre->getPrenom();

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
            $mail->addAddress($email, 'Khouloud Meherzi');     //Add a recipient

            //Content
            $mail->isHTML(true);
            if($status == 1){
                $mail->Subject = 'Order Confirmation #'.$ident.'#';
            } elseif ($status == 2) {
                $mail->Subject = 'Order Validated #'.$ident.'#';
            }elseif ($status == 3) {
                $mail->Subject = 'Order Delivred #'.$ident.'#';
            } else{
                $mail->Subject = 'Order Cancelled #'.$ident.'#';
            }                                
            

            if($status == 1){
                $mail->Body    = ' 
                <html>
                    <p style="color:#000">Hello <b>'.$full_name.'</b>,</p>
                    <p style="color:#000"> Thank you for your support,</p>
                    <p style="color:#000">We confirm the receipt of your order with identifiant : <b> '.$ident.' </b> and total of : <b> '.$total.' TND </b>, we will contact you as soon as possible for your confirmation</p>
                    <b style="color:#000">Stay Safe !</b>
                </html>
                ' ;           
            } elseif ($status == 2) {
                $mail->Body    = ' 
                <html>
                    <p style="color:#000">Hello <b>'.$full_name.'</b>,</p>
                    <p style="color:#000"> Thank you for your support,</p>
                    <p style="color:#000">After your confirmation, your order has been <b style="color:#17a2b8">validated</b> !</p>
                    <b style="color:#000">Stay Safe !</b>
                </html>
                ' ; 
            }elseif ($status == 3) {
                $mail->Body    = ' 
                <html>
                    <p style="color:#000">Hello <b>'.$full_name.'</b>,</p>
                    <p style="color:#000"> Thank you for your support,</p>
                    <p style="color:#000">your order has been <b style="color:#28a745">delivred</b> !</p>
                    <b style="color:#000">Stay Safe !</b>
                </html>
                ' ;
            } else{
                $mail->Body    = ' 
                <html>
                    <p style="color:#000">Hello <b>'.$full_name.'</b>,</p>
                    <p style="color:#000"> Thank you for your support,</p>
                    <p style="color:#000">After your confirmation, your order has been <b style="color:#dc3545">cancelled</b> !</p>
                    <b style="color:#000">Stay Safe !</b>
                </html>
                ' ; 
            } 

            $mail->send();
        } catch (Exception $e) {}
        return new Response(
            'OK',
            Response::HTTP_OK
        );
    }


}
