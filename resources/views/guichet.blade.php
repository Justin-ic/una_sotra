@extends('layouts.app')

@section('contenu')



<div class="table-responsive">
    <h1 class="MCenter">La liste des guichets de l'entreprise</h1>
    <table class="table table-bordered">
        <thead>
            <tr class="MCenter">
                <th>N°</th>
                <th>Lettre Guichet</th>
                <th>Service</th>
                <th>Personnel</th>
                <th>Date Modition</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
<!--         <pre>
<?php 
// print_r($liste);
/*guichet_service
guichet_personnel*/ 
 ?></pre> -->
        <tbody>
            <?php $i=1; if ($guichet->count() > 0): ?>
                <?php foreach ($guichet as $Le_guichet): /*dd($Le_guichet->service);*/ ?>
            <tr  class="MCenter">

                <td><?=$i++ ?></td>
                <td>{{$Le_guichet->lettre_guichet}}</td>
                <td>{{$Le_guichet->service->nom}}</td>
                <?php //dd($Le_guichet->personnel->prenom); ?>
                <td>{{$Le_guichet->personnel->nom}} {{$Le_guichet->personnel->prenom}}</td>
                <td>{{$Le_guichet->updated_at->format('d/m/Y')}}</td>
                <td>
                    <a href="{{route('guichets.edit', $Le_guichet->id)}}"><button class="btn btn-success">Modifier <span class="fas fa-edit"></span> </button>
                    </a>
                </td>
                <td>
                    <a href="{{route('destroy_guichet',$Le_guichet->id)}}"><button class="btn btn-danger">Supprimer <span class="fas fa-times-circle"></button></a>
                </td>

            </tr> 
                <?php endforeach ?> 
            <?php endif ?>
<!-- lettre_guichet
service_id
personnel_id -->


        </tbody>
        
        <tfoot  class="MCenter">
        	<th>N°</th>
        	<th>Lettre Guichet</th>
        	<th>Service</th>
        	<th>Personnel</th>
        	<th>Date création</th>
        	<th colspan="2">Action</th>
        </tfoot>
    </table>
    <a href="{{route('guichets.create')}}"><button class="btn btn-primary">Ajouter <span class=" fas fa-plus-circle"></button></a>

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
    <!-- $liste->links() -->
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