<?php


namespace App\Controller\Recipes;


use App\Controller\ApiController;
use App\Exception\ApiInvalidRequestException;
use Symfony\Component\HttpFoundation\Request;

class GetRecipesController extends ApiController
{

    public function __invoke(Request $request)
    {
        return $this->makePuppyRecipesRequest($request);
    }

    protected function prepareOptions(Request $request)
    {
        $options = [];
        $search = $request->query->get('search', parent::DEFAULT_NULL);
        $page = $request->query->get('page', parent::DEFAULT_NULL);
        if (isset($search)) {
            if (!is_string($search)) {
                throw new ApiInvalidRequestException('Invalid argument search!');
            }
            $options["query"]["q"] = $search;
        }
        if (isset($page)) {
            if ((int) $page <= 0) {
                throw new ApiInvalidRequestException('Invalid argument page!');
            }
            $options["query"]["p"] = $page;
        }
        return $options;
    }

    protected function prepareResponseData($data)
    {
        $results = json_decode($data)->results;

        foreach ($results as $result) {
            unset($result->ingredients);
            unset($result->thumbnail);
        }
        return $results;
    }

}