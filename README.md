# Crawler-b

O Crawler-b é um teste que visa simular, minimamente, o ambiente que você encontrará no seu dia a dia na **Bemovin**. 

*Este projeto não tem uso comercial, serve apanas para avaliarmos a capacidade de resolver problemas e a qualidade do código escrito.*

## Descrição

Construiremos um "crawler" simples de e-mails, com uma interface web que acompanha o status do processamento.

O teste pode ser dividido em 3 áreas: 
- **Frontend** onde exibiremos o resultado do processamento
- **Backend Legado** sistema legado do crawler escrito em php, seu propósito, hoje, é apenas disponibilizar uma API para ser consumida no frontend.
- **Backend Rails** aqui ficará todo o código do crawler e a interface gráfica.

## Frontend

- O layout está localizado na pasta design.
- Você deve desenvolve-lo no projeto Rails.
- Tente desenvolver a página minimamente responsiva. (Não se apegue as proporções, apenas mantenha o conceito visual.)
- As informações: *email, url visitada e url capturadas*, assim como a tabela  dos últimos 10 e-mails devem ser populados no front utilizando **AJAX** de tempos em tempos *(a cada 1 segundo)*.
- A logo da Bemovin já está recortada. (*app/new_crawler_b/app/assets/images/logo-bemovin.png*).
- Enquanto o crawler estiver rodando o botão "iniciar" deve mudar para "parar".


## Backend Legado (PHP)

No seu dia a dia será necessário dar manutenção a um código PHP 
legado, por isso pensamos em um desafio. 

- O desafio é corrigir um bug simples na resposta da API.
- O projeto está em cakephp 2.x
- A única função deste projeto legado é dispor uma API para o front.
- Acesse: http://localhost/emails/get_emails


## Backend Rails

Aqui você desenvolverá o crawler propriamente dito e a interface gráfica (front) da aplicação:  

Diretrizes:

- Leia do banco de dados uma URL para consulta.
- Faça o download do conteúdo desta URL.
- Encontre dentro do conteúdo desta página todos os links para outras páginas e adicione no banco de dados.
- Encontre todos os emails existentes no texto desta página e adicione no banco de dados
- Marque a URL corrente como visitada.
- Repita o processo até que não existam mais URLs não visitadas no banco de dados.

### Notas:
- Rode o crawler em background. Recomendamos que utilize o sidekiq para isso: (https://github.com/mperham/sidekiq) para rodar o crawler em background.
- Pare o crawler se a flag na "activated" na tabela "Settings" for false.
- Fique a vontade para utilizar qualquer outra gem.
- Se quiser, você pode usar o scan para encontrar todos os e-mails em uma pagina ex. `.scan(/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i)`
- Não salve URL ou e-mail duplicado.

## Ambiente

Disponibilizamos um ambiente provisionado com **Docker**. Fique a vontade caso queira usar outra solução.

## Setup

Download do projeto:

`git clone git@gitlab.com:bemovin-public/crawler-b.git`

Caso esteja usando docker *(Recomendado)*, certifique-se de estar com a ultima versão e de ter docker-composer instalado.

Iniciando o ambiente completo:

`docker-compose up --build`

Para rodar as aplicações separadas utilize: 
 - new-crawler-b (Rails): `docker-compose up new-crawler-b`
 - crawler-b (PHP): `docker-compose up crawler-b`
 - sidekiq (Rails Sidekiq): `docker-compose up sidekiq`

Para rodar os presets do banco:

`docker-compose run new-crawler-b rake db:create db:migrate db:seed`

Para acessar o console do rails

`docker-compose run new-crawler-b rails c`

Para acessar o bash 

`docker-compose run new-crawler-b sh`


*As dependências **mysql e redis** subirão sozinhas conforme a necessidade.*

> Lembre-se de que você precisa estar na pasta `app` para executar os comandos do docker-composer.

## Entrega e Dúvidas

- Envie sua solução para um repositório publico no seu github (ou equivalente). 
- Envie um e-mail com o link do github para: rennan.ribeiro@bemovin.com.br e danilo.viterbo@bemovin.com.br.


> Em caso de dúvidas, entre em contato por e-mail: rennan.ribeiro@bemovin.com.br ou danilo.viterbo@bemovin.com.br


# Boa sorte!
