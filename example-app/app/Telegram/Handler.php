<?php

namespace App\Telegram;

use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Models\TelegraphChat;

use DefStudio\Telegraph\Telegraph;
use \PhpImap\Mailbox;
//use Google_Service_Classroom;
use Illuminate\Support\Facades\Log;
use Google_Service_Classroom;
use App\Models\Email;
class Handler extends WebhookHandler
{
    public function start(): void
    {
        /** @var TelegraphChat $chat */
        $this->chat->message('Цей бот буде надсилати вам дані з ваших почт та класруму. Використовуйте команди щоб зареєструватись')->send();
    }

    public function setclassroom(): void
    {
        /** @var TelegraphChat $chat */
        $this->chat->message('setclassroom')->send();    }
    public function setclassroomid(): void
    {
        /** @var TelegraphChat $chat */
        $this->chat->message('setclassroomid')->send();    }

///example-app/vendor/php-imap/php-imap/src/PhpImap/Mailbox.php
    public function setemail(string $arguments)
    {
        /** @var TelegraphChat $chat */
        $this->chat->html("Received: $arguments")->send();
        Email::create(['state' => 0]);
        $this->chat->html("Please enter your email.")->send();
        return response('Please enter your email.');
    }

    public function setpasswordemail()
    {

    }

    public function getemail()
    {
        $currentemail = Email::where('state', 1)->first();
        $this->fetchEmails($currentemail->email, $currentemail->password);
    }

    public function handleEmailInput($email)
    {
        $currentemail = Email::where('state', 0)->first();
        if ($currentemail) {
            // Обновляем запись с email
            Email::update(['email' => $email, 'state' => 0]);
            return response('Email saved. Now, please enter your password.');
        } else {
            return response('Please start with the /setemail command.');
        }
    }

    protected function handlePasswordInput($password)
    {

    }
    protected function handleChatMessage($text): void
    {
        // in this example, a received message is sent back to the chat
        $this->chat->html("Received handle: $text")->send();
        if (filter_var($text, FILTER_VALIDATE_EMAIL)) {
            $this->chat->html("email")->send();
            $currentemail = Email::where('state', 0)->first();
            if ($currentemail) {
                $currentemail->email = $text;
                $currentemail->save();
                // Обновляем запись с email
                $this->chat->html('Email saved. Now, please enter your password.')->send();
            } else {
                $this->chat->html('Please start with the /setemail command.')->send();
            }
        } else {
            $this->chat->html("pass")->send();
            $currentpass = Email::where('state', 0)->first();
            if ($currentpass) {
                // Обновляем запись с password и меняем state на 1
                $currentpass->password = $text;
                $currentpass->state = 1;
                $currentpass->save();
                $this->chat->html('Password saved. Your email setup is complete.')->send();
                $this->fetchEmails($currentpass->email, $text);
            } else {
                $this->chat->html('Please start with the /setemail command.')->send();
            }
        }
    }



    protected function fetchEmails($email, $password)
    {
        $this->chat->message("Fetching emails for $email")->send();

        try {
            $mailbox = new Mailbox(
                '{imap.ukr.net:993/imap/ssl}INBOX',
                $email,
                $password,
                null,
                'UTF-8'
            );

            $mailsIds = $mailbox->searchMailbox('UNSEEN');

            if (empty($mailsIds)) {
                $this->chat->message('No new emails found.')->send();
                return;
            }

            Log::debug('emails', ['content' => json_encode($mailsIds)]);

            foreach ($mailsIds as $mailId) {
                $mail = $mailbox->getMail($mailId);
                $this->chat->message("From: {$mail->fromAddress}\nSubject: {$mail->subject}")->send();
                sleep(2);

                // Optionally save the mail ID to avoid duplicate processing
                /*MailFetch::create([
                    'email' => $email,
                    'mail_id' => $mailId,
                ]);*/
            }
        } catch (\Exception $e) {
            Log::error('Email get', ['content' => $e->getMessage()]);
            $this->chat->message("Error fetching emails: " . $e->getMessage())->send();
        }
    }

}
