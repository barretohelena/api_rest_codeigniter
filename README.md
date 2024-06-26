# Api Rest Com CodeIgniter 4

## Sobre o projeto

O projeto permite todo o processo de CRUD para clientes, produtos e pedidos através de uma API REST 
utilizando o framework CodeIgniter 4, juntamente com a utilização do banco de dados MySQL. Para 
facilitar a execução do projeto localmente, foi utilizado o Docker para a geração do ambiente de 
desenvolvimento.

## Instalação e configuração
Após clonar o repositório, para a execução do projeto é necessário o [docker](https://docs.docker.com/engine/install/)
instalado e configurado na máquina.

Na raiz do projeto execute o seguinte comando
`docker compose up -d` para subir os containers do php8 com apache e mysql8.

Depois disso renomeie o arquivo `env` para `.env` nesse arquivo estão as informações para a conexão com o banco de dados
e geração do token de acesso, caso não for alterado nada do container, basta renomear o arquivo e usar as mesmas informações
já contidas no arquivo, caso contrário se atente para altera-las.

Posteriormente execute o seguinte comando
`docker exec -it php8 bash` que te levará para dentro do container.

Agora vamos executar o comando `composer install` para instalar as dependências.

Na sequência execute o comando `php spark migrate` para a criação das tabelas no banco de dados.

E por fim execute o comando `php spark db:seed DatabaseSeeder` para inserir alguns registros de testes nas tabelas.

## Documentação
A documentação sobre a utilização dos endpoints estão aqui [documentação api_rest_codeigniter](https://documenter.getpostman.com/view/36554032/2sA3drHEdk)

#### Diagrama banco de dados
