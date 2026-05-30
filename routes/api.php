<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| MenuCity API Routes
|--------------------------------------------------------------------------
|
| Rotas da API do MenuCity — sistema de localização de restaurantes
| e visualização de cardápios digitais.
|
| Prefixo automático: /api
| Exemplo: GET /api/status
|
*/

// -----------------------------------------------------------------------
// 1. GET /api/status — Saúde e informações gerais da API
// -----------------------------------------------------------------------
Route::get('/status', function () {
    return response()->json([
        'status'    => 'online',
        'servico'   => 'MenuCity API',
        'versao'    => '1.0.0',
        'descricao' => 'API de localização de restaurantes e cardápios digitais',
        'timestamp' => now()->toIso8601String(),
    ]);
});

// -----------------------------------------------------------------------
// 2. GET /api/restaurantes — Lista de restaurantes cadastrados
// -----------------------------------------------------------------------
Route::get('/restaurantes', function () {
    return response()->json([
        'dados' => [
            [
                'id'        => 1,
                'nome'      => 'Sabor da Terra',
                'categoria' => 'Comida Brasileira',
                'endereco'  => 'Rua das Flores, 123 — Centro',
                'latitude'  => -23.55052,
                'longitude' => -46.63331,
                'avaliacao' => 4.7,
                'aberto'    => true,
            ],
            [
                'id'        => 2,
                'nome'      => 'Tokyo Sushi',
                'categoria' => 'Comida Japonesa',
                'endereco'  => 'Av. Paulista, 456 — Bela Vista',
                'latitude'  => -23.56168,
                'longitude' => -46.65590,
                'avaliacao' => 4.5,
                'aberto'    => false,
            ],
            [
                'id'        => 3,
                'nome'      => 'Bella Massa',
                'categoria' => 'Comida Italiana',
                'endereco'  => 'Rua Augusta, 789 — Consolação',
                'latitude'  => -23.55340,
                'longitude' => -46.66210,
                'avaliacao' => 4.8,
                'aberto'    => true,
            ],
        ],
        'total' => 3,
    ]);
});

// -----------------------------------------------------------------------
// 3. GET /api/cardapios — Cardápios digitais dos restaurantes
// -----------------------------------------------------------------------
Route::get('/cardapios', function () {
    return response()->json([
        'dados' => [
            [
                'id'              => 1,
                'restaurante_id'  => 1,
                'restaurante'     => 'Sabor da Terra',
                'itens' => [
                    [
                        'nome'      => 'Feijoada Completa',
                        'descricao' => 'Feijoada tradicional com arroz, couve, farofa e laranja',
                        'preco'     => 39.90,
                        'categoria' => 'Prato Principal',
                    ],
                    [
                        'nome'      => 'Suco de Maracujá',
                        'descricao' => 'Suco natural de maracujá — 500ml',
                        'preco'     => 9.50,
                        'categoria' => 'Bebida',
                    ],
                ],
            ],
            [
                'id'              => 2,
                'restaurante_id'  => 2,
                'restaurante'     => 'Tokyo Sushi',
                'itens' => [
                    [
                        'nome'      => 'Combo Sashimi 15 peças',
                        'descricao' => 'Seleção de sashimis frescos: salmão, atum e peixe branco',
                        'preco'     => 62.00,
                        'categoria' => 'Prato Principal',
                    ],
                    [
                        'nome'      => 'Chá Verde Gelado',
                        'descricao' => 'Chá verde japonês servido gelado — 300ml',
                        'preco'     => 8.00,
                        'categoria' => 'Bebida',
                    ],
                ],
            ],
        ],
        'total' => 2,
    ]);
});

// -----------------------------------------------------------------------
// 4. GET /api/categorias — Categorias de culinária disponíveis
// -----------------------------------------------------------------------
Route::get('/categorias', function () {
    return response()->json([
        'dados' => [
            [
                'id'                  => 1,
                'nome'                => 'Comida Brasileira',
                'icone'               => '🇧🇷',
                'total_restaurantes'  => 12,
            ],
            [
                'id'                  => 2,
                'nome'                => 'Comida Japonesa',
                'icone'               => '🇯🇵',
                'total_restaurantes'  => 8,
            ],
            [
                'id'                  => 3,
                'nome'                => 'Comida Italiana',
                'icone'               => '🇮🇹',
                'total_restaurantes'  => 6,
            ],
            [
                'id'                  => 4,
                'nome'                => 'Fast Food',
                'icone'               => '🍔',
                'total_restaurantes'  => 15,
            ],
            [
                'id'                  => 5,
                'nome'                => 'Pizzaria',
                'icone'               => '🍕',
                'total_restaurantes'  => 10,
            ],
        ],
        'total' => 5,
    ]);
});
