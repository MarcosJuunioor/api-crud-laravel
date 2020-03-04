# Tutorial - Como construir uma API CRUD com Laravel

## Propósito
O projeto em tela tem como propósito exemplificar a construção de uma API CRUD com o Framework Laravel, visto que é difícil encontrar bons materiais ou exemplos na internet. 

## Requisitos
- Ubuntu 18.04 lts (ou outra distribuição Linux)
- PHP >= 7.2.5
- Servidor Apache
- Composer (o Laravel usa o Composer para gerenciar suas dependências)
- Ter alguma noção do padrão MVC

## Passo a passo para criação e configuração do projeto
- Torne-se root: <br>
sudo su

- Crie o projeto via Composer <br>
Navegue até o diretório /var/www/html e execute o seguinte comando:<br>
composer create-project laravel/laravel NOME_DO_PROJETO_AQUI 

- Altere as permissões do diretório do projeto: <br>
chown -R $USER:www-data storage <br>
chown -R $USER:www-data bootstrap/cache <br>
chmod -R 775 storage <br>
chmod -R 775 bootstrap/cache <br>

- Configure o diretório raiz do apache para ser o do seu projeto <br>
Navegue até o diretório /etc/apache2/sites-available e abra o arquivo 000-default.conf. Em seguida, altere a linha "DocumentRoot" para "DocumentRoot /var/www/html/NOME_DO_SEU_PROJETO/public/index.php/". Salve e feche o arquivo.

- Reinice o apache:<br>
service apache2 restart 

- Teste o Projeto:<br>
Digite "localhost:8080" no navegador. Neste ponto, deverá ser exibida a página inicial do projeto, com o nome Laravel e alguns links.

## Passo a passo para criação da API Rest CRUD
- Configure o projeto para o banco de dados de sua preferência. Neste caso, iremos usar o MySql. Para isso, acesse o arquivo ".env" e altere as configurações padrões:<br>
DB_CONNECTION=mysql <br>
DB_HOST=127.0.0.1 <br>
DB_PORT=3306 <br>
DB_DATABASE=laravel <br>
DB_USERNAME=root <br>
DB_PASSWORD= <br>

- Crie um Model de teste (neste caso, vou criar um Model chamado Pessoa)<br>
Para isso, navegue até o diretório do seu projeto e execute o seguinte comando (no terminal):<br>
php artisan make:model Pessoa --migration

- Crie um Controller para o Model criado anteriormente
Ainda no diretório do projeto, execute o seguinte comando: 
php artisan make:controller PessoaController

- Abra o seu projeto com alguma IDE (pode ser o Sublime) <br>
- Vá até o diretório "App" dentro do seu projeto e acesse o Model Pessoa <br>
Coloque o seguinte código dentro do corpo da classe:<br>
    protected $fillable = [
        'nome', 'cpf', 'telefone',
    ]; <br>
Esses serão os dados necessários para se criar um registro de Pessoa no banco. Ou seja, deverão ser passados como parâmetros nas requisições.

- Vá até o diretório database/migrations e abra a migration correspondente ao Model Pessoa <br>
Coloque o código abaixo como a função "function up": <br>
## 
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 100);
            $table->string('cpf', 11);
            $table->string('telefone', 45);
            $table->timestamps();
        });
    }
- No terminal, digite o seguinte comando: <br>
php artisan migrate <br>
Neste ponto, a tabela pessoa deverá ser criada no banco de dados. O próximo passo é a codificação do Controller.

- Vá até o diretório app/Http/Controllers/ e acesse o arquivo PessoaController <br>
Coloque o código abaixo dentro da classe Controller: <br>
## 
    public function index()
    {
        return Pessoa::all();
    }


    public function store(Request $request)
    {
        $dados = $request->all();
        return Pessoa::create($dados);
    }

    public function update(Request $request, $id)
    {
        $pessoa = Pessoa::findOrFail($id);
        if($pessoa->update($request->all())){
            return $pessoa;
        }else{
            return "error";
        }

    }

    public function destroy($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        return $pessoa->destroy($id);
    }

Obs: Cada uma das funções executa uma das operações de CRUD. Index lista, Store cria, Update atualiza e Destroy deleta.

- Configure a rota <br>
Vá até o diretório "routes" e acesse o arquivo "api.php". Nele, adicione a seguinte rota: <br>
Route::apiResource("pessoas", "PessoaController"); <br>
Ou seja, o controller "PessoaController" atenderá as requisições feitas na url "host/api/pessoas". <br>

## Documentação da API
- Cadastro de pessoa <br>
Chamar por post a url "localhost/api/pessoas", passando os parâmetros "nome, cpf e telefone".

- Listagem de pessoas <br>
Chamar por get a url "localhost/api/pessoas".

- Deletar pessoa <br>
Chamar por delete a url "localhost/api/pessoas", passando o id da pessoa na url. Exemplo: localhost/api/pessoas/1. Ou seja, a pessoa de id = 1 será deletada.

- Atualizar pessoa <br>
Chamar por patch a url "localhost/api/pessoas", passando o id da pessoa na url e os dados de atualização no pacote http.


## Referências

https://laravel.com/docs/7.x <br>
https://stackoverflow.com/questions/23411520/how-to-fix-error-laravel-log-could-not-be-opened <br>
https://getcomposer.org/doc/00-intro.md

