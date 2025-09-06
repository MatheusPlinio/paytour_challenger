# Arquitetura e Desenvolvimento do Projeto

Este documento descreve a arquitetura do projeto e as instruções para executá-lo em modo de desenvolvimento utilizando o [Laravel Sail](https://laravel.com/docs/10.x/sail).

## Arquitetura do Projeto

O projeto segue uma arquitetura MVC (Model-View-Controller) com os seguintes componentes principais:

*   **Frontend:**
    *   Utiliza o [Vue.js](https://vuejs.org/), um framework para construir aplicações web com Vue.js, para renderizar as interfaces de usuário.
    *   Rotas de autenticação (login, registro, etc.) e páginas de gerenciamento (dashboard, etc.) são gerenciadas pelo frontend.
*   **Backend (API):**
    *   Construído com o Laravel, um framework PHP para desenvolvimento web.
    *   **Controllers (Controladores):** Responsáveis por receber as requisições HTTP, interagir com os Models e retornar as respostas.
    *   **Models (Modelos):** Representam a estrutura de dados do projeto, interagindo com o banco de dados.
    *   **Repositories (Repositórios):** Abstraem o acesso aos dados, permitindo flexibilidade e testabilidade.
    *   **Services (Serviços):** Contêm a lógica de negócios da aplicação, separando-a dos Controllers.
*   **Banco de Dados:**
    *   Utiliza o MySQL como banco de dados para armazenar os dados da aplicação (usuários, informações de job applications, etc.).
*   **Autenticação:**
    *   Implementada utilizando as funcionalidades de autenticação nativas do Laravel.
    *   Suporte à autenticação com token (JWT - JSON Web Token).

## Componentes Principais

*   **`app/Http/Controllers`:** Contém os controladores que gerenciam a lógica da aplicação, como autenticação, gerenciamento de usuários e outras operações.
*   **`app/Models`:** Contém os modelos que representam as tabelas do banco de dados.
*   **`app/Repositories`:** Contém os repositórios que abstraem o acesso aos dados.
*   **`app/Services`:** Contém a lógica de negócios da aplicação separada dos controladores.
*   **`routes/api.php`:** Define as rotas da api Restful.
*   **`resources/js`:** Contém os arquivos de view (templates) que renderizam a interface de usuário.
*   **`config/`:** Contém arquivos de configuração da aplicação.
* **`app/Mail`:** Contém classes relacionadas ao envio de e-mails, como o `JobApplicationReceived` para notificações.

## Configuração e Execução com Laravel Sail

O Laravel Sail é uma ferramenta que simplifica a configuração e o gerenciamento de um ambiente de desenvolvimento Laravel.

### Pré-requisitos

*   [Docker](https://www.docker.com/get-started)
*   [Docker Compose](https://docs.docker.com/compose/install/)

### Instalação e Execução

1.  **Clone o repositório:**

    ```bash
    git clone https://github.com/MatheusPlinio/paytour_challenger.git
    cd paytour_challenger
    ```

2.  **Configurar o banco de dados:**

    *   Edite o arquivo `.env` e configure as variáveis de ambiente do banco de dados:

        ```
        DB_CONNECTION=mysql
        DB_HOST=mysql
        DB_PORT=3306
        DB_DATABASE=laravel
        DB_USERNAME=root
        DB_PASSWORD=password
        ```

3.  **Executar o Sail:**

    ```bash
    ./vendor/bin/sail up -d
    ```

    Este comando irá construir e iniciar os contêineres Docker necessários para executar a aplicação.  `-d` executa os contêineres em segundo plano.

4.  **Acessar a aplicação:**

    A aplicação estará disponível em `http://localhost`.

5.  **Executar comandos no contêiner:**

    Você pode acessar o contêiner Docker para executar comandos, como rodar migrations ou seeds:

    ```bash
    ./vendor/bin/sail key:generate
    ./vendor/bin/sail artisan migrate
    ./vendor/bin/sail artisan db:seed
    ```

### Estrutura do Projeto

```
meu-projeto/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Auth/
│   ├── Models/
│   ├── Repositories/
│   └── Services/
├── public/
│   └── index.php
├── resources/
│   └── views/
├── routes/
│   └── api.php
├── .env
├── .gitignore
└── composer.json
```

## Observações

*   Certifique-se de ter as versões corretas do PHP, Node.js e Docker instaladas.  Consulte a documentação do Laravel Sail para obter mais informações sobre as versões recomendadas.
*   Para rodar testes, utilize o comando:  `./vendor/bin/sail artisan test`
*   É necessario para rodar o front end o comando: `./vendor/bin/sail npm run dev`
* Para rodar o servidor de desenvolvimento em modo de depuração, utilize o comando: `./vendor/bin/sail artisan serve`

Este README fornece uma visão geral da arquitetura e configuração do projeto. Para informações mais detalhadas, consulte a documentação do Laravel e do Laravel Sail.