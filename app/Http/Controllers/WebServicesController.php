<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Request;

class WebServicesController extends Controller
{
    //
    public function externalCall()
    {
        //ricordati di installare il pacchetto
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'http://www.oroscopi.com/ws/getoroscopo.php',
            //parametri di configurazinoe della richiesta
            [

                'http_errors' => false, //bypassa se ci sono errore http
                'query' => [
                    'type' => 'giorno',
                    'sign' => 'acquario',
                    'cnnc' => time()
                ]
            ]);

        //io devo controllare il codice della statuscode per capire se la mia chiamata
        //è andata a buon fine o meno
        $statusCode = $response->getStatusCode();
        $responseBody = $response->getBody();
        if ($statusCode == 200) {
            // --- Dato che ho dati strutturati li converto in array asocciativo
            $arData = \GuzzleHttp\json_decode($responseBody, true);
            //il log fa il parsing dell'array
            \Log::info($arData);
            return view('webservices.oroscopo')->with(['oroscopo' => $arData['oroscopo'][0]]);
        }
    }


    /**
     * externalCall_makePost
     * @descrition effettua una chiama verso una API
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function externalCall_makePost(Request $request)
    {
        //ricordati di installare il pacchetto
        $client = new \GuzzleHttp\Client();

        //l'array di nput deve avere i nome e struttura come l'api si apetta di ricevere
        $arInputData = [
            'fldNome' => 'Samsung',
            'fldCognome' => 'Apple'
        ];

        $response = $client->request(
            'POST',
            //nome della route
            route('api.post'),
            //parametri di configurazinoe della richiesta
            [
                'http_errors' => false, //bypassa se ci sono errore http
                'form_params' => $arInputData
            ]
        );

        //io devo controllare il codice della statuscode per capire se la mia chiamata
        //è andata a buon fine o meno
        $statusCode = $response->getStatusCode();
        if ($statusCode == 200) {
            $responseBody = $response->getBody();
            dd(\GuzzleHttp\json_decode($responseBody, true));

        }
    }
}
