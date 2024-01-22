<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cities = [
            'São Paulo', 'Rio de Janeiro', 'Belo Horizonte', 'Porto Alegre', 'Salvador', 'Brasília', 'Curitiba', 'Fortaleza', 'Recife', 'Manaus',
            'Belém', 'Goiânia', 'Campinas', 'Vitória', 'Florianópolis', 'Natal', 'Cuiabá', 'São Luís', 'João Pessoa', 'Teresina',
            'Campo Grande', 'Aracaju', 'Palmas', 'Maceió', 'Macapá', 'Porto Velho', 'Boa Vista', 'Rio Branco', 'Santos', 'Duque de Caxias',
            'Ribeirão Preto', 'Niterói', 'Anápolis', 'Joinville', 'Uberlândia', 'Feira de Santana', 'Sorocaba', 'Londrina', 'Juiz de Fora', 'Guarulhos',
            'Serra', 'Santo André', 'Osasco', 'Caxias do Sul', 'São Bernardo do Campo', 'São José dos Campos', 'Diadema', 'Carapicuíba', 'Piracicaba', 'Mauá',
            'Campos dos Goytacazes', 'Cariacica', 'Betim', 'Jaboatão dos Guararapes', 'Olinda', 'Angra dos Reis', 'Vila Velha', 'São Vicente', 'Governador Valadares', 'Itaquaquecetuba',
            'Cabo Frio', 'Uberaba', 'Petrópolis', 'Paulista', 'Parnamirim', 'Ponta Grossa', 'Marabá', 'Santa Maria', 'Bauru', 'Franca',
            'Gravataí', 'Foz do Iguaçu', 'Volta Redonda', 'Canoas', 'Santa Luzia', 'Guarapuava', 'Itabuna', 'Barueri', 'Palhoça', 'Criciúma',
            'Novo Hamburgo', 'Apucarana', 'Imperatriz', 'São José de Ribamar', 'Magé', 'Taboão da Serra', 'Lauro de Freitas', 'Caucaia', 'Marília', 'Cotia'
        ];
        return [
            'name' => $cities[array_rand($cities)],
        ];
    }
}
