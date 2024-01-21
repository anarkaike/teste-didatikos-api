# Descrição do Teste
## Backend

Criar uma api para realizar o gerenciamento de um produto.

### Campos de Produtos
- Cod Produto - integer  
- Nome produto - string  
- Valor Produto - float  
- Marca Produto - (chave estrangeira) - int    
- Estoque - float  
- Cidade (Chave estrangeira) - int  

### Campos de Cidade
- cod Cidade - integer pk  
- nome Cidade - string  

### Campos de Marca
- cod Marca - integer pk
- nome Marca - string
- Fabricante - string

A partir desse cadastro um recurso REST para gerenciamento desse modelo com os seguintes métodos devem estar disponíveis:

- GET  - Lista todos os produtos  
- GET  - Busca um produto por id  
- POST  - Cria um novo produto  
- PUT  - Edita um produto  
- DELETE  - Deleta um produto  
- GET - Lista todas as cidades  

## Front-end

Agora que nossa api já está feita, precisamos fazer um front-end para conversar com essa api.

O projeto do frontend, deverá ser feito com o framework que você está mais familiarizado.

Implementar no front um filtro dinâmico para esses produtos, como por exemplo, média dos valores dos produtos,
soma de todos os produtos, filtrar do valor de x até y, produtos por cidade,
Não permitir excluir produto que tenha estoque.


Validações de campos obrigatórios no cadastro do produto: Nome, Valor, Cidade, e restrição de unicidade também, para permitir apenas um produto com o mesmo


O projeto Backend devera ser feito em laravel com o banco de dados mysql, Front vuejs.

Implementar teste unitário.

Utilizar as técnicas de clean code e orientação a objetos S.O.L.I.D

Após o fim do projeto disponibilizar no github.

A data limite de entrega do projeto será de 7 dias a partir do recebimento do teste.


## Entregas:

### Diagrama
https://dbdiagram.io/d/TesteDidatikos-65ab1a55ac844320ae520c2d

### Documentação da API
https://documenter.getpostman.com/view/9737921/2s9YsT6oFm

### Testes

1. Gere a base de dados sqlite para rodar os tests
    ````
    php artisan migrate --env=testing
    ````

2. Execute os testes
    ````
    php artisan test
    ````
