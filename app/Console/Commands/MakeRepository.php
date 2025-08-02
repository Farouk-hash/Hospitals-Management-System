<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepository extends Command
{
    protected $signature = 'make:repository {name}';
    protected $description = 'Create an interface and repository class for a model';

    public function handle()
    {
        $name = $this->argument('name');
        $interfacePath = app_path("Interfaces/{$name}RepositoryInterface.php");
        $repositoryPath = app_path("Repositories/{$name}Repository.php");

        // Create folders if they don't exist
        File::ensureDirectoryExists(app_path('Interfaces'));
        File::ensureDirectoryExists(app_path('Repositories'));

        // Interface content
        $interfaceContent = <<<PHP
<?php

namespace App\Interfaces;

interface {$name}RepositoryInterface
{
    public function all();
    public function find(\$id);
    public function create(array \$data);
    public function update(\$id, array \$data);
    public function delete(\$id);
}
PHP;

        // Repository content
        $repositoryContent = <<<PHP
<?php

namespace App\Repositories;

use App\Interfaces\\{$name}RepositoryInterface;
use App\Models\\{$name};

class {$name}Repository implements {$name}RepositoryInterface
{
    public function all()
    {
        return {$name}::all();
    }

    public function find(\$id)
    {
        return {$name}::findOrFail(\$id);
    }

    public function create(array \$data)
    {
        return {$name}::create(\$data);
    }

    public function update(\$id, array \$data)
    {
        \$item = {$name}::findOrFail(\$id);
        \$item->update(\$data);
        return \$item;
    }

    public function delete(\$id)
    {
        return {$name}::destroy(\$id);
    }
}
PHP;

        // Write files
        if (!File::exists($interfacePath)) {
            File::put($interfacePath, $interfaceContent);
            $this->info("Created Interface: {$interfacePath}");
        } else {
            $this->warn("Interface already exists: {$interfacePath}");
        }

        if (!File::exists($repositoryPath)) {
            File::put($repositoryPath, $repositoryContent);
            $this->info("Created Repository: {$repositoryPath}");
        } else {
            $this->warn("Repository already exists: {$repositoryPath}");
        }

        return Command::SUCCESS;
    }
}
