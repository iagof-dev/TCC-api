# Request URLS

#### Categoria

<details>
<summary>GET</summary>
<br>

  ```
  listar todas as categorias - /categoria/listar
  ```
  

</details>

<details>
<summary>POST</summary>
<br>
  
  ```
criar categoria - /categoria/inserir [name, icon]
WIP - remover categoria - /categoria/remover
WIP - modificar categoria - /categoria/modificar
  ```

</details>


### Pagamentos

<details>
<summary>POST</summary>
<br>
  
  ```
criar pagamentos - /pagamentos/criar [id_gateway, product_title, customer_email, value]
  ```

</details>



### Pedidos

<details>
<summary>GET</summary>
<br>
  
  ```
listar os pedidos feitos no site - /pedidos/ {id, seller, customer}
  ```

</details>

<details>
<summary>POST</summary>
<br>

  ```
  criar pedido - /pedidos/criar [customer_id, seller_id, seller_product_id, customer_email, status, date]
listar pedidos - /pedidos/listar [cid, sid]
  ```

</details>


### Produtos

<details>
<summary>GET</summary>
<br>
  
  ```
listar os produtos feitos no site - /produtos/ {id, owner, search}
  ```

</details>

<details>
<summary>POST</summary>
<br>
  
  ```
criar produto - /produtos/criar [customer_id, seller_id, seller_product_id, customer_email, status, date]
listar produtos - /produtos/modificar {title, description, price, image, id_category}
deletar produto - /produtos/deletar {title, description, price, image, id_category}
  ```
</details>


### Usuários

<details>
<summary>GET</summary>
<br>
  
  ```
listar os usuarios feitos no site - /usuario/ {id, email, name}
  ```
</details>

<details>
<summary>POST</summary>
<br>
  
  ```
criar usuario - /usuario/criar [username, email, pass, role, register_ip]
listar usuarios - /usuario/modificar {username, description, image}
deletar usuario - /usuario/deletar [id]
logar usuario - /usuario/logar
  ```
</details>
