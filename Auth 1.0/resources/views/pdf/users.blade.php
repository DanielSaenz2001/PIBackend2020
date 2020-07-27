<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title></title>
    <style>
        
        body{
            font-size: small;
            text-align: justify;
        }
        h1{
            text-align: center;
            color: #7b1038;
        }
        h2{
            color:#e91e63;
            font-size: 20px;
        }
        #color1{
            color: black;
        }
        
        .lead{
            font-size: 18px;
            color: #7b1038;
        }
        .table{

            margin:3px;
            border:2px; 
        }
       
    </style>
</head>
<body>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    

   
    <div class="table">
        <div class="">
            <div class="container">
                <h1 class="display-4">CURRICULUM VITAE</h1>
                <p id="color1" class="lead">
                Este es el panel donde el Egresado puede imprimir su Curriculum Vitae para 
                la oportunidad de conseguir trabajo, con datos importantes para su Experiencia 
                Laboral.
                </p>
            
            <h2><ins> Datos Personales</ins></h2>
            @foreach($personas as $user)
            <table class="table table-sm">
                <tbody>
                    <tr>
                        <th scope="row"><p class="lead">Nombre :</p></th>
                            <td><ul><li>{{ $user->nombre}}</li></ul></td>
                    </tr>
                    <tr>
                        <th scope="row"><p class="lead">Apellidos  :</p></th>
                            <td><ul><li>{{ $user->ap_paterno}} {{ $user->ap_materno}}</li></ul></td>
                    </tr>                    
                    <tr>
                        <th scope="row"><p class="lead">Email      :</p></th>
                            <td><ul><li>{{ $user->email}}</li></ul></td>
                    </tr>
                    <tr>
                        <th scope="row"><p class="lead">Direccion  :</p></th>
                            <td><ul><li>{{ $user->direccion}}</li></ul></td>
                    </tr>
                    <tr>
                        <th scope="row"><p class="lead">N°Celular  :</p></th>
                            <td><ul><li>{{ $user->celular}}</li></ul></td>
                    </tr>
                    <tr>
                        <th scope="row"><p class="lead">Referencia :</p></th>
                            <td><ul><li>{{ $user->referencia}}</li></ul></td>
                    </tr>
                </tbody>
            </table>
            <br>
            @endforeach

 
            <H2><ins>Postgrados y Otros</ins></H2> 
                
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col"><p class="lead">Nombre Curso o Especialidad</p></th>
                            <th scope="col"><p class="lead">Nombre Entidad</p></th>
                            <th scope="col"><p class="lead">Fecha Inicio</p></th>
                            <th scope="col"><p class="lead">Fecha Final</p></th>
                        </tr>
                    </thead>
                    @foreach($pg as $peg)
                    <tbody>
                        <tr>
                            <th scope="row"><ul><li>{{ $peg->agrado_academico}}</li></ul></th>
                            <td>{{ $peg->entidad}}</td>
                            <td>{{ $peg->desde}}</td>
                            <td>{{ $peg->hasta}}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                <br>


            <H2><ins>Experiencia Laboral</ins></H2> 
                
                <table class="table table-sm">
                    <thead>
                        <tr>
                        <th scope="col"><p class="lead">Nombre de la Empresa</p></th>
                        <th scope="col"><p class="lead">Rubro Empresa</p></th>
                        <th scope="col"><p class="lead">Incio Contrato</p></th>
                        <th scope="col"><p class="lead">Final Contrato</p></th>
                        </tr>
                    </thead>
                    @foreach($xp as $xpe)
                    <tbody>
                        <tr>
                        <th scope="row"><ul><li>{{ $xpe->empresa}}</li></ul></th>
                        <td>{{ $xpe->rubro_empresa}}</td>
                        <td>{{ $xpe->inicio}}</td>
                        <td>{{ $xpe->final}}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>      
               
            
            </div>
        </div>
    </div>
    
</body>
</html>