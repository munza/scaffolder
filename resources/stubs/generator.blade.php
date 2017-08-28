{!! "<?"."php" !!}

namespace {{ config('scaffolder.namespace') }};

use Illuminate\Console\Command;
use Munza\Scaffolder\Traits\FileGeneratable;

class {{ $class }} extends Command
{
    use FileGeneratable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->create()) {
            $this->info('File created successfully.');
        } else {
            $this->error('File not created!');
        }
    }

    /**
     * Create the file.
     *
     * @return bool
     */
    private function create()
    {
        return $this->createFileFromStub(
            // real path of the target file eg.
            // base_path("app/Console/Generators/{$this->argument('name')}.php"),

            // stub view name eg.
            // 'scaffolder::hello.test',

            // associative array of variables to replace in stub
            [
                'class' => $this->argument('name'),
            ]
        );
    }
}
