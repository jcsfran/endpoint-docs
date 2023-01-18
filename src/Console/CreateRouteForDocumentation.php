<?php

namespace Julio\EndpointDocs\Src\Console;

use Illuminate\Console\Command;
use Julio\EndpointDocs\Src\DocumentationHelper;

class CreateRouteForDocumentation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'docs:route
                            {path : "file path, use : to pass parameters"}
                            {action* : array with the actions to be created}
                            {--name=* : name of each action file}
                            {--a|auth : whether to have authentication}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new file with your actions';

    public function __construct(private DocumentationHelper $documentationHelper)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->checkIfAtLeastOneActionWasReported();
        $this->checkOptionsReported();

        $path = $this
            ->documentationHelper
            ->createAction(
                originalPath: $this->argument('path'),
                options: $this->argument('action'),
                auth: $this->option('auth'),
                names: $this->option('name')
            );

        return $this->info('Copy path file: ' . config('documentation.patch_notes_path') . '/' . $path);
    }

    private function checkOptionsReported(): void
    {
        $validActions = [
            'index',
            'show',
            'store',
            'update',
            'destroy'
        ];

        foreach ($this->argument('action') as $action) {
            if (!in_array($action, $validActions)) {
                $message = $this->error(
                    'This action is invalid: ' . $action
                );

                $message .= $this->alert(
                    '--index --show --store --update or --destroy'
                );

                exit;
            }
        }
    }

    private function checkIfAtLeastOneActionWasReported(): void
    {
        if (empty($this->argument('action'))) {
            $message = $this->error(
                'Please select at least one action.'
            );

            $message .= $this->alert(
                '--index --show --store --update or --destroy'
            );

            exit;
        }
    }
}
