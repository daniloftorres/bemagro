
# Projeto de Acesso ao Clima do Tempo

Este projeto foi desenvolvido por Danilo Torres como parte de um teste técnico para a empresa BemAgro. O sistema permite a consulta de informações climáticas por nome da cidade, exibindo dados como temperatura, umidade e velocidade do vento, entre outros.

## Tecnologias Utilizadas

- **PHP 8.1**: Linguagem de programação.
- **Laravel 10**: Framework PHP para desenvolvimento do sistema.
- **Docker e Docker Compose**: Utilizados para a criação de ambientes isolados e replicáveis.
- **GitHub**: Usado para o versionamento e controle de código do projeto.

## Apis públicas usadas
Weather API: http://api.openweathermap.org
Nominatim Geolocation: https://nominatim.openstreetmap.org
Sendo configuradas no `.env`

## Funcionalidades

- **Consulta Climática por Cidade**: O usuário pode buscar informações climáticas digitando o nome da cidade desejada. Exemplo das informações disponíveis para Ribeirão Preto:
  - **Latitude**: -21.1776315
  - **Longitude**: -47.8100983
  - **Temperatura**: 33°C
  - **Temperatura Mínima**: 33°C
  - **Temperatura Máxima**: 33°C
  - **Humidade**: 35%
  - **Velocidade do Vento**: 1.54Km/h
  - **Condição Climática**: céu limpo
- **Persistência de Dados**: Cada pesquisa de clima realizada e seu resultado são salvos em banco de dados.
- **Verificação de Duplicidade**: Antes de salvar um novo registro, o sistema verifica se já existe uma pesquisa para a cidade informada.
- **Gestão de Registros**: Os usuários podem visualizar todos os registros de pesquisa, editar ou remover conforme necessário.

## Internacionalização

- **Tradução**: Todas as mensagens estão disponíveis em português, facilitando a interação com usuários que falam este idioma.

## Configuração e Uso

### Pré-requisitos

Para executar este projeto, você precisará ter Docker e Docker Compose instalados em sua máquina. Além disso, é recomendável ter uma IDE que suporte PHP e Laravel para desenvolvimento e testes.

### Instalação

1. Clone o repositório do GitHub:
   ```bash
   git clone https://github.com/daniloftorres/bemagro.git
   ```
2. Navegue até a pasta do projeto e construa os containers do Docker:
   ```bash
   docker-compose up --build
   ```
3. Após a construção e execução dos containers, o projeto estará acessível via `localhost:8080` ou outro host configurado em seu ambiente Docker.

### Uso

Para acessar as funcionalidades do sistema, navegue através dos endpoints definidos nas rotas do Laravel para realizar pesquisas climáticas, visualizar registros, editar ou remover informações.

## Autor

**Danilo Torres**
- Desenvolvedor responsável pelo projeto.
```

Este `README.md` oferece uma visão geral completa do projeto, incluindo descrição das funcionalidades, tecnologias usadas, instruções para configuração e uso.