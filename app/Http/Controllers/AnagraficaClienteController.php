<?php

namespace App\Http\Controllers;

use App\Models\AnagraficaClienti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AnagraficaClienteController extends Controller
{
    //
    /**
     * index
     * @return $this
     */
    public function index()
    {
        $clienteM = new AnagraficaClienti();
        //imposto i filtri where che possono essere molteplici
        $arWhere = [
            //['nome', 'like', 'P%']
        ];
        //tiro su solo due colonne
        //fare la query davanbti ed in fondo il get con le colonne volute
        $dataC = $clienteM::where($arWhere)->orderBy('id', 'desc')->get(['id', 'nome', 'cognome']);

        return view('anagrafica-cliente.index')->with(['dataC' => $dataC]);
    }

    public function create()
    {
        return view('anagrafica-cliente.create');
    }


    public function show($id)
    {
        //recuperiamo tramite api e la facciamo visualizzare tramite handlebars
        //recupeare record anche nel caso in cui non esiste

        //visualizzare il record con vista
        return view('anagrafica-cliente.show')->with(['id' => $id]);

    }

    public function store(Request $request)
    {
        //facciamo le regole di validazione
        //usiamo il metodo validate del request
        $this->validate($request, [
            'nome' => 'required|max:255',
            'cognome' => 'required|max:255',
            'telefono' => 'required|max:255',
            'email' => 'required|unique:anagrafica_clienti,email|max:255', //controlla nella tabella che il valore sia unico il seconod parametro è colonna da controllare
            'logo' => 'max:5000000|mimetypes:image/jpeg,image/png' //max è la dimensione in byte massima
        ]);

        //devo memorizzare il record
        //può suggerire le colonne perchè è stato definito il modello a modo con i campi filable e ti avvisa con un algtro colore se non trova la colonna
        $mdl = new AnagraficaClienti();
        $mdl->nome = $request->get('nome');
        $mdl->cognome = $request->get('cognome');
        $mdl->email = $request->get('email');
        $mdl->data_contatto = $request->get('data_contatto');
        $mdl->telefono = $request->get('telefono');

        //devo effettuare lo storage del file
        $fileEstension = $request->file('logo')->extension();
        $fileName = $request->file('logo')->getClientOriginalName();
        $fileName = md5(sha1($fileName . time() . 'iacopo')) . '.' . $fileEstension;
        $request->file('logo')->storeAs(config('laramind.UploadFolder'), $fileName);
        $mdl->logo = $fileName;

        $mdl->save();
        //devo rendere una vista
        //manfo un flash message alla index
        return redirect()->route('anagrafica-clienti.index')->with('flash', 'Anagrafica Inserita');
    }


    public function update($id)
    {
        //=== recuperi i dati
        $mdl = new AnagraficaClienti();
        $data = $mdl::find($id)->toArray();

        //=== mostro la maschera
        $path = null;
        $logoEncoded = null;

        if (Storage::disk(env('FILESYSTEM_DRIVER'))->exists(config('laramind.UploadFolder') . DIRECTORY_SEPARATOR . $data['logo'])) {
            $path = Storage::url((config('laramind.UploadFolder') . DIRECTORY_SEPARATOR . $data['logo']));
            \Debugbar::info($data['logo']);
            $logoEncoded = Storage::get(config('laramind.UploadFolder') . DIRECTORY_SEPARATOR . $data['logo']);
            //==carica nel debug bar la versinoe base64 dell'immagine recuperata
            \Debugbar::info($logoEncoded);
        }
        \Debugbar::info($path);
        return view('anagrafica-cliente.edit')->with(['anagrafica' => $data,
            'logoEncoded' => $logoEncoded,
            'logoPath' => $path]);

    }

    public function updateApply(Request $request, $id)
    {
        // === Vado a validare i dati del
        $this->validate($request, [
            'nome' => 'required|max:255',
            'cognome' => 'required|max:255',
            //'email' => 'required|unique:anagrafica_clienti,email|max:200',
            'email' => 'required|max:200',
            'logo' => 'max:50000|mimetypes:image/jpeg,image/png'
        ]);

        //recupero l'id dal db per fare l'update
        $mdl = new \App\Models\AnagraficaClienti();
        $anagraficaObj = $mdl::find($id);

        if (!$anagraficaObj) {
            // --- redirecrt con messaggio di errore flash
            Log::error("Non ho trovato i dati");
            return redirect()->route('anagrafica-clienti.index')->with('flash', 'Impossibile salvare le modifiche id non trovato');

        }

        //campi da fare update
        $input = [
            'nome' => $request->get('nome'),
            'cognome' => $request->get('cognome'),
            'email' => $request->get('email'),
            'telefono' => $request->get('telefono'),
            'data_contatto' => $request->get('data_contatto'),
        ];

        //=== verifivo se mi è stato passato anche un file mentre faccio l'update

        if ($request->hasFile('logo')) {
            // === Faccio il caricamento del file
            // === Devo effettuare lo stroage del file
            $fileExstension = $request->file('logo')->extension();
            $fileName = md5(sha1($request->file('logo')->getClientOriginalName()) . time() . 'KKPOAI')
                . '.'
                . $fileExstension; // estensione del file

            $request->file('logo')->storeAs(
                config('laramind.uploadFolder'),
                $fileName
            );
            $input['logo'] = $fileName;
        }


        $anagraficaObj->update($input);
        $anagraficaObj->save();

        // === altro redirect con messaggio flash
        return redirect()->route('anagrafica-clienti.index')->with('flash', 'Anagrafica salvata correttamente');

    }

    public function delete($id)
    {
        $mdl = new AnagraficaClienti();
        $data = $mdl::find($id);
        if ($data) {
            //=== dati presenti cancello e do conferma
            $data->delete();
            return redirect()->route('anagrafica-clienti.index')->with('flash', 'Record cancellato con successo');

        } else {
            //=== errore
            Log::error("Non è possibile cancellare");
            return redirect()->route('anagrafica-clienti.index')->with('flash_error', 'Errore nel cancellare il record');
        }
    }

    public function getAnagraficaDetail(Request $request, $id)
    {
        //rallento un attimo
        sleep(1);
        // ===recupero il reccord
        $mdl = new AnagraficaClienti();
        // --- formatto output con caso negativo
        $arOut = [
            'statusCode' => 404, //risorsa non trovata
            'data' => []
        ];

        //recupero i dati di un certo id e li trasformo in array
        $data = $mdl::find($id);

        if ($data) {
            $arOut = [
                'status' => 200, //tutto ok
                'anagrafica' => $data->toArray(),
                'ordinis' => $data->ordinis()->get()->toArray()
            ];
        }

        // === rendo output json
        //poichè non si possono richiamare api da un dominio diverso dal nostro perchè l'output è un application/json mettendo il meccaanisco di callback
        //si permettete passando come paramentro ?callback=nome_funzione la possibilità di avere in risposta lo stesso contenuo json ma wrappato dentro
        //una funzione javascript che la possono leggere da qualunque punto del web senza limitazione di dominio.
        return response()->json($arOut)->withCallback($request->input('callback'));
    }

    public function mascheraJavascript()
    {
        return view('anagrafica-cliente.maschera-javascript');
    }

    /**
     * postAnagraficaDetailBigData
     *
     * prova di descrizione
     *
     * dsadsada
     *
     * @param Request $request
     * @return $this
     */
    public function postAnagraficaDetailBigData(Request $request)
    {
        /*        $arData = [
                //se input è json tramite la funzione json può fare il parsing
                'deviceId' => $request->json('deviceId'),
                'transactionId' => $request->json('transactionId'),
                'adsClient' => $request->json('deviceId'),
                'userId' => $request->json('deviceId'),
            ];*/


        $elencoBrani = $request->json('elencoBrani');
        $dettaglioPlayer = $request->json('dettaglioPlayer');

        //
        foreach ($elencoBrani as $index => $item) {
            \Log::info('[postAnagraficaDetailBigData]' . $index . $item['titolo']);
        }

        //recupero le dimensioni
        $with = $dettaglioPlayer['renderDetail']['converDimensione']['widht'];
        $height = $dettaglioPlayer['renderDetail']['converDimensione']['widht'];

        \Log::info('[postAnagraficaDetailBigData]' . $with);
        $arData = [

            //se input è json tramite la funzione json può fare il parsing
            'elencoBrani' => $elencoBrani,

        ];

        return response()
            ->json([
                'statusCode' => '200',
                'data' => $arData
            ])
            ->withCallback($request->input('callback'));
    }

    /**
     * postAnagraficaDetail
     *
     * prova di descrizione
     *
     * @param Request $request
     * @return $this
     */
    public function postAnagraficaDetail(Request $request)
    {
        //non possiamo fare con il validate perchè siamo dentro api
        //quando facciamo una api dobbiamo sempre rendere una risposta
        //ok scrittura 200
        //se non va bene qualcosa 40x
        //se non va qualcosa di logico 50x

        // === creare un record associativo con i campi del record
        $arData = [
            'nome' => $request->get('fldNome'),
            'cognome' => $request->get('fldCognome'),
            'email' => "iacopo.nucci@gmail.com",
            'telefono' => '333456',
            'logo' => 'logo.jpg',
            'data_contatto' => '2017-00-12',
        ];

        // === instanziare il model
        $mdl = new AnagraficaClienti();
        //creo il record con tutto l'array questa funzione fa anche il save
        $mdl->create($arData);


        // === scrivere il record

        // === se abbiamo un record con id, resituisco 200
        // ---  altrimenti essendo un problema applicativo 500 (errore custom)


        return response()
            ->json([
                'statusCode' => '200',
                'data' => $arData
            ])
            ->withCallback($request->input('callback'));
    }

    /**
     * @return string
     */
    public function inviaNotifica()
    {
        $arNotifica = [
            'dato1' => 'Monitor',
            'dato2' => 'notebooke',
            'dato3' => 'xbox',
        ];

        event(new \App\Events\InviaNotifica($arNotifica));
        return "evento invocato";
    }
}


