<?php

namespace App\Imports;

use App\Individu;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;

class IndividuImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        if(DB::table('individu')->where('num',$row['num'])->count()){
            return null;
        }
        return new Individu([
            'nom'    => $row['nom'], 
            'prenom' => $row['prenom'],
            'email' => $row['email'],
            'num' => $row['num'],
            'id_annuaire' => $row['id_annuaire'],
            'id_statut' => $row['id_statut'],
        ]);
    }
    public function headingRow(): int
    {
        return 1;
    }
}

