# Portal RH Interno V3

Sistema web acadêmico desenvolvido em **PHP5** com **PostgreSQL** para cadastro e consulta de servidores.

## Funcionalidades

- login de acesso
- cadastro de servidores
- edição e exclusão
- consulta com busca por texto
- filtro por status
- visualização de detalhes

## Tecnologias

- PHP 5
- PostgreSQL
- HTML5
- CSS3
- XAMPP

## Estrutura

```
portal_rh_v3/
├── index.php
├── login.php
├── logout.php
├── cadastro.php
├── salvar.php
├── listagem.php
├── visualizar.php
├── excluir.php
├── conexao.php
├── auth.php
├── header.php
├── footer.php
├── database.sql
└── assets/
```

## Como executar

1. Coloque a pasta dentro de `C:\xampp\htdocs`.
2. Crie o banco `portal_rh` no PostgreSQL.
3. Execute o script `database.sql`.
4. Confirme a senha no arquivo `conexao.php`.
5. Inicie o Apache no XAMPP.
6. Acesse `http://localhost/portal_rh_v3`.

## Acesso padrão

- **Usuário:** admin
- **Senha:** 123456
