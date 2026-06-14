<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\FlashMessage;
use App\Models\UserModel;
use App\Models\ServiceModel;
use App\Models\GalleryModel;
use App\Models\ContactModel;

class AdminController extends BaseController
{
    

    public function login(): void
    {
        if (Auth::isLoggedIn()) {
            $this->redirect('index.php?page=admin-dashboard');
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            $userModel = new UserModel();
            $user      = $userModel->authenticate($username, $password);

            if ($user !== null) {
                Auth::login($user['username']);
                $this->redirect('index.php?page=admin-dashboard');
            } else {
                $error = 'Nesprávne meno alebo heslo.';
            }
        }

        $this->render('admin/login', [
            'title' => 'Admin – Prihlásenie',
            'error' => $error,
        ]);
    }

    public function logout(): void
    {
        Auth::logout();
        $this->redirect('index.php?page=admin-login');
    }

    

    public function dashboard(): void
    {
        $serviceModel = new ServiceModel();
        $contactModel = new ContactModel();
        $galleryModel = new GalleryModel();

        $this->render('admin/dashboard', [
            'title'         => 'Admin – Dashboard',
            'serviceCount'  => count($serviceModel->findAll()),
            'messageCount'  => count($contactModel->findAll()),
            'unreadCount'   => $contactModel->countUnread(),
            'galleryCount'  => count($galleryModel->findAll()),
            'username'      => Auth::getUsername(),
        ]);
    }

    

    public function servicesList(): void
    {
        $serviceModel = new ServiceModel();
        $this->render('admin/services-list', [
            'title'    => 'Admin – Správa služieb',
            'services' => $serviceModel->findAll(),
        ]);
    }

    public function serviceCreate(): void
    {
        $errors = [];
        $old    = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data   = $this->extractServiceData();
            $errors = $this->validateServiceData($data);

            if (empty($errors)) {
                $model = new ServiceModel();
                $model->create($data);
                FlashMessage::set('success', '✅ Služba bola úspešne pridaná.');
                $this->redirect('index.php?page=admin-services');
            }
            $old = $data;
        }

        $this->render('admin/service-form', [
            'title'  => 'Admin – Pridať službu',
            'errors' => $errors,
            'old'    => $old,
            'action' => 'create',
        ]);
    }

    public function serviceEdit(): void
    {
        $id    = (int) ($_GET['id'] ?? 0);
        $model = new ServiceModel();
        $service = $model->findById($id);

        if ($service === null) {
            $this->redirect('index.php?page=admin-services');
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data   = $this->extractServiceData();
            $errors = $this->validateServiceData($data);

            if (empty($errors)) {
                $model->update($id, $data);
                FlashMessage::set('success', '✅ Služba bola úspešne aktualizovaná.');
                $this->redirect('index.php?page=admin-services');
            }
            $service = array_merge($service, $data);
        }

        $this->render('admin/service-form', [
            'title'   => 'Admin – Upraviť službu',
            'errors'  => $errors,
            'old'     => $service,
            'action'  => 'edit',
            'id'      => $id,
        ]);
    }

    public function serviceDelete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int) ($_POST['id'] ?? 0);
            $model = new ServiceModel();
            $model->delete($id);
            FlashMessage::set('success', '🗑️ Služba bola vymazaná.');
        }
        $this->redirect('index.php?page=admin-services');
    }

    

    public function galleryList(): void
    {
        $galleryModel = new GalleryModel();
        $this->render('admin/gallery-list', [
            'title'  => 'Admin – Správa galérie',
            'images' => $galleryModel->findAll(),
        ]);
    }

    public function galleryCreate(): void
    {
        $errors = [];
        $old    = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title       = trim($_POST['title']       ?? '');
            $description = trim($_POST['description'] ?? '');
            $sortOrder   = (int) ($_POST['sort_order'] ?? 0);
            $isActive    = isset($_POST['is_active']) ? 1 : 0;

            if (strlen($title) < 2) {
                $errors['title'] = 'Názov musí mať aspoň 2 znaky.';
            }

            
            $filename = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $allowed  = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
                $mimeType = mime_content_type($_FILES['image']['tmp_name']);

                if (!in_array($mimeType, $allowed)) {
                    $errors['image'] = 'Povolené formáty: JPG, PNG, WEBP, GIF.';
                } else {
                    $ext      = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $filename = uniqid('img_', true) . '.' . strtolower($ext);
                    $dest = __DIR__ . '/../../public/galeria/' . $filename;
                    if (!move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
                        $errors['image'] = 'Chyba pri nahrávaní súboru.';
                    }
                }
            } else {
                $errors['image'] = 'Vyberte obrázok.';
            }

            if (empty($errors)) {
                $model = new GalleryModel();
                $model->create([
                    'title'       => htmlspecialchars($title, ENT_QUOTES, 'UTF-8'),
                    'filename'    => $filename,
                    'description' => htmlspecialchars($description, ENT_QUOTES, 'UTF-8'),
                    'sort_order'  => $sortOrder,
                    'is_active'   => $isActive,
                ]);
                FlashMessage::set('success', '✅ Fotografia bola úspešne pridaná.');
                $this->redirect('index.php?page=admin-gallery');
            }
            $old = compact('title', 'description', 'sortOrder', 'isActive');
        }

        $this->render('admin/gallery-form', [
            'title'  => 'Admin – Pridať fotografiu',
            'errors' => $errors,
            'old'    => $old,
            'action' => 'create',
        ]);
    }

    public function galleryEdit(): void
    {
        $id    = (int) ($_GET['id'] ?? 0);
        $model = new GalleryModel();
        $image = $model->findById($id);

        if ($image === null) {
            $this->redirect('index.php?page=admin-gallery');
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title'       => htmlspecialchars(trim($_POST['title'] ?? ''), ENT_QUOTES, 'UTF-8'),
                'description' => htmlspecialchars(trim($_POST['description'] ?? ''), ENT_QUOTES, 'UTF-8'),
                'sort_order'  => (int) ($_POST['sort_order'] ?? 0),
                'is_active'   => isset($_POST['is_active']) ? 1 : 0,
            ];

            if (strlen($data['title']) < 2) {
                $errors['title'] = 'Názov musí mať aspoň 2 znaky.';
            }

            if (empty($errors)) {
                $model->update($id, $data);
                FlashMessage::set('success', '✅ Fotografia bola aktualizovaná.');
                $this->redirect('index.php?page=admin-gallery');
            }
            $image = array_merge($image, $data);
        }

        $this->render('admin/gallery-form', [
            'title'  => 'Admin – Upraviť fotografiu',
            'errors' => $errors,
            'old'    => $image,
            'action' => 'edit',
            'id'     => $id,
        ]);
    }

    public function galleryDelete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id    = (int) ($_POST['id'] ?? 0);
            $model = new GalleryModel();
            $image = $model->findById($id);

            if ($image !== null) {
                $filePath = __DIR__ . '/../../public/galeria/' . $image['filename'];
                if (file_exists($filePath) && strpos($image['filename'], 'img_') === 0) {
                    unlink($filePath);
                }
                $model->delete($id);
                FlashMessage::set('success', '🗑️ Fotografia bola vymazaná.');
            }
        }
        $this->redirect('index.php?page=admin-gallery');
    }

    

    public function messagesList(): void
    {
        $contactModel = new ContactModel();
        $this->render('admin/messages-list', [
            'title'    => 'Admin – Správy z kontaktného formulára',
            'messages' => $contactModel->findAll(),
        ]);
    }

    public function messageRead(): void
    {
        $id    = (int) ($_GET['id'] ?? 0);
        $model = new ContactModel();
        $model->markAsRead($id);
        $this->redirect('index.php?page=admin-messages');
    }

    public function messageDelete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id    = (int) ($_POST['id'] ?? 0);
            $model = new ContactModel();
            $model->delete($id);
            FlashMessage::set('success', '🗑️ Správa bola vymazaná.');
        }
        $this->redirect('index.php?page=admin-messages');
    }

    

    
    private function extractServiceData(): array
    {
        return [
            'name'        => trim($_POST['name']        ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'price'       => (float) str_replace(',', '.', $_POST['price'] ?? '0'),
            'category'    => trim($_POST['category']    ?? ''),
            'is_active'   => isset($_POST['is_active']) ? 1 : 0,
        ];
    }

    
    private function validateServiceData(array $data): array
    {
        $errors = [];
        if (strlen((string)$data['name']) < 2) {
            $errors['name'] = 'Názov musí mať aspoň 2 znaky.';
        }
        if (strlen((string)$data['description']) < 5) {
            $errors['description'] = 'Popis musí mať aspoň 5 znakov.';
        }
        if ($data['price'] < 0) {
            $errors['price'] = 'Cena nemôže byť záporná.';
        }
        if (strlen((string)$data['category']) < 2) {
            $errors['category'] = 'Kategória musí mať aspoň 2 znaky.';
        }
        return $errors;
    }
}
