<?php


namespace App\Controller\Recipes;


use App\Controller\ApiController;
use App\Exception\ApiInvalidRequestException;
use Symfony\Component\HttpFoundation\Request;

class GetRecipesDetailController extends ApiController
{

    public function __invoke(Request $request)
    {
        return $this->makePuppyRecipesRequest($request);
    }


    protected function prepareOptions(Request $request)
    {
        $options = [];
        $ingredients = $request->query->get('ingredients', parent::DEFAULT_NULL);
        $page = (int) $request->query->get('page', parent::DEFAULT_NULL);
        if (isset($ingredients)) {
            if (!is_string($ingredients)) {
                throw new ApiInvalidRequestException('Invalid argument ingredients!');
            }
            $options["query"]["i"] = $ingredients;
        }
        if (isset($page)) {
            if (!is_int($page)) {
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
            unset($result->href);
        }
        return $results;
    }

}