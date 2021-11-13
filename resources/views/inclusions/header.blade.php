
<header  class="">

    <nav class="navbar navbar-expand-md navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#" style="color: blue; font-weight: bolder;">
          <img src="{{ asset('images/logoUNA.png') }}" alt="SOTR UNA" style="width: 50px;" >
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item d-flex align-items-center deroulant">

              <span class="dropdown">
                <span class=" dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Eudiants
                </span>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item" href="{{route('clients.index')}}">Tous</a></li>
                  <li><a class="dropdown-item" href="{{route('bilan_clients.index')}}">Bilant Général</a></li>
                </ul>
              </span>


                <!-- <a class="nav-link active" aria-current="page" href="{{route('clients.index')}}">Eudiants</a> -->
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{route('services.index')}}">Servie</a>
          </li>
          <li class="nav-item"> 
              <a class="nav-link" href="{{route('personnels.index')}}">Personnels</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{route('guichets.index')}}">Guichets</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{route('descriptions.index')}}">Descriptions</a> 
          </li>

          <li class="nav-item">
              <a class="nav-link" href="clientBienvenue">clientBienvenue</a> 
          </li>
          <li class="nav-item">
              <a class="nav-link" href="AdminVewClientLocation">AdminVewClientLocation</a> 
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('EditeIPESP8266')}}">IP_ESP8266</a> 
          </li>
      </ul>
      <span class="navbar-text">
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
  </span>
</div>
</div>
</nav>
</header>



