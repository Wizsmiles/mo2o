<?php


namespace App\Controller;


use App\Exception\ApiInvalidRequestException;
use App\Services\GuzzleClientService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class ApiController extends AbstractFOSRestController
{
    const DEFAULT_NULL = null;

    protected $guzzleClientService;

    public function __construct(GuzzleClientService $guzzleClientService)
    {
        $this->guzzleClientService = $guzzleClientService;
    }

    protected function makePuppyRecipesRequest(Request $request)
    {
        try {
            $options = $this->prepareOptions($request);

            $statusCode = Response::HTTP_OK;
            $puppyResponse = $this->guzzleClientService->request(
                Request::METHOD_GET,
                'http://www.recipepuppy.com/api/',
                $options
            );
            $response = array(
                "results" => $this->prepareResponseData($puppyResponse)
            );
        } catch (ApiInvalidRequestException $argumentException) {
            $statusCode = Response::HTTP_BAD_REQUEST;
            $response = array(
                'message' => $argumentException->getMessage()
            );
        } catch (\Exception $ex) {
            $statusCode = Response::HTTP_FAILED_DEPENDENCY;
            $response = array(
                'message' => 'There was an error on the request!'
            );
        }

        return new JsonResponse($response, $statusCode);
    }

    abstract protected function prepareOptions(Request $request);

    abstract protected function prepareResponseData($data);

}