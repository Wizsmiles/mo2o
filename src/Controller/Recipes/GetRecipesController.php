<?php


namespace App\Controller\Recipes;


use App\Controller\ApiController;
use FOS\RestBundle\View\View;
use Hoa\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetRecipesController extends ApiController
{

    public function __invoke(Request $request)
    {
        $statusCode = Response::HTTP_OK;
        $options = $this->prepareOptions($request);

        try {
            $puppyResponse = $this->guzzleClientService->request(
                Request::METHOD_GET,
                'http://www.recipepuppy.com/api/',
                $options
            );
            $response = array(
               "results" => $this->prepareResponseData($puppyResponse)
            );
        } catch (\Exception $ex) {
            $statusCode = Response::HTTP_FAILED_DEPENDENCY;
            $response = array(
                'message' => 'There was an error on the request!'
            );
        }

        return new JsonResponse($response, $statusCode);

    }

    private function prepareOptions(Request $request)
    {
        $options = [];
        $search = $request->query->get('search', parent::DEFAULT_NULL);
        $page = $request->query->get('page', parent::DEFAULT_NULL);
        if (isset($search)) {
            $options["query"]["q"] = $search;
        }
        if (isset($page)) {
            $options["query"]["p"] = $page;
        }
        return $options;
    }

    private function prepareResponseData($data)
    {
        $results = json_decode($data)->results;

        foreach ($results as $result) {
            unset($result->ingredients);
            unset($result->thumbnail);
        }
        return $results;
//        $response = new \stdClass();
//        $response->results = $results;
//        return $response;
    }

}