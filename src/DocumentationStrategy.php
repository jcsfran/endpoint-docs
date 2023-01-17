<?php

namespace Julio\EndpointDocs\Src;

use Julio\EndpointDocs\Src\Actions\{
    DestroyAction,
    IndexAction,
    ShowAction,
    StoreAction,
    UpdateAction,
};

class DocumentationStrategy
{
    private DestroyAction $delete;
    private IndexAction $index;
    private StoreAction $post;
    private UpdateAction $put;
    private ShowAction $show;

    public function __construct()
    {
        $this->delete = new DestroyAction();
        $this->index = new IndexAction();
        $this->post = new StoreAction();
        $this->put = new UpdateAction();
        $this->show = new ShowAction();
    }

    public function handle(
        array $options,
        bool $auth,
        string $path,
        array $params,
        array $names
    ): string {
        $structure = null;
        foreach ($options as $index => $option) {
            $name = $option;

            if (isset($names[$index])) {
                $name = $names[$index];
            }

            $structure .= $this->{$option}->struct(
                auth: $auth,
                path: $path,
                params: $params,
                name: $name
            );
        }

        return $structure;
    }
}
