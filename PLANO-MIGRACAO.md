# ProjetoContas — migração planejada

Este repositório contém um sistema PHP/MySQL legado de controle de contas e boletos. Não está pronto para publicação.

## Diagnóstico
- Conexão com banco usando usuário root e senha vazia no código legado.
- Pesquisa SQL monta o identificador da coluna com dado recebido do formulário; restringir a lista de colunas permitidas.
- Upload de comprovantes requer validação de tipo, tamanho, nome e armazenamento seguro.
- Falta autenticação e autorização por usuário, CSRF, validação de entrada e política de privacidade.

## Decisão de produto
Não criar outro controle financeiro concorrente. Preservar o legado como referência e migrar somente funcionalidades úteis (anexos de boletos e histórico) para o WS Controle Financeiro, após revisão do sistema de destino.

## Próximas etapas
1. Mapear os campos e operações do legado.
2. Comparar com o modelo atual do WS Controle Financeiro.
3. Propor integração de anexos sem duplicar dados e sem comprometer os registros existentes.
4. Manter conexão com banco para fase posterior, sem credenciais no GitHub.

Nenhuma migração de dados ou alteração do sistema financeiro atual foi executada nesta etapa.
