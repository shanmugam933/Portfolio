<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\DB;

class PHPMailerController extends Controller
{
    public function sendEmail(Request $request)
    {

    try {

        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $message = $request->input('message');

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'draganddropproject0@gmail.com';
        $mail->Password = 'lvoebqjzlmctviqq';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom($email, $name);
        $mail->addAddress('chanshan250@gmail.com', 'Shanmugam');  // Replace with recipient email address and name


        // Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = '
        <html>
        <head>
            <style>
                /* Set background color */
                body {
                    background-color: #f2f2f2;
                    font-family: Arial, sans-serif;
                    color: #444444;
                }

                /* Style the message container */
                .container {
                    max-width: 600px;
                    margin: 20px auto;
                    background-color: #ffffff;
                    border-radius: 10px;
                    padding: 20px;
                    font-size: 18px;
                    line-height: 1.5;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }

                /* Style the heading */
                h1 {
                    font-size: 24px;
                    font-weight: bold;
                    margin-top: 0;
                    color: #333333;
                }

                /* Style the content */
                p {
                    margin: 0;
                    color: #555555;
                }

            </style>
        </head>
        <body>
            <div class="container">
                <h1>New message from '.$name.'</h1>
                <p>Email: ' . $email . '</p>
                <p>Message: ' . $message . '</p>
            </div>

        </body>
        </html>';


            // $mail->send();
            DB::table('emails')->insert([
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'message' => $message,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

             //Thank you mall
             $mail->clearAddresses();
             $mail->addAddress($email, $name);
             $mail->isHTML(true);
             $mail->Subject = 'Thank you for contacting us!';
             $mail->Body = '
             <html>
             <head>
                 <style>
                     /* Set background color */
                     body {
                         background-color: #f2f2f2;
                         font-family: Arial, sans-serif;
                         color: #444444;
                         margin: 0;
                         padding: 0;
                     }

                     /* Style the container */
                     .container {
                         max-width: 600px;
                         margin: 20px auto;
                         background-color: #ffffff;
                         border-radius: 10px;
                         padding: 40px;
                         font-size: 18px;
                         line-height: 1.5;
                         box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                     }

                     /* Style the heading */
                     h1 {
                         font-size: 28px;
                         font-weight: bold;
                         margin-top: 0;
                         margin-bottom: 20px;
                         color: #333333;
                     }

                     /* Style the content */
                     p {
                         margin: 0 0 20px 0;
                         color: #555555;
                     }
                 </style>
             </head>
             <body>
                 <div class="container">
                     <h1>Thank you for contacting us,'.$name.'!</h1>
                     <p>We have received your message and will get back to you as soon as possible.</p>
                 </div>
             </body>
             </html>
             ';

            //  $mail->send();

             return response()->json(['message' => 'Email sent successfully']);

        } catch (Exception $e) {

            return response()->json(['message' => 'Email sent failed']);

        }
    }
}
