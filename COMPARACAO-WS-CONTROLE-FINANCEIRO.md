# Comparação com WS Controle Financeiro (auditoria de código)

## Sistema antigo: ProjetoContas
- PHP/MySQL; campos de contas incluem descrição, valor, mês, ano e imagem/arquivo chamado foto.
- Cadastro, listagem, pesquisa, edição e exclusão.
- Falta autenticação, proteção de upload e isolamento de dados por usuário.
- Pesquisa permite escolher nome de coluna pelo POST sem whitelist; precisa correção.
- Conexão local com root e senha vazia no código; não usar em produção.

## Sistema atual: controle-financeirows
- Node.js/Express/PostgreSQL com autenticação JWT, usuários, categorias e lançamentos.
- Tabela transactions já tem colunas paid, receipt_path e boleto_code.
- Há rotas /api/bills/matches e lógica de boletos. **Não duplicar essas funcionalidades sem verificar o fluxo existente.**
- Não foi encontrada rotina de upload multipart no server.js na inspeção inicial; receipt_path sozinho não comprova suporte a anexos.
- A ausência de CPF no servidor inspecionado não comprova que a funcionalidade de consulta externa esteja implementada em outro serviço.

## Decisão
**Não alterar o sistema atual nem migrar registros automaticamente.** O código antigo não oferece uma funcionalidade inédita suficiente para justificar uma segunda aplicação financeira.

## Trabalho futuro
1. Auditar as rotas de boletos e autorização por usuário no backend atual.
2. Verificar anexos/comprovantes e definir armazenamento privado com validação de arquivo.
3. Adicionar recurso de anexos somente se houver necessidade confirmada e com migração compatível.
4. Conectar banco apenas em etapa aprovada, com backup e testes de integração.

Esta é uma análise estática de repositórios; não representa teste de produção.