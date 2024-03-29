<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products = [
            "Smartphone",
            "Laptop",
            "Tablet",
            "Smartwatch",
            "Câmera Digital",
            "Fone de Ouvido Bluetooth",
            "Impressora 3D",
            "Roteador Wi-Fi",
            "Caixa de Som Inteligente",
            "Console de Videogame",
            "Teclado Mecânico",
            "Mouse Gamer",
            "Monitor UltraWide",
            "Carregador Sem Fio",
            "Disco SSD",
            "Drone",
            "Óculos de Realidade Virtual",
            "Assistente Virtual",
            "Robô Aspirador",
            "Projetor 4K",
            "Câmera de Segurança IP",
            "Estabilizador de Câmera",
            "Hub USB-C",
            "Mochila Antifurto",
            "Lâmpada Inteligente",
            "Cabo HDMI",
            "Estação de Carregamento",
            "Kit de Realidade Aumentada",
            "Capa Protetora para Celular",
            "Power Bank",
            "Relógio Fitness",
            "Cadeira Gamer",
            "Câmera Mirrorless",
            "Console Portátil",
            "Mini Projetor",
            "Ventilador USB",
            "Adaptador Bluetooth",
            "Tripé para Câmera",
            "Cadeado Inteligente",
            "Mousepad com Carregamento Wireless",
            "Máquina de Café Automática",
            "Cabo USB-C",
            "Teclado Bluetooth",
            "Cadeira Ergonômica",
            "Carregador Portátil Solar",
            "Headset com Cancelamento de Ruído",
            "Gravador de Áudio Profissional",
            "Câmera de Ação",
            "Microfone USB",
            "Projetor Portátil",
            "Base de Resfriamento para Laptop",
            "Hub Ethernet",
            "Câmera Termográfica",
            "Webcam Full HD",
            "Placa de Captura de Vídeo",
            "Monitor Touchscreen",
            "Cabo Thunderbolt",
            "Hub HDMI",
            "Hub USB 3.0",
            "Câmera de Vídeo 360º",
            "Cadeira Massageadora",
            "Teclado Gamer Iluminado",
            "Auriculares sem Fios",
            "Monitor Curvo",
            "Carregador de Carro USB",
            "Relógio Inteligente para Crianças",
            "Máquina de Cortar Papel Automática",
            "Caixa de Som à Prova d'Água",
            "Scanner de Documentos Portátil",
            "Filtro de Luz Azul para Monitor",
            "Carregador de Pilhas",
            "Luminária de Mesa LED",
            "Fita de LED RGB",
            "Limpador de Tela Eletrônico",
            "Base para Notebook com Cooler",
            "Mini Projetor para Smartphone",
            "Câmera de Segurança com Luz Solar",
            "Cabo VGA",
            "Adaptador DisplayPort",
            "Suporte para Celular para Carro",
            "Câmera Instantânea",
            "Projetor Holográfico",
            "Cabo Coaxial",
            "Hub USB-C com Leitor de Cartão SD",
            "Mala com Carregador USB",
            "Câmera de Vigilância Disfarçada",
            "Kit de Limpeza para Eletrônicos",
            "Régua Inteligente",
            "Disco Rígido Externo",
            "Câmera de Documentos",
            "Câmera de Inspeção USB",
            "Fone de Ouvido com Cancelamento de Ruído",
            "Lâmpada UV para Limpeza de Dispositivos",
            "Lente para Smartphone",
            "Câmera de Vídeo Profissional",
            "Cabo Ethernet Cat 7",
            "Mouse Vertical Ergonômico",
            "Caixa de Som Soundbar",
            "Carregador Wireless para Carro",
            "Adaptador Universal de Viagem",
            "Teclado sem Fio Retroiluminado",
            "Auriculares Desportivos sem Fios",
            "Luminária com Carregador Wireless",
            "Suporte para Laptop",
            "Câmera de Vigilância com Detecção de Movimento",
            "Mini Geladeira USB",
            "Câmera de Ré para Carro",
            "Câmera de Monitoramento Infantil",
            "Cabo Micro USB",
            "Adaptador USB-C para HDMI",
            "Câmera de Vídeo para Streaming",
            "Projetor para Ambientes Externos",
            "Microfone de Lapela",
            "Teclado mecânico sem Fio",
            "Cadeira para Escritório com Massagem",
            "Bateria Externa para Laptop",
            "Base de Carregamento para Controles de Videogame",
            "Kit de Limpeza para Lentes",
            "Câmera de Documentos Portátil",
            "Carregador Solar Portátil",
            "Cabo USB OTG",
            "Câmera para Drone 4K",
            "Lâmpada LED Inteligente",
            "Leitor de Cartão de Memória",
            "Adaptador USB-C para Ethernet",
            "Suporte para Tablet",
            "Fone de Ouvido com Microfone",
            "Kit de Iluminação para Estúdio Fotográfico",
            "Mini Teclado sem Fio",
            "Câmera de Vídeo para YouTube",
            "Mala com Rodinhas e Carregador USB",
            "Hub USB-C com Saída HDMI",
            "Microfone de Estúdio",
            "Cabo Lightning",
            "Projetor Laser",
            "Mousepad com Carregador sem Fio",
            "Suporte para Headset",
            "Câmera de Vigilância para Ambientes Externos",
            "Cabo DisplayPort",
            "Hub USB-C com Porta Ethernet",
            "Mini Impressora Portátil",
            "Câmera de Monitoramento Residencial",
            "Lâmpada de Mesa com Carregador Wireless",
            "Cabo USB tipo C",
            "Caixa de Som Bluetooth",
            "Teclado Ergonômico",
            "Carregador Portátil com Painel Solar",
            "Câmera Térmica",
            "Monitor 8K",
            "Mouse sem Fio",
            "Câmera de Vídeo de Bolso",
            "Rastreador GPS para Carro",
            "Mochila com Porta USB",
            "Teclado Silencioso",
            "Câmera de Vídeo 4K",
            "Estação de Trabalho para Notebook",
            "Câmera de Vigilância com Luz LED",
            "Cabo USB tipo A",
            "Mini Ventilador USB",
            "Hub USB-C com Leitor de Cartão Micro SD",
            "Câmera de Monitoramento para Bebês",
            "Projetor Interativo",
            "Lâmpada UV-C para Esterilização",
            "Cabo DVI",
            "Adaptador HDMI para VGA",
            "Fone de Ouvido com Microfone para Jogos",
            "Mouse Bluetooth",
            "Câmera 3D",
            "Teclado com Touchpad",
            "Cadeira para Gaming",
            "Lâmpada Inteligente com Controle Remoto",
            "Tripé para Smartphone",
            "Régua de Tomadas com USB",
            "Câmera de Vigilância com Áudio Bidirecional",
            "Leitor de Livros Eletrônicos",
            "Cabo USB 3.1",
            "Cadeira para Estudo",
            "Projetor LED",
            "Câmera de Vídeo de Ação 360º",
            "Mini Projetor Portátil para iPhone",
            "Ventilador USB com Relógio LED",
            "Hub USB-C com Porta HDMI e VGA",
            "Câmera de Vídeo Profissional 8K",
            "Teclado Mecânico Compacto",
            "Cadeira para Estúdio de Gravação",
            "Câmera de Inspeção Endoscópica",
            "Mouse Gamer Sem Fio",
            "Câmera de Vídeo de Alta Velocidade",
            "Cabo USB tipo B",
            "Carregador de Pilhas Recarregáveis",
            "Cadeira de Estudo Ergonômica",
            "Projetor de Bolso",
            "Mini Geladeira USB para Bebidas",
            "Câmera de Vigilância com Sensor de Movimento",
            "Cabo SATA",
            "Adaptador USB para Ethernet",
            "Luminária de Leitura LED",
            "Câmera para Carro com Visão Noturna",
            "Fone de Ouvido com Cancelamento de Ruído",
            "Mala para Laptop",
            "Câmera de Segurança com Detecção Facial",
            "Lousa Digital",
            "Câmera Espiã",
            "Cabo USB de Extensão",
            "Suporte para Monitor",
            "Câmera de Vídeo 6K",
            "Kit de Ferramentas para Eletrônicos",
            "Hub USB-C com Porta USB 3.0",
            "Câmera de Vigilância com Gravação em Nuvem",
            "Fone de Ouvido com Cancelamento de Ruído para Dormir",
            "Cabo de Áudio P2",
            "Cadeira para Home Office",
            "Projetor Portátil para Smartphone",
            "Câmera de Vídeo para Vlog",
            "Base de Carregamento para Smartphones",
            "Hub USB 2.0",
            "Mini Aspirador de Pó USB",
            "Câmera de Vídeo de Ação 4K",
            "Teclado sem Fio Retroiluminado",
            "Carregador de Parede USB",
            "Mousepad com Suporte para Carregamento sem Fio",
            "Câmera de Vigilância com Gravação em Cartão SD",
            "Cabo Adaptador USB-C para Micro USB",
            "Lousa Interativa",
            "Câmera de Vídeo para Monitoramento de Animais de Estimação",
            "Cabo RCA",
            "Cadeira para Sala de Aula",
            "Projetor 3D",
            "Câmera de Vigilância para Ambientes Internos",
            "Suporte para Laptop com Ventilação",
            "Luminária de Mesa com Carregador USB",
            "Cabo Coaxial RG6",
            "Câmera de Documentos com OCR",
            "Mouse Ergonômico",
            "Teclado para Tablet",
            "Cadeira para Estúdio de Fotografia",
            "Fone de Ouvido com Microfone para Esportes",
            "Câmera de Vídeo para Transmissão ao Vivo",
            "Ventilador USB com Relógio",
            "Mini Projetor para Jogos",
            "Cabo HDMI 2.1",
            "Adaptador DisplayPort para HDMI",
            "Hub USB-C com Porta USB 2.0",
            "Scanner de Código de Barras",
            "Câmera de Vigilância Externa com Bateria",
            "Cabo USB para Impressora",
            "Cadeira para Estúdio de Gravação de Podcast",
            "Projetor com Sistema Android",
            "Câmera de Vídeo 360º para Realidade Virtual",
            "Mochila para Laptop com Porta USB",
            "Luz de Leitura LED",
            "Cabo Adaptador USB-C para USB-A",
            "Câmera de Segurança com Luz Estroboscópica",
            "Mouse sem Fio para Jogos",
            "Câmera de Vídeo 5G",
            "Kit de Limpeza para Câmera",
            "Cadeira para Sala de Aula com Mesa",
            "Projetor para Ambientes Externos com Bluetooth",
            "Câmera de Monitoramento para Idosos",
            "Luminária de Mesa com Controle de Toque",
            "Cabo HDMI 4K",
            "Adaptador HDMI para DisplayPort",
            "Hub USB-C com Porta USB 3.1",
            "Câmera de Vigilância com Painel Solar",
            "Cabo USB para Micro USB",
            "Cadeira para Crianças",
            "Câmera de Vídeo para Gravação de Aulas",
            "Ventilador USB com LED",
            "Mini Projetor para Apresentações",
            "Câmera de Vigilância Residencial com App",
            "Cabo Adaptador USB-C para HDMI",
            "Scanner de Documentos sem Fio",
            "Cadeira para Estudo Infantil",
            "Projetor de Holograma",
            "Câmera de Vídeo 8K",
            "Cadeira para Videoconferência",
            "Mousepad com Carregador sem Fio Integrado",
            "Lousa Digital Interativa",
            "Cabo USB 2.0",
            "Base de Resfriamento para Notebook com Ventilador",
            "Câmera de Inspeção para Tubulações",
            "Mini Projetor Portátil para PC",
            "Teclado Flexível",
        ];
        return [
            'name' => $products[array_rand($products)],
            'price' => fake()->randomFloat(2, 1, 100),
            'stock' => fake()->randomFloat(2, 1, 100),
        ];
    }
}
