@extends('layouts.app')

@section('contenu')



<div class="table-responsive">
    <h1 class="MCenter">La liste du personnel de l'entreprise</h1>
    <table class="table table-bordered">
        <thead>
            <tr class="MCenter">
                <th>N°</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de Naissance</th>
                <th>User</th>
                <th>Mot de passe</th>
                <th>Type</th>
                <th>Date</th>
                <th colspan="2">Action</th> 
                <!-- nom 	pernom dateNaissance	 user	 pass	 	created_at 	updated_at 	 -->
            </tr>
        </thead>
<!--         <pre>
<?php 
// print_r($liste);
 ?></pre> -->
        <tbody>
            <?php $i=1; if ($liste->count() > 0): ?>
                <?php foreach ($liste as $personnel): ?>
            <tr  class="MCenter">
                <td><?=$i++ ?></td>
                <td>{{$personnel->nom}}</td>
                <td>{{$personnel->prenom}}</td>
                <td>{{$personnel->dateNaissance}}</td>
                <td>{{$personnel->user}}</td>
                <td>{{$personnel->pass}}</td>
                <td>{{$personnel->type}}</td>
                <td>{{$personnel->created_at->format('d/m/Y')}}</td>
                <td>
                    <a href="{{route('personnels.edit', $personnel->id)}}"><button class="btn btn-success">Modifier <span class="fas fa-edit"></span> </button>
                    </a>
                </td>
                <td>
                    <a href="{{route('destroy_personnel',$personnel->id)}}"><button class="btn btn-danger">Supprimer <span class="fas fa-times-circle"></button></a>
                </td>

            </tr> 
                <?php endforeach ?> 
            <?php endif ?>



        </tbody>
        
        <tfoot  class="MCenter">
            <th>N°</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de Naissance</th>
            <th>User</th>
            <th>Mot de passe</th>
            <th>Type</th>
            <th>Date</th>
            <th colspan="2">Action</th>
        </tfoot>
    </table>
    <a href="{{route('personnels.create')}}"><button class="btn btn-primary">Ajouter <span class=" fas fa-plus-circle"></button></a>

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
<style >
svg.w-5 {
    /*vertical-align: middle;*/
    width: 30px;
    display: inline;
}
</style>
<br><br>
@endsection   