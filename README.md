## Sistema de Tarefas To-Do List

### Descrição do Projeto
O Sistema de Tarefas To-Do List é uma aplicação web simples para gerenciar tarefas. Ele permite que os usuários façam login, adicionem, concluam e excluam tarefas. O sistema utiliza **PHP para o backend**, **MySQL como banco de dados** e **TailwindCSS para estilização**.

---
### Pré-requisitos
Antes de rodar o projeto, certifique-se de ter os seguintes itens instalados em sua máquina:
- **XAMPP** (ou outro servidor web com suporte a PHP e MySQL);
- **Navegador** (Google Chrome, Firefox, etc.);
- **MySQL Workbench** (opcional, para gerenciar o banco de dados).

---

### Como Rodar o Projeto? 
1. **Configurar o Ambiente**
- Instale o **XAMPP** e inicie os serviços **Apache e MySQL**.
- Coloque o projeto na pasta **htdocs** do XAMPP:
- Caminho: ```C:\xampp\htdocs\DesenvolvimentoDeSistemas\SistemaDeTarefasToDoList```

2. **Configurar o Banco de Dados**
- Abra o **MySQL Workbench** ou o **phpMyAdmin** (disponível no painel do XAMPP).
- **Crie o banco de dados e as tabelas** executando o seguinte script SQL:
    
    
    ```
    -- Criação do Banco de Dados
    CREATE DATABASE IF NOT EXISTS tarefas CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
    USE tarefas;

    -- Criação da tabela usuarios
    CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        usuario VARCHAR(50) NOT NULL UNIQUE,
        senha VARCHAR(255) NOT NULL
    );

    -- Criação da tabela tarefas
    CREATE TABLE IF NOT EXISTS tarefas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(100) NOT NULL,
        descricao TEXT,
        status ENUM('pendente', 'concluida') DEFAULT 'pendente',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        usuario_id INT NOT NULL,
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
    );

    -- Inserção de um usuário de teste
    INSERT INTO usuarios (usuario, senha) VALUES ('admin', MD5('123456'));
    ``` 

3. **Configurar o Arquivo de Conexão**
- Abra o arquivo conexao.php no diretório do projeto.
- Certifique-se de que as credenciais do banco de dados estão corretas conforme as informações abaixo:
    ```
    <?php
    $host = "localhost";
    $port = 3306;
    $db = "tarefas";
    $user = "root";
    $password = "ceub123456";

    try {
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erro na conexão com o banco de dados: " . $e->getMessage());
    }
    ?>

    ```

4. **Rodar o Projeto**
- Abra o navegador e acesse o projeto:
- Faça login com o usuário de teste:
- Usuário: ```admin```
- Senha: ```123456```

---

### Funcionalidades
- **Login**: Acesse o sistema com um usuário e senha;
- **Adicionar Tarefas**: Crie novas tarefas com título e descrição;
- **Concluir Tarefas**: Marque tarefas como concluídas;
- **Excluir Tarefas**: Remova tarefas do sistema;
- **Logout**: Encerre a sessão e volte para a tela de login.

---

### Estrutura do Projeto 

``` 
SistemaDeTarefasToDoList/
├── conexao.php          # Arquivo de conexão com o banco de dados
├── index.php            # Página inicial com a lista de tarefas
├── login.php            # Tela de login
├── logout.php           # Script para encerrar a sessão
├── nova.php             # Página para adicionar novas tarefas
├── concluir.php         # Script para concluir tarefas
├── excluir.php          # Script para excluir tarefas
├── layout.php           # Arquivo com funções de layout (header e footer)
└── README.md            # Documentação do projeto
``` 

---

### Tecnologias Utilizadas 

- **PHP**: Linguagem de programação para o backend;
- **MySQL**: Banco de dados relacional;
- **TailwindCSS**: Framework CSS para estilização;
- **XAMPP**: Ambiente de desenvolvimento local.

--- 

### Licença 
Este projeto é de uso livre para fins educacionais e pessoais. Sinta-se à vontade para modificar e expandir conforme necessário.