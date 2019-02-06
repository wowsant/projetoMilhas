<!DOCTYPE html>
<html>
    <head>
        <title>123 Milhas - Sant' Clair</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        {{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">--}}
    </head>
    <body>
        <form method="post" id="getCrawler">
            <div class="container mg-top40">
                <div class="jumbotron">
                    <h1 class="display-4">Crawler Seminovos BH</h1>
                    <p class="lead"></p>
                    <hr class="my-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="Tipo">Selecione o tipo do automovel</label>
                                <select name="tipoVeiculo" id="tipoVeiculo" class="form-control" required>
                                    <option value="">Selecione uma opção</option>
                                    <option value="carro">Carros</option>
                                    <option value="moto">Motocicletas</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="Tipo">Selecione o tipo do automovel</label>
                                <select name="marcas" id="marcas" class="form-control" required>
                                    <option value="">Escolha uma marca</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mg-top40" align="center">
                        <button class="btn btn-primary">Listar veiculos</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="container">
            <table class="table" id="dadosVeiculos">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Modelo</th>
                  <th scope="col">Preco</th>
                  <th scope="col">Fab/Mod</th>
                  <th scope="col">KM</th>
                  <th scope="col">Acessorio</th>
                  <th scope="col">Cor</th>
                  <th scope="col">Combustivel</th>
                </tr>
              </thead>
              <tbody>
                <!-- Modelos Inseridos dinamicamente apartir do Crawler -->
              </tbody>
            </table>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="/js/app-calls.js"></script>
    </body>
</html>

