<?php

namespace Julio\EndpointDocs\Src\Actions;

use Julio\EndpointDocs\Src\Contracts\{
    Action,
    DocumentationInterface,
};
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class StoreAction extends Action implements DocumentationInterface
{
    public function struct(bool $auth, string $path, array $params, string $name): string
    {
        $structuredYaml = str_repeat(config('documentation.space'), 4) . "post:" . PHP_EOL;
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

    public function createStructure(bool $auth, string $path, array $params, string $name): void
    {
        $structure = PHP_EOL;

        if ($auth) {
            $structure .= $this->authStructure->header();
        }

        if (!empty($params)) {
            $structure .= $this->paramsStructure->header(params: $params);
        }

        $structure .= $this->basicStructure->info();
        $structure .= $this->basicStructure->response(statusCode: HttpResponse::HTTP_CREATED);

        if ($auth) {
            $structure .= $this->authStructure->response();
        }

        if (!empty($params)) {
            $structure .= $this->paramsStructure->response();
        }

        $structure .= $this->basicStructure->body();

        $this->basicStructure->createFile(
            fileName: './' . $name . '.yaml',
            structure: $structure,
            path: $path
        );
    }
}
