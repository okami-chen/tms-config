<?php

namespace OkamiChen\TmsConfig\Console\Command;

use Illuminate\Console\Command;
use Symfony\Component\Yaml\Yaml;

class YamlCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tms:config:yaml {name}';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'php配置转换yaml配置';

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
        $file   = $this->argument('name');
        $content = config($file, null);
        if(!$content){
            $this->error('配置文件为空');
            return false;
        }
        $yaml = Yaml::dump($content, 4);
        $local  = base_path('yaml/local').'/'.$file.'.yml';
        file_put_contents($local, $yaml);
        $prd    = base_path('yaml/production').'/'.$file.'.yml';
        file_put_contents($prd, $yaml);
        $this->line('success convert.');
    }
}
