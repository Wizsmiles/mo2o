<?php


namespace App\Controller;


use App\Services\GuzzleClientService;
use FOS\RestBundle\Controller\AbstractFOSRestController;

class ApiController extends AbstractFOSRestController
{
    const DEFAULT_NULL = null;

    protected $guzzleClientService;

    public function __construct(GuzzleClientService $guzzleClientService)
    {
        $this->guzzleClientService = $guzzleClientService;
    }

}