<!--occhio all'intestazione particolare non ti confondere non è notazione di blade ma notazione di handlebars

occhio qui puoi scrivere in sintassi bootstrap senza problemi

occhio handlebars togliue già il contenitore padre e si accede già ai figli infatti non uso response.
-->
<script id="anagrafica-dettaglio" type="text/x-handlebars-template">

    <table class="table table-bordered">
        <tr>
            <td class="grayed">Nome:</td>
            <td>{{anagrafica.nome}}</td>
        </tr>
        <tr>
            <td class="grayed">Cognome:</td>
            <td>{{anagrafica.cognome}}</td>
        </tr>
        <tr>
            <td class="grayed">Telefono:</td>
            <td>{{anagrafica.telefono}}</td>
        </tr>
    </table>

    <ul id="riepilogoOrdini">
    {{#each ordinis}}
    <!-- handlebars permette di avere un indice mentre cicla numerato usando key-->
    <li id="{{@key}}" importo="{{importo}}">
        Data: {{data_ordine}} Importo: {{importo}}
    </li>
    {{/each}}
    </ul>
</script>