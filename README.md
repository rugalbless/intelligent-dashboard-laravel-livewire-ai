# Intelligent Dashboard

Esta é uma aplicação Laravel projetada para criar visualizações de dados personalizadas usando o modelo GPT-3.5 Turbo da OpenAI e Vega-Lite. O usuário pode inserir um pedido em linguagem natural, e o sistema gerará uma configuração JSON correspondente para o Vega-Lite, que produzirá o gráfico visual.

## Funcionalidades

- **Laravel & Livewire**: Construído com Laravel e Livewire para uma experiência de usuário dinâmica e fluida.
- **Integração com OpenAI**: Utiliza o modelo GPT-3.5 Turbo para gerar configurações JSON para o Vega-Lite com base no input do usuário.
- **Visualizações Vega-Lite**: Transforma as configurações JSON em gráficos visuais usando Vega-Lite.

## Como Funciona

1. O usuário insere uma pergunta ou solicitação de gráfico em linguagem natural na interface de chat.
2. A aplicação envia essa entrada para o modelo GPT-3.5 Turbo através da API da OpenAI.
3. O modelo retorna uma configuração JSON para o Vega-Lite, que é usada para renderizar o gráfico no painel.

---

```php
namespace App\Livewire;

use App\Models\SalesCommission;
use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;

class Dashboard extends Component
{
    public $config;
    public string $question;
    public array $dataset;

    public function render()
    {
        return view('livewire.dashboard');
    }

    protected $rules = [
        'question' => 'required|min:10'
    ];

    public function generateReport() {
        $this->validate();

        $fields = implode(',', SalesCommission::getColumns());

        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => "Você é um assistente que gera configurações JSON para Vega-lite."],
                ['role' => 'user', 'content' => "Considerando a lista de campos ($fields), gere uma configuração JSON para Vega-lite v5 (sem campo de dados e com descrição) que atenda ao seguinte pedido: {$this->question}. Responda apenas em JSON."],
            ],
            'max_tokens' => 1500,
        ]);

        $jsonContent = $response->choices[0]->message->content;

        $jsonContent = trim($jsonContent);

        $jsonStart = strpos($jsonContent, '{');
        $jsonEnd = strrpos($jsonContent, '}');

        if ($jsonStart !== false && $jsonEnd !== false) {
            $jsonContent = substr($jsonContent, $jsonStart, $jsonEnd - $jsonStart + 1);
        } else {
            throw new \Exception("JSON inválido retornado.");
        }

        $this->config = json_decode($jsonContent, true);

        if ($this->config === null) {
            throw new \Exception("Erro ao decodificar JSON: " . json_last_error_msg());
        }

        $this->dataset = ["values" => SalesCommission::inRandomOrder()->limit(100)->get()->toArray()];

        return $this->config;
    }
}
```
## Vega-Lite
O Vega-Lite é uma gramática de alto nível para gráficos interativos. Ele fornece uma sintaxe concisa em JSON para gerar rapidamente visualizações que suportam análises.

Saiba mais sobre Vega-Lite no [site oficial.](https://vega.github.io/vega-lite/).

## Exemplos de Resultados

### Vendas por Estado

O gráfico de barras a seguir foi gerado com o input: "Vendas por estado".

![Sales by State](https://github.com/user-attachments/assets/31030243-1af3-402c-9a43-cf3814f37a01)


### Gráfico de Pizza das Vendas por Estado

Aqui está um exemplo de gráfico de pizza gerado com o input: "Gráfico de Pizza das vendas por estado".

![Pie Plot of the Sales by State](https://github.com/user-attachments/assets/3a63224b-8025-4ba2-bbc9-c4232ece3da7)

Explore mais maneiras de solicitar gráficos visitando a documentação do Vega-Lite.

## Ambiente 

Esta aplicação foi feita utilizando docker, então, caso queira usar certifique-se pegar o .env.example e altera-lo para .env. Após isso deixe ele assim na parte
```dotenv
APP_NAME=Laravel
APP_ENV=local
APP_KEY=GenerateYourKeyAplication
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost

DB_CONNECTION=pgsql
DB_HOST=pgsql
DB_PORT=5432
DB_DATABASE=laradash
DB_USERNAME=sail
DB_PASSWORD=password

OPENAI_API_KEY=YourAPiKey
```
## Versão Multi-Tenancy

Atualmente estou desenvolvendo uma versão multi-tenancy desta aplicação. Você pode encontrar o repositório para essa versão [aqui](https://github.com/rugalbless/dash-laravel-ai-MT-). 


___
___


# Intelligent Dashboard

This is a Laravel application designed to create custom data visualizations using the GPT-3.5 Turbo model from OpenAI and Vega-Lite. The user can input a request in natural language, and the system will generate a corresponding JSON configuration for Vega-Lite, which will then produce the visual chart.

## Features

- **Laravel & Livewire**: Built using Laravel and Livewire for a seamless and dynamic user experience.
- **OpenAI Integration**: Uses the GPT-3.5 Turbo model to generate JSON configurations for Vega-Lite based on user input.
- **Vega-Lite Visualizations**: Transforms the JSON configurations into visual charts using Vega-Lite.

## How it Works

1. The user enters a natural language question or request for a chart in the chat interface.
2. The application sends this input to the GPT-3.5 Turbo model via OpenAI's API.
3. The model returns a JSON configuration for Vega-Lite, which is then used to render the chart on the dashboard.
___________________________________________________________________________________________________________________________
```php
namespace App\Livewire;

use App\Models\SalesCommission;
use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;

class Dashboard extends Component
{
    public $config;
    public string $question;
    public array $dataset;

    public function render()
    {
        return view('livewire.dashboard');
    }

    protected $rules = [
        'question' => 'required|min:10'
    ];

    public function generateReport() {
        $this->validate();

        $fields = implode(',', SalesCommission::getColumns());

        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => "You are an assistant that generates JSON configurations for Vega-lite."],
                ['role' => 'user', 'content' => "Considering the list of fields ($fields), generate a JSON configuration for Vega-lite v5 (without data field and with description) that meets the following request: {$this->question}. Response only in JSON."],
            ],
            'max_tokens' => 1500,
        ]);

        $jsonContent = $response->choices[0]->message->content;

        $jsonContent = trim($jsonContent);

        $jsonStart = strpos($jsonContent, '{');
        $jsonEnd = strrpos($jsonContent, '}');

        if ($jsonStart !== false && $jsonEnd !== false) {
            $jsonContent = substr($jsonContent, $jsonStart, $jsonEnd - $jsonStart + 1);
        } else {
            throw new \Exception("Invalid JSON returned.");
        }

        $this->config = json_decode($jsonContent, true);

        if ($this->config === null) {
            throw new \Exception("Error decoding JSON: " . json_last_error_msg());
        }

        $this->dataset = ["values" => SalesCommission::inRandomOrder()->limit(100)->get()->toArray()];

        return $this->config;
    }
}
```
## Vega-Lite

Vega-Lite is a high-level grammar of interactive graphics. It provides a concise JSON syntax for rapidly generating visualizations to support analysis.

Learn more about Vega-Lite on their [official site](https://vega.github.io/vega-lite/).

## Example Results

### Sales by State

The following bar chart was generated with the input: **"Sales by state"**.

![Sales by State](https://github.com/user-attachments/assets/31030243-1af3-402c-9a43-cf3814f37a01)


### Pie Plot of the Sales by State

Here is an example of a pie chart generated with the input: **"Pie Plot of the sales by state"**.

![Pie Plot of the Sales by State](https://github.com/user-attachments/assets/3a63224b-8025-4ba2-bbc9-c4232ece3da7)

Explore more ways to request charts by visiting the [Vega-Lite documentation](https://vega.github.io/vega-lite/docs/).

## Environment Setup

This application was set up using Docker and Laravel Sail. Here are the key environment variables configured for this application:

```dotenv
APP_NAME=Laravel
APP_ENV=local
APP_KEY=GenerateYourKeyAplication
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost

DB_CONNECTION=pgsql
DB_HOST=pgsql
DB_PORT=5432
DB_DATABASE=laradash
DB_USERNAME=sail
DB_PASSWORD=password

OPENAI_API_KEY=YourAPiKey
```
## Multi-Tenancy Version

I am currently developing a multi-tenancy version of this application. You can find the repository for this version [here](https://github.com/rugalbless/dash-laravel-ai-MT-).
