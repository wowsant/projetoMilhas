<?php

namespace projetoMilhas\Console\Commands;

use Illuminate\Console\Command;

class CategoryCrawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:category';

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
        $dom = file_get_html('https://www.seminovosbh.com.br/resultadobusca/index/veiculo/moto/marca/Honda/modelo/1039/cidade/2700/usuario/todos');
        $sant = $dom->find('.preco_busca', 0);
        // $sant->innertext  
        // $sant->href

        foreach ($sant as $key => $value) {
            
        }
        dd($sant);
    }
}
