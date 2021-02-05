<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ImportController extends AbstractController
{
    /**
     * @Route("/import", name="import")
     */
    public function index(PropertyRepository $repository, Request $request): Response
    {
        $launch = $request->query->get('launch');
        $data = [];
        $data['data'] = null;
        $data['error'] = "";
        $data['status'] = false;

        if ($launch) {
            try {
                $data['status'] = true;
            } catch (\Throwable $th) {
                $data['error'] = $th;
            }
        }
        
        return $this->render('import/index.html.twig', [
            'controller_name' => 'ImportController',
            'data' => $data,
        ]);
    }
}
