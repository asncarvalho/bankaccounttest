# Simples Bank

>Status : Concluído. ✔️

### Um app contendo CRUD de cadastro para abertura de conta bancária, com validação de CPF.

## Os campos do modelo principal (Usuário) são:

+ name
+ cpf 
+ email
+ bank_balance
+ account_number


## Tecnologias Usadas

<table>
    <tr>
        <td>PHP</td>
        <td>Laravel</td>
        <td>jQuery</td>
        <td>Composer</td>
        <td>MySQL</td>
        <td>Bootstrap</td>
        <td>jQuery DataTable</td>
        <td>Chart.js</td>
    </tr>
    <tr>
        <td>8.*</td>
        <td>8.75^</td>
        <td>3.6.0</td>
        <td>2.0</td>
        <td>4.6</td>
        <td>1.11.3</td>
        <td>2.6.0</td>
    </tr>
</table>

Como rodar a aplicação?

1) na linha de comando: composer install
2) crie um banco de dados chamado 'bank_account'
3) configurar as variáveis de desenvolvimento no .env
4) rode o comando : php artisan migrate
5) rode o comando : php artisan serve
   

Através do Laravel/Auth, é possível criar uma conta e aproveitar todas as funcionalidades do aplicativo.

