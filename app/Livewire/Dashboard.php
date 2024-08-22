<?php

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
                ['role' => 'system', 'content' => "Você é um assistente que gera configurações JSON do Vega-lite."],
                ['role' => 'user', 'content' => "Considerando a lista de campos ($fields), gere uma configuração JSON do Vega-lite v5 (sem campo de dados e com descrição) que atenda o seguinte pedido: {$this->question}. Resposta apenas em JSON."],
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
            throw new \Exception("Erro ao decodificar o JSON: " . json_last_error_msg());
        }

        $this->dataset = ["values" => SalesCommission::inRandomOrder()->limit(100)->get()->toArray()];

        return $this->config;
    }

}
