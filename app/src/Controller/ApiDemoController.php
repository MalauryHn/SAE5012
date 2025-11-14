<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiDemoController extends AbstractController
{
    #[Route('/api/demo', name: 'app_api_demo')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Bonjour depuis Symfony ! 👋',
            'date' => date('Y-m-d H:i:s'),
        ]);
    }
}