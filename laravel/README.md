# Desafio Proposto: Crud 

- Elaborar um CRUD simples para as tabelas de matricula, curso, aluno
- Permitir ativar/desativar um aluno
- As migrations já estão criadas
- Testes unitário, PSR-12 contam pontos a mais
- Para o front fique a vontade entre usar Vue.js ou somente as blades do Laravel

### Observações

Eu tentei caprichar ao máximo em relação a funcionalidades, porém por conta do pouco tempo disponível (apenas um fim de semana)
acabei entregando menos do que gostaria, eu não consegui implementar os testes automatizados, eram fáceis pelo projeto proposto,
mas acabei focando nas funcionalidades.

Também não fiz implementação de interfaces de nenhum tipo, não me pareceu um cenário onde se justificasse a aplicação dessa camada.

Tendo essas observações em vista, sigamos ao projeto:

### Tecnologias

Para desenvolver esse projeto eu utilizei:
- Laravel 8.0
- PHP 8.0
- Laravel Sail (Docker)
- Laravel Breeze (Autenticação)
- InertiaJS
- VueJS
- Ziggy
- MySQL

## Instalação

Para rodar o projeto primeiro deve-se configurar o arquivo .env, apenas 
realizando a cópia do arquivo .env.example renomeando-a para .env

Após essa etapa, configure as variáveis de ambiente de conexão ao BD da seguinte forma:

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_app
DB_USERNAME=sail
DB_PASSWORD=password
```

Isso irá preparar a aplicação para se conectar ao container de banco de dados 

Após essa configuração subir os containers da aplicação com o comando

```
docker-compose up -d
```

Ao terminar o processo, entre no container e execute a instalação dos pacotes pelo composer

```
docker exec -it {nome_container_app} bash
composer install
```

ou utilizando Sail

```
./vendor/bin/sail composer install
```

Claro, será necessário subir as migrations para que as tabelas sejam criadas no banco de dados,
dentro do container docker execute o comando:

```
php artisan migrate
ou
./vendor/bin/sail artisan migrate
```

Para gerenciar toda parte de autenticação de usuário utilizei o [Laravel Blaze](https://laravel.com/docs/8.x/starter-kits#laravel-breeze)
esse pacote além de lidar com a autenticação já faz toda configuração pra uso do VUE com Inertia e Ziggy no Front-End

Após rodar as migrations realizar os comandos a seguir para instalar os pacotes Node necessários e realizar a compilação do Front-End

```
npm install
npm run dev
```
Esse projeto foi iniciado utilizando [Laravel Sail](https://laravel.com/docs/8.x/sail)

Logo é possível executar os comandos dentro de um container sem necessariamente estar dentro dele, ex:

```
./vendor/bin/sail artisan
```

Terá o mesmo efeito.

Também é recomendado inicializar o sistema com alguns cadastros já efetuados e com a conta admin criada para isso apenas rode:

```
php artisan db:seed
```
ou
```
./vendor/bin/sail artisan db:seed
```

Para garantir funcionamento ainda há 2 coisas a serem feitas.

Primeiro dar permissão de escrita para a pasta storage e no arquivo .env, entre no container e execute:

```
chmod 777 -R storage/
chmod 777 .env
```

Pra finalizar, você precisará gerar uma Key para isso execute o comando

```
./vendor/bin/sail artisan key:generate
```

> Se tudo der certo já será possível acessar a aplicação pela url: http://localhost sem erros

## Áreas Restritas

O sistema possui 2 áreas restritas, aluno e administrador, porém o acesso é unificado, identificando automaticamente
o tipo de usuário.

### Administrador

Atribuíções:
- CRUD de Cursos
- CRUD de Alunos
- CRUD de Matrículas

> Acesso: http://localhost
> 
> Login: admin@localhost.com
> 
> Senha: master

### Alunos

Atribuições:
- Alterar dados pessoais
- Matricular-se em cursos disponíveis

> Acesso: http://localhost
> 
> A senha de todos os alunos criados pelo seeder é: teste
