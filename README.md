

# Dev Test

A aplicação foi separada em 2 projetos: API e Front. 
 * **API**:  
Na API Rest contém toda a lógica de autenticação, onde é possível gerar um token, remover e recuperar os dados
desse token. 
O CRUD de Pessoa, onde o acesso é controlado por uma middleware exigindo que o cliente envie o token
de autenticação para acessar essas rotas. 
Também faz a intermediação entre a aplicação Front e a API Roulette Netflix, isso porque devido a exigências
de segurança as requisiçōes Ajax são negadas em domínios diferentes da aplicação em que está sendo rodada, exigindo
que o servidor que esta recebendo a requisição permita tais requisiçōes (permitindo o Controle de Acesso HTTP - Cors
de aplicaçōes externas), já nas requisiçōes via PHP esse problema não é encontrado. 

 * **Front**:  
A aplicação Front contém uma tela de login na qual é feita uma autenticação na API e após autenticado cria uma sessão com esse Token. 
Na tela principal existem 2 abas: 
***Netflix***: Faz a integração com a API Roulette Netflix, onde é possível buscar aleatoriamente um filme/série da netflix com alguns filtros disponíveis (para acessar o filme na netflix o mesmo precisa estar no catálogo Brasileiro e o usuário precisa ter uma conta na Netflix). 
***API***: Exibe uma documentação completa da API Rest integrada com essa aplicação.

As credencias de autenticação para testes são:
**Usuario**: admin
**Senha**: admin


--------------------------------------------------  

**Instalação** 
* **API** 
- Rodar o comando **composer install** para instalar as dependências do PHP. 
- Dar as devidas permissōes de acesso as pastas *storage*, *bootstrap* e *public*. 
- Copiar o arquivo de ambiente *.env.example* com o nome *.env*. 
- Rodar o comando **php artisan key:generate** para gerar uma chave a aplicação. 
- Rodar o comando **php artisan serve --port 8001** para que a aplicação comece a rodar na porta 8001 (http://localhost:8001). 

* **Front** 
- Rodar o comando **composer install** para instalar as dependências do PHP. 
- Rodar o comando **npm run dev** para que o webpack gere os pacotes de recursos usados na aplicação. 
- Dar as devidas permissōes de acesso as pastas *storage*, *bootstrap* e *public*. 
- Copiar o arquivo de ambiente *.env.example* com o nome *.env*. 
- Rodar o comando **php artisan key:generate** para gerar uma chave a aplicação. 
- Rodar o comando **php artisan serve --port 8000** para que a aplicação comece a rodar na porta 8000 (http://localhost:8000). 


--------------------------------------------------

**Tecnologias utilizadas** 
- PHP 7.0 
- Laravel 5.5 
- Node v7.4.0 & Npm v4.0.5 
- Angular / JQuery 
- Token-based Authorization 
- Session 
- Rest API 
- GuzzleHttp Client Request 
- Bootstrap 
- Composer 
- Webpack Automation
