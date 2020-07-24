<?php

namespace App\Exports;

use App\User;
use App\Persona;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::
        join('personas','users.id','personas.user_id')->
        join('egresados','personas.id','egresados.persona_id')->
        join('egresados_escuelas','egresados.id','egresados_escuelas.egresado_id')->
        join('escuelas','egresados_escuelas.escuela_id','escuelas.id')->
        join('facultades','escuelas.facultad_id','facultades.id')->
        join('distritos', 'egresados.distrito_id', 'distritos.id')->
        join('provincias', 'distritos.pro_id', 'provincias.id')->
        join('departamentos', 'provincias.dep_id', 'departamentos.id')->
        join('paises', 'departamentos.pais_id', 'paises.id')->
        
        select('personas.nombre','personas.ap_paterno','personas.ap_materno','personas.dni',
        'personas.fec_nacimiento','personas.sexo', 'personas.email','egresados.celular',
        'egresados.codigo','egresados.egreso','escuelas.nombre as escuelas','facultades.nombre as facultades',
        'paises.nombre as pais_domicilio','departamentos.nombre as departamento_domicilio',
        'provincias.nombre as provincia_domicilio','distritos.nombre as distrito_domicilio',
        'egresados.direccion','egresados.referencia')->get();    
    }
}

