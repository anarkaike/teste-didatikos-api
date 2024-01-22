# Descrição

Api para realizar o gerenciamento de um produto.

## Diagrama DER
https://dbdiagram.io/d/TesteDidatikos-65ab1a55ac844320ae520c2d

## Documentação da API
https://documenter.getpostman.com/view/9737921/2s9YsT6oFm

### Testes automatizados

1. Para gerar a base de dados sqlite para rodar os tests
    ````
    php artisan migrate --env=testing
    ````

2. Execute os testes
    ````
    php artisan test
    ````
   
