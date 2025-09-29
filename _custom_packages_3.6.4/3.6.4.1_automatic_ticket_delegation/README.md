# HESK Plus - Pacote 3.6.4.1

## Customer Category Assignment

### 📋 Sobre este Pacote

Este pacote adiciona funcionalidade de **associação automática de categoria por cliente** ao HESK 3.6.4, permitindo que tickets criados via e-mail sejam automaticamente categorizados baseado no cliente remetente.

### 🚀 Funcionalidades

- ✅ Campo categoria no cadastro de clientes
- ✅ Associação automática de categoria por e-mail do cliente
- ✅ Delegação automática via sistema nativo do HESK
- ✅ Compatível com qualquer prefixo de tabela do banco

### ⚠️ BACKUP OBRIGATÓRIO

**ANTES DE QUALQUER INSTALAÇÃO:**
- Faça backup completo dos arquivos do HESK
- Faça backup completo do banco de dados
- Mantenha os backups em local seguro

### 📦 Instalação

#### Pré-requisitos
- HESK 3.6.4 (versão exata)
- Acesso ao banco de dados MySQL/MariaDB
- Acesso aos arquivos do servidor

#### Passo 1 — Banco de Dados (Migração)
1. Acesse seu banco de dados (phpMyAdmin, MySQL Workbench, CLI, etc.)
2. Execute o script `database/migration.sql` no banco configurado no `hesk_settings.inc.php`
3. Verifique se as alterações foram aplicadas corretamente

#### Passo 2 — Arquivos (Sobreposição)
1. Extraia o conteúdo da pasta `files/` **diretamente na raiz da instalação do HESK**
2. A pasta raiz é onde ficam `index.php`, `admin/`, `inc/`, etc.
3. Confirme que a estrutura de diretórios foi mantida
4. Apenas os arquivos do pacote devem ser sobrepostos/adicionados

#### Passo 3 — Verificações
1. Limpe caches do navegador
2. Acesse o HESK e valide as novas funcionalidades
3. Teste a criação de tickets via e-mail
4. Verifique se a categorização automática está funcionando

### 🔄 Rollback (Se Necessário)

#### Reverter Arquivos
1. Restaure os arquivos a partir do backup realizado antes da instalação
2. Confirme que todos os arquivos originais foram restaurados

#### Reverter Banco de Dados
1. Restaure o banco de dados a partir do backup realizado antes da migração
2. Verifique se todas as tabelas voltaram ao estado original

### 📁 Estrutura do Pacote

```
hesk-3.6.4.1-custom/
├── database/
│   └── migration.sql              # Script de migração do banco
├── files/
│   ├── admin/
│   │   ├── manage_customers.php.old     # Original preservado
│   │   └── manage_customers.php         # Versão modificada
│   └── inc/
│       ├── mail/
│       │   ├── pop3.php.old             # Original preservado
│       │   └── pop3.php                 # Versão modificada
├── README.md                      # Este arquivo
└── LICENSE.md                     # Licença do pacote
```

### 🔧 Como Funciona

1. **Cadastro de Cliente**: Adiciona campo "Categoria" no formulário
2. **E-mail Recebido**: Sistema consulta categoria do cliente pelo e-mail
3. **Ticket Criado**: Categoria é aplicada automaticamente ao ticket
4. **Delegação**: Sistema nativo do HESK delega para agentes da categoria

### 🗃️ Banco de Dados

- **Tabela modificada**: `{prefixo}customers`
- **Campo adicionado**: `customer_category` (INT, FK para categories)
- **Detecção automática**: Script detecta prefixo da tabela automaticamente

### 🆘 Suporte

- Verifique os logs do HESK em caso de problemas
- Mantenha sempre backups atualizados
- Teste em ambiente de desenvolvimento antes de aplicar em produção

### 📄 Licença

Consulte o arquivo `LICENSE.md` para informações sobre licenciamento.