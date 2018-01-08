

# Dev Test

A aplicação foi separada em 2 projetos: API e Front. <br/>
 - <b>API</b>: <br/> 
Na API Rest contém toda a lógica de autenticação, onde é possível gerar um token, remover e recuperar os dados
desse token. <br />
O CRUD de Pessoa, onde o acesso é controlado por uma middleware exigindo que o cliente envie o token
de autenticação para acessar essas rotas. <br />
Também faz a intermediação entre a aplicação Front e a API Roulette Netflix, isso porque devido a exigências
de segurança as requisiçōes Ajax são negadas em domínios diferentes da aplicação em que está sendo rodada, exigindo
que o servidor que esta recebendo a requisição permita tais requisiçōes (permitindo o Controle de Acesso HTTP - Cors
de aplicaçōes externas), já nas requisiçōes via PHP esse problema não é encontrado. <br />
<br />
 - <b>Front</b>: <br/> 
A aplicação Front contém uma tela de login na qual é feita uma autenticação na API e após autenticado cria uma sessão com esse Token. <br />
Na tela principal existem 2 abas: <br />
***Netflix***: Faz a integração com a API Roulette Netflix, onde é possível buscar aleatoriamente um filme/série da netflix com alguns filtros disponíveis (para acessar o filme na netflix o mesmo precisa estar no catálogo Brasileiro e o usuário precisa ter uma conta na Netflix). <br />
***API***: Exibe uma documentação completa da API Rest integrada com essa aplicação. <br >
<br />
<br />
=========================================  <br />
<br />
<b>Instalação</b> <br />
- <b>API</b> <br />
- Rodar o comando <b>composer install</b> para instalar as dependências do PHP. <br />
- Dar as devidas permissōes de acesso as pastas *storage*, *bootstrap* e *public*. <br />
- Copiar o arquivo de ambiente *.env.example* com o nome *.env*. <br />
- Rodar o comando <b>php artisan key:generate</b> para gerar uma chave a aplicação. <br />
- Rodar o comando <b>php artisan serve --port 8001</b> para que a aplicação comece a rodar na porta 8001 (http://localhost:8001). <br />
<br />
- <b>Front</b> <br />
- Rodar o comando <b>composer install</b> para instalar as dependências do PHP. <br />
- Rodar o comando <b>npm run dev</b> para que o webpack gere os pacotes de recursos usados na aplicação. <br />
- Dar as devidas permissōes de acesso as pastas *storage*, *bootstrap* e *public*. <br />
- Copiar o arquivo de ambiente *.env.example* com o nome *.env*. <br />
- Rodar o comando <b>php artisan key:generate</b> para gerar uma chave a aplicação. <br />
- Rodar o comando <b>php artisan serve --port 8000</b> para que a aplicação comece a rodar na porta 8000 (http://localhost:8000). <br />
<br />

--------------------------------------------------
<br />
<b>Tecnologias utilizadas</b> <br />
- PHP 7.0 <br />
- Laravel 5.5 <br />
- Node v7.4.0 & Npm v4.0.5 <br />
- Angular / JQuery <br />
- Token-based Authorization <br />
- Session <br />
- Rest API <br />
- GuzzleHttp Client Request <br />
- Bootstrap <br />
- Composer <br />
- Webpack Automation