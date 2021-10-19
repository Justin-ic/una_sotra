<!-- <script type="text/javascript">
	alert('Je vien d arriver dans  bienVenusAdmin');
</script> -->
@extends('layouts.app')
@section('contenu')

<div class="BienvenusAdmin  d-flex justify-content-center align-items-center">
	<h1>Bienvénus Administrateur </h1>
</div>

@endsection  


<!-- 


Avant  de mettre en production, je dois remplacer 	
url="https://localhost/una_sotra/public/ClientLocation/"+idClient+"/"+coordonnees[0]+"/"+coordonnees[1];

Par url = "https://glacial-everglades-43629.herokuapp.com/ClientLocation/"+idClient+"/"+coordonnees[0]+"/"+coordonnees[1];
Dans clientTicket.blade.php ligne 87



cd C:\xampp\htdocs\una_sotra

git status
git add *
git commit -m ""

git push origin master 

git push heroku master



heroku pg:reset DATABASE_URL --confirm glacial-everglades-43629
heroku run php artisan migrate 




 -->