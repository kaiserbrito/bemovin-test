# webx-crawler

### Clone o projeto
git clone https://github.com/rennanribeiro/webx-crawler.git

### Altere o acesso ao banco
No arquivo _app/Config/Database.php_ modifique os dados de acesso ao banco de dados.

### Utilização:
- Acesse o projeto utlizando o nevegador.
- No terminal, na pasta raiz do projeto, rode: _./app/Console/cake crawler_ 
- _control + c_ no terminal para finalizar as buscas na paginas

### Pré-requisito

- php -v >= 5.2.9

### Banco de dados

Sugiro seguir:

CREATE DATABASE `webx`;
USE `webx`;

CREATE TABLE `webx`.`urls`(
	`id` INT NOT NULL AUTO_INCREMENT ,
	`url` text ,
	`visited` ENUM('yes','no') DEFAULT 'no' ,
	PRIMARY KEY (`id`) );

CREATE TABLE `webx`.`emails`(
	`id` INT NOT NULL AUTO_INCREMENT ,
	`email` VARCHAR(255) ,
	PRIMARY KEY (`id`)  );

-- exemplo de URL inicial
INSERT INTO `webx`.`urls`(url) VALUES('https://www.google.com.br/?gfe_rd=ctrl&ei=9xcNU6uRGYfJ8Qa-moHwAg&gws_rd=cr#q=webx&safe=off');







