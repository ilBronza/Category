<?php

$prefix = (string) config('category.routePrefix');

return [
    $prefix . 'association.index' => 'Mostra la tabella per selezionare e associare categorie agli elementi indicati.',
    $prefix . 'categories.index' => 'Mostra l’elenco delle categorie.',
    $prefix . 'categories.create' => 'Mostra il modulo per creare una categoria.',
    $prefix . 'categories.store' => 'Salva una nuova categoria.',
    $prefix . 'categories.show' => 'Mostra i dettagli della categoria.',
    $prefix . 'categories.edit' => 'Mostra il modulo di modifica della categoria.',
    $prefix . 'categories.update' => 'Salva le modifiche della categoria.',
    $prefix . 'categories.destroy' => 'Elimina una categoria.',
    $prefix . 'categories.reorder' => 'Mostra la schermata per riordinare le categorie.',
    $prefix . 'categories.storeReorder' => 'Salva l’ordine e la gerarchia delle categorie.',
];
