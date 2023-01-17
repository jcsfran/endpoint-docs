<?php

namespace Julio\EndpointDocs\Src;

use Julio\EndpointDocs\Src\DocumentationStrategy;
use Symfony\Component\Yaml\Yaml;

class DocumentationHelper
{
    public function getPatchNotes(): array
    {
        $path = config('documentation.patch_notes_path');

        if (!is_dir($path)) {
            mkdir($path, 755, true);
        }

        $fileNames = scandir($path);
        $fileNames = array_diff(scandir($path), array('.', '..'));
        $data = [];

        foreach ($fileNames as $name) {
            $data[] = Yaml::parseFile($path . '/' . $name);
        }

        return array_reverse($data);
    }

    public function createAction(string $originalPath, array $options, bool $auth, array $names): string
    {
        $path = str_replace(
            config('documentation.parameter_identify'),
            '',
            $originalPath
        );
        $fileName = config('documentation.default_main_yaml');
        $filePath = config('documentation.route_path') . '/' . $path . $fileName;
        $this->createFolder(path: $path);

        $params = $this->verifyIfParamExist(originalPath: $originalPath);
        $structure = $this->structure(
            auth: $auth,
            options: $options,
            path: $path,
            params: $params,
            names: $names
        );


        file_put_contents($filePath, $structure, FILE_APPEND);

        return $path . $fileName;
    }

    private function verifyIfParamExist(string $originalPath): array
    {
        $params = [];

        $explodePath = explode(
            '/',
            $originalPath
        );

        foreach ($explodePath as $currentPath) {
            $hasParameter = strpos($currentPath, config('documentation.parameter_identify')) === false;

            if (!$hasParameter) {
                $params[] = substr($currentPath, 1);
            }
        }

        return $params;
    }

    private function createFolder(string $path): void
    {
        $fullPath = config('documentation.route_path');

        $explodePath = explode('/', $path);

        foreach ($explodePath as $folder) {
            $currentPath = '/' . $folder;

            if (!is_dir($fullPath . $currentPath)) {
                mkdir($fullPath . $currentPath, 755, true);
            }

            $fullPath .= $currentPath;
        }
    }

    private function structure(bool $auth, array $options, string $path, array $params, array $names): string
    {
        $structure = PHP_EOL;
        $documentationStrategy = new DocumentationStrategy();

        $structure .= $documentationStrategy->handle(
            options: $options,
            auth: $auth,
            path: $path,
            params: $params,
            names: $names
        );

        return $structure;
    }
}
