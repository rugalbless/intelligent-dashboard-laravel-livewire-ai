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
