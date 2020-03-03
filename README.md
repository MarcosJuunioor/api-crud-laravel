# Tutorial - Como construir uma API CRUD com Laravel

## Propósito
O projeto em tela tem como propósito exemplificar a construção de uma API CRUD com o Framework Laravel, visto que é difícil encontrar bons materiais ou exemplos na internet. 

## Requisitos
- Ubuntu 18.04 lts (ou outra distribuição Linux)
- PHP >= 7.2.5
- Servidor Apache
- Composer (o Laravel usa o Composer para gerenciar suas dependências)

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
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

- 


https://laravel.com/docs/7.x
https://stackoverflow.com/questions/23411520/how-to-fix-error-laravel-log-could-not-be-opened
https://getcomposer.org/doc/00-intro.md

