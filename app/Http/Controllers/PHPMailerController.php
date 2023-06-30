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
        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $message = $request->input('message');

        // Instantiate a new PHPMailer instance
        $mail = new PHPMailer(true);

        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'draganddropproject0@gmail.com'; // Replace with your Gmail address
        $mail->Password = 'lvoebqjzlmctviqq'; // Replace with your Gmail password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender and recipient settings
        $mail->setFrom($email, $name);
        $mail->addAddress('chanshan250@gmail.com', 'Shanmugam');  // Replace with recipient email address and name



        // Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = '
            <html>
                <head>
                    <style>
                        /* Set background image */
                        body {
                            background-image: url("https://images.pexels.com/photos/3184465/pexels-photo-3184465.jpeg");
                            background-repeat: no-repeat;
                            background-size: cover;
                            color:white;
                        }
                        /* Style the message content */
                        table {
                            width: 100%;
                            max-width: 600px;
                            margin: 20px auto;
                            background-color: rgba(255,255,255,0.5);
                            border-radius: 10px;
                            padding: 20px;
                            font-size: 18px;
                            line-height: 1.5;
                        }
                        h1 {
                            font-size: 24px;
                            font-weight: bold;
                            margin-top: 0;
                        }
                        p {
                            margin: 0;
                        }
                    </style>
                </head>
                <body>
                    <table>
                        <tr>
                            <td>
                                <h1>New message from ' . $name . '</h1>
                                <p>Email: ' . $email . '</p>
                                <p>Message: ' . $message . '</p>
                            </td>
                        </tr>
                    </table>
                </body>
            </html>';
        
        

        // Send email and handle errors
        try {

            $mail->send();
            DB::table('emails')->insert([
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'message' => $message,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back()->with('success', 'Your message has been sent. Thank you!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        }
    }
}
