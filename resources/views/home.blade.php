@extends('layouts.app')

@section('contenu')



<div class="table-responsive">
    <h1 class="MCenter">La liste des clients du jour</h1>
    <table class="table table-bordered table-striped">
        <thead>
            <tr class="MCenter">
                <th>N°</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Numéro</th>
                <th>Commentair</th>
                <th>Ticket</th>
                <th>Date</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
<!--         <pre>
<?php 
// print_r($liste);

 ?></pre> -->
        <tbody>
            <?php $i=1; if ($liste->count() > 0): ?>
                <?php foreach ($liste as $client): ?>
            <tr  class="MCenter">
                <td><?=$i++ ?></td>
                <td>{{$client->nom}}</td>
                <td>{{$client->prenom}}</td>
                <td>{{$client->numero}}</td>
                <td>{{$client->commentaire}}</td>
                <td>{{$client->tickets->first()->ticket}}</td>
                <!-- <td></td> -->
                <td>{{$client->created_at->format('d/m/Y')}}</td>
                <td>
                    <a href="{{route('clients.edit', $client->id)}}"><button class="btn btn-success">Modifier <span class="fas fa-edit"></span> </button>
                    </a>
                </td>
                <td>
                    <a href="{{route('destroy_client',$client->id)}}"><button class="btn btn-danger">Supprimer <span class="fas fa-times-circle"></button></a>
                </td>

            </tr> 
                <?php endforeach ?> 
            <?php endif ?>



        </tbody>
        
        <tfoot  class="MCenter">
            <th>N°</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Numéro</th>
            <th>Commentair</th>
            <th>Ticket</th>
            <th>Date</th>
            <th colspan="2">Action</th>
        </tfoot>
    </table>
    <a href="{{route('clients.create')}}"><button class="btn btn-primary">Ajouter <span class=" fas fa-plus-circle"></button></a>

</div>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
















<br>
<span>
    {{$liste->links()}}   
</span>
<!-- <style >
svg.w-5 {
    /*vertical-align: middle;*/
    width: 30px;
    display: inline;
}
</style> 

En utilisant simplePaginate() dans le controleur, on n'a pas besoin du style
-->
<br><br>
@endsection   


