<?php

namespace Julio\EndpointDocs\Src\Actions;

use Julio\EndpointDocs\Src\Contracts\{
    Action,
    DocumentationInterface,
};
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class IndexAction extends Action implements DocumentationInterface
{
    public function struct(bool $auth, string $path, array $params, $name): string
    {
        $structuredYaml = str_repeat(config('documentation.space'), 4) . "get:" . PHP_EOL;
        $structuredYaml .=
            str_repeat(config('documentation.space'), 6) .
            '$ref: ./' .
            $name .
            '.yaml' .
            PHP_EOL;

        $this->createStructure(
            auth: $auth,
            path: $path,
            params: $params,
            name: $name
        );

        return $structuredYaml;
    }

    private function bodyStructure(): string
    {
        $statusCode = HttpResponse::HTTP_OK;
        $structure = str_repeat(config('documentation.space'), 6) . "tags:" . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 8) . "- ''" . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 6) . "summary: ''" . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 6) . "consumes:" . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 8) . "- 'application/json'" . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 6) . "produces:" . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 8) . "- 'application/json'" . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 6) . "responses:" . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 8) . $statusCode . ":" . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 10) .
            "description: " .
            HttpResponse::$statusTexts[$statusCode] .
            PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 10) . "content:" . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 12) . "application/json:" . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 14) . "schema:" . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 16) . "type: object" . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 16) . "properties:" . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 18) . "links:" . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 20) . '$ref: ../' . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 18) . "meta:" . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 20) . '$ref: ../' . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 18) . "data:" . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 20) . "type: array" . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 20) . "items:" . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 22) . "type: object" . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 22) . "properties:" . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 24) . "#input:" . PHP_EOL;
        $structure .= str_repeat(config('documentation.space'), 26) . "#type: integer" . PHP_EOL;

        return $structure;
    }

    public function createStructure(bool $auth, string $path, array $params, string $name): void
    {
        $structure = PHP_EOL;

        if ($auth) {
            $structure .= $this->authStructure->header();
        }

        $structure .= $this->paramsStructure->headerPaginate(params: $params);
        $structure .= $this->bodyStructure();

        if ($auth) {
            $structure .= $this->authStructure->response();
        }

        if (!empty($params)) {
            $structure .= $this->paramsStructure->response();
        }

        $this->basicStructure->createFile(
            fileName: './' . $name . '.yaml',
            structure: $structure,
            path: $path
        );
    }
}
