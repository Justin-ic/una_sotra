@extends('layouts.app')

@section('contenu')

<!-- <div class="container-fluid">

<div class="row d-flex justify-content-center align-items-center ">
    <div class="col-8 col-md-4 " >
        <h1>La liste des étudiants</h1> 
    </div>
    //<div class="col-1"></div>
        <div class="col-4 col-md-1">
            <select class="form-control" required name="service_id">
                <option><a href=""></a>Du jour</option>
                <option><a href=""></a>Tous</option>
            </select>
        </div>
    //<div class="col-12 col-md-1 " ></div>
        <button class="col-12 col-md-1 btn btn-outline-success" type="submit">Search</button>
    

</div>
</div> -->


<div class="table-responsive" style="margin: 10px;">



<!-- <h1 class="MCenter">La liste des étudiants 
    <span class="form-group" style="display: inline;">
        <b>Service:</b>
        <select class="form-control" required name="service_id" style="display: inline;">
            <option value="" ></option>
                <option><a href=""></a>Du jour</option>
                <option><a href=""></a>Tous</option>
            </select>
    </span> -->

<!--     <span class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            du jour
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="#">Tout</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
    </span>
</h1> -->

<h1 class="MCenter">La liste des étudiants</h1>
    <table class="table table-bordered table-striped">
        <thead>
            <tr class="MCenter">
                <th>N°</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Genre</th>
                <th>N° Téléphone</th>
                <th>NCE</th>
                <th>Naissance</th>
                <th>Date</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
<!--         <pre>
<?php 
// print_r($liste);

 ?></pre> -->
        <tbody>
            <?php $i=1; if ($liste->count() > 0):  if (isset($_GET['page'])) { $i=$_GET['page']*5 - 4;} ?>
                <?php foreach ($liste as $client): ?>
            <tr  class="MCenter">
                <td><?=$i++ ?></td>
                <td>{{$client->nom}}</td>
                <td>{{$client->prenom}}</td>
                <td>{{$client->genre}}</td>
                <td>{{$client->numero}}</td>
                <td>{{$client->nce}}</td>
                <td>{{$client->dateNaissance}}</td>
                <td>{{$client->created_at->format('d/m/Y')}}</td>
                <td>
                    <a href="{{route('clients.edit', $client->id)}}"><button class="btn btn-success modif_sup">Modif <span class="fas fa-edit"></span></button>
                    </a>
                </td>
                <td>
                    <a href="{{route('destroy_client',$client->id)}}"><button class="btn btn-danger modif_sup">Sup <span class="fas fa-times-circle"></span></button></a>
                </td>

            </tr> 
                <?php endforeach ?> 
            <?php endif ?>



        </tbody>
        
        <tfoot  class="MCenter">
            <th>N°</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Genre</th>
            <th>N° Téléphone</th>
            <th>NCE</th>
            <th>Naissance</th>
            <th>Date</th>
            <th colspan="2">Action</th>
        </tfoot>
    </table>
    <a href="{{route('clients.create')}}"><button class="btn btn-primary">Ajouter <span class=" fas fa-plus-circle"></button></a>

</div>




<div class="d-flex justify-content-center">
    {{$liste->links()}}   
</div>

<!-- 
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
</nav> -->














<!--

<br>

 <style >
svg.w-5 {
    /*vertical-align: middle;*/
    width: 30px;
    display: inline;
}
</style> 

En utilisant simplePaginate() dans le controleur, on n'a pas besoin du style

<br><br>

-->
@endsection   


