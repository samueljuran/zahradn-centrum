<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\ServiceModel;
use App\Models\GalleryModel;
use App\Models\ContactModel;

class PublicController extends BaseController
{
    public function home(): void
    {
        $serviceModel = new ServiceModel();
        $featuredServices = array_slice($serviceModel->findActive(), 0, 3);

        $this->render('public/home', [
            'title'           => 'Domov | Zelený Raj Záhrady',
            'featuredServices' => $featuredServices,
        ]);
    }

    public function services(): void
    {
        $serviceModel = new ServiceModel();
        $services     = $serviceModel->findActive();

        
        $grouped = [];
        foreach ($services as $service) {
            $grouped[$service['category']][] = $service;
        }

        $this->render('public/services', [
            'title'   => 'Naše Služby | Zelený Raj Záhrady',
            'grouped' => $grouped,
        ]);
    }

    public function gallery(): void
    {
        $galleryModel = new GalleryModel();
        $images       = $galleryModel->findActive();

        $this->render('public/gallery', [
            'title'  => 'Galéria | Zelený Raj Záhrady',
            'images' => $images,
        ]);
    }

    public function contact(): void
    {
        $errors  = [];
        $success = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name    = trim($_POST['name']    ?? '');
            $email   = trim($_POST['email']   ?? '');
            $message = trim($_POST['message'] ?? '');
            $privacy = isset($_POST['privacy']);

            
            if (strlen($name) < 2) {
                $errors['name'] = 'Meno musí mať aspoň 2 znaky.';
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Zadajte platný e-mail.';
            }
            if (strlen($message) < 10) {
                $errors['message'] = 'Správa musí mať aspoň 10 znakov.';
            }
            if (!$privacy) {
                $errors['privacy'] = 'Musíte súhlasiť so spracovaním údajov.';
            }

            if (empty($errors)) {
                $contactModel = new ContactModel();
                $contactModel->create([
                    'name'    => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
                    'email'   => $email,
                    'message' => htmlspecialchars($message, ENT_QUOTES, 'UTF-8'),
                ]);
                $success = true;
            }
        }

        $this->render('public/contact', [
            'title'   => 'Kontakt | Zelený Raj Záhrady',
            'errors'  => $errors,
            'success' => $success,
            'old'     => $_POST,
        ]);
    }

    public function notFound(): void
    {
        http_response_code(404);
        $this->render('public/404', [
            'title' => '404 – Stránka nenájdená',
        ]);
    }
}
