<?php

namespace App\Controller;

class ContactController extends AbstractController
{

    public function index()
    {
        $errors = $this->send();
        return $this->twig->render('Contact/index.html.twig', ["errors" => $errors]);
    }

    private const NAME_MAX_LENGHT = 80;
    private const MESSAGE_MAX_LENGHT = 2000;

    public function validate($data)
    {
        $errors = [];

        if (empty($data['lastname'])) {
            $errors[] = 'Le nom est obligatoire';
        } elseif ($data['lastname'] > self::NAME_MAX_LENGHT) {
            $errors = 'Le nom doit faire moins de' . self::NAME_MAX_LENGHT . ' caractères';
        }

        if (empty($data['firstname'])) {
            $errors[] = 'Le prénom est obligatoire';
        } elseif ($data['firstname'] > self::NAME_MAX_LENGHT) {
            $errors = 'Le prénom doit faire moins de' . self::NAME_MAX_LENGHT . ' caractères';
        }

        if (empty($data['email'])) {
            $errors[] = 'L\'email est obligatoire';
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Mauvais format d\'email';
        }

        if (empty($data['message'])) {
            $errors[] = 'Un message est obligatoire';
        } elseif ($data['message'] > self::MESSAGE_MAX_LENGHT) {
            $errors = 'Le message doit faire moin de ' . self::MESSAGE_MAX_LENGHT . ' caractères';
        }
        return $errors;
    }

    private function send()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            $errors = $this->validate($data);

            if (empty($errors)) {
                //send in mail
                header('location: index.html.twig');
            }
        }
        return $errors;
    }
}
