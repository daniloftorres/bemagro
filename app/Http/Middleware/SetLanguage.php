<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLanguage
{
    public function handle($request, Closure $next)
    {
        // Verifica se o parâmetro 'lang' está presente e não está vazio
        $lang = $request->query('lang', 'pt'); // Usa 'pt_br' como padrão se 'lang' não for fornecido

        // Define o idioma no sistema
        App::setLocale($lang);

        // Armazena o idioma na sessão para uso em outras requisições
        Session::put('language', $lang);

        return $next($request);
    }
}
