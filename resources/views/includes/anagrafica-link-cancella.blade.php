{{-- è una nested view che permette di prendere dei parametnri in entrata ed di usarli in blade --}}

{{link_to_route(
    'anagrafica-clienti.delete', //la route name del collegamento
    'Cancella', //nome da visualizzare
    ['id' => $id, 'exquerystring' =>'sono una querystring'], //array dei prametri che in caso di route con parametri vanno specificati con stesso id
                    //di quello della route se si aggiungono lui crea una query string (request->input per i query string e non reqwuest ->get
    [
        'class' => 'btn btn-danger',
        'title' => 'Cancella anagrafica clienti',
        'id' => 'lnkAnagraficaCancella'
    ]
    )}}

