<?php

namespace App\Http\Controllers;

use App\Models\AnagraficaClienti;
use Illuminate\Http\Request;

class AnagraficaClienteController extends Controller
{
    //
    public function index()
    {
        $clienteM = new AnagraficaClienti();
        //imposto i filtri where che possono essere molteplici
        $arWhere = [
            ['nome', 'like', 'P%']
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
        return view('anagrafica-cliente.show')->with(['id'=>$id]);

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

        return view('anagrafica-cliente.edit')->with(['anagrafica'=> $data]);

    }

    public function updateApply(Request $request)
    {

    }

    public function delete($id)
    {

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

        if($data){
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
}
