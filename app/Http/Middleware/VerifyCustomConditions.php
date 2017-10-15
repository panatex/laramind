<?php

namespace App\Http\Middleware;

use Closure;

class VerifyCustomConditions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//è la route che dice quale middleware eseguire

        //il print_r inviata alla stdout tutto quello che deve visualizzare
        //con il true ,e lo rende come stringa
        \Log::info('[VerifyCustomConditions]' . print_r($request->get('nome'), true));

        $arDati = [
            'nome' => $request->get('nome'),
            'cognome' => $request->get('cognome')
        ];

        //=== Richiamo il metodo privato
        $esito = $this->verificaDati($arDati);

        if (!esito) {
            //porto l'errore con la varibile di sessione
            $request->session()->put('', '');
            return redirect('')->route('anagrafica-clienti.index');
        }

        //continua con il normale fluire del controller

        //lo passa a quello dopo nell'array route dopo avere eseguyito l'ultimo middleware e dopo lo passa
        //al controller
        return $next($request);
    }

    private function verificaDati($arDati)
    {
        return true;
    }
}
