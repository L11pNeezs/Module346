<?php


namespace App\Http\Controllers\Contact;

use App\Libraries\Core\Http\Controller\AbstractController;


class ContactController extends AbstractController
{

    public function contact(): string
    {
        return view('contact.index');
    }

    public function send(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!isset($_SESSION['id'])) {
                return view('contact.index', ['LoginError' => 'You must be logged in to submit the form.']);
            }
        }

        $data = request()->all();

        $required = ['email', 'name', 'subject', 'message'];
        foreach ($required as $field) {
            if (empty($data[$field] ?? null)) {
                return view('contact.index', ['formError' => 'All fields are required.']);

            }
        }

        $from = $_POST['email'];
        $name = $_POST['name'];
        $rawMessage = $_POST['message'];
        $subject = $_POST['subject'];
        $headers = "From: $from";

        $message = wordwrap($rawMessage, 70);
        $message .= "\n{$name}\nEmail: $from";

        $success = mail(CONTACT_EMAIL, "$subject", "$message", "$headers", "$name");
        if (!$success) {
            return view('contact.index', ['sendError' => "There was an error sending your message. Please try again later."]);
        }
        else {
            return view('contact.success');
        }
    }

}
