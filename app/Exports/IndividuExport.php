<?php

namespace App\Exports;

use App\Individu;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IndividuExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function __construct(int $idGroupe, $headings)
    {
        $this->idGroupe = $idGroupe;
        $this->headings = $headings;
    }

    public function query()
    {
        return Individu::join('appartenir', 'individu.id_individu', '=', 'appartenir.id_individu')->where('appartenir.id_groupe',$this->idGroupe)->orderBy('individu.id_individu', 'asc')
        ->select('nom','prenom','email','num','id_annuaire','id_statut');
    }

    public function headings() : array
    {
        return $this->headings;
    }

    
}