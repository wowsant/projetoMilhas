<?php

namespace projetoMilhas\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getCrawler(Request $request) {
    	# Executa Crawler 
		$dom = file_get_html($this->getUrl('geral', $request->all()));
		# Contador do bloco de veiculos (modelo/preco)
		$contador = 0;
		# Contador dos atributos do veiculo tag p
		$contadorSequencial = 0;
		do {
			$resultado = $dom->find('.titulo-busca h4', $contador);
			if (!empty($resultado)){
				
				$resultado = $dom->find('.titulo-busca h4', $contador);
				$partesVeiculos = explode('<', $resultado->innertext);

				$dadosVeiculo[$contador]['modelo'] = isset($partesVeiculos[0])? $partesVeiculos[0] : '';
				$dadosVeiculo[$contador]['preco'] = strip_tags('<'.$partesVeiculos[1]);			

				$resultado = $dom->find('.bg-nitro-mais-home .planoNitroHomeDesc p', $contadorSequencial++); 
				$dadosVeiculo[$contador]['ano'] = isset($resultado->innertext) ? $resultado->innertext : '';

				$resultado = $dom->find('.bg-nitro-mais-home .planoNitroHomeDesc p', $contadorSequencial++);
				$dadosVeiculo[$contador]['km'] = isset($resultado->innertext) ? $resultado->innertext : '';

				$resultado = $dom->find('.bg-nitro-mais-home .planoNitroHomeDesc p', $contadorSequencial++);
				$dadosVeiculo[$contador]['acessorio'] = isset($resultado->innertext) ? $resultado->innertext : '';


				$resultado = $dom->find('.bg-nitro-mais-home .planoNitroHomeDesc p', $contadorSequencial++);
				$dadosVeiculo[$contador]['cor'] = isset($resultado->innertext) ? $resultado->innertext : '';

				$resultado = $dom->find('.bg-nitro-mais-home .planoNitroHomeDesc p', $contadorSequencial++);
				$dadosVeiculo[$contador]['combustivel'] = isset($resultado->innertext) ? $resultado->innertext : '';
			}
			$contador++;
		} while (!empty($resultado) == true); 
		if (isset($dadosVeiculo)) {
			return response()->json(['erro' => 'false', 'codigo' => '200', 'dados' => $dadosVeiculo]);
		} else {
			return response()->json(['erro' => 'true', 'codigo' => '404', 'dados' => 'Não encontramos nenhuma oferta deste veiculo em Belo Horizonte, tente outro veiculo ou novamente mais tarde... Caso alguem publique no seminovos voce encontrara aqui :)']);
		}
		print_r($dadosVeiculo); exit;
    }

    # Buscas Marcas no site seminovos se acordo com tipo
    public function carregaMarcas(Request $request) {

    	# Define URL baseando no tipo do veiculo para carregamento da marca
    	$dom = file_get_html($this->getUrl($request->get('tipoVeiculo')));

		$resultado = $dom->find('#marca', 0);
		$resultado->innertext =  str_replace('</option>', '/', $resultado->innertext);			 
		$marcas =  explode('/', strip_tags($resultado->innertext));
		unset($marcas[0]);
		return response()->json(['erro' => 'false', 'codigo' => '200', 'dados' => $marcas]);
    }

    private function getUrl($tipo, $path = null) {
    	if ($tipo == 'moto') {
    		return "https://www.seminovosbh.com.br/resultadobusca/index/veiculo/moto/marca/Yamaha/cidade/2700/usuario/todos";
    	} else if ($tipo == 'carro') {
    		return "https://www.seminovosbh.com.br/resultadobusca/index/veiculo/carro/marca/BMW/cidade/2700/usuario/todos";
    	} else if ($tipo == 'geral') {
			return  "https://www.seminovosbh.com.br/resultadobusca/index/veiculo/".$path['tipoVeiculo']."/marca/".$path['marcas']."/cidade/2700/usuario/todos";
    	}
    }
}