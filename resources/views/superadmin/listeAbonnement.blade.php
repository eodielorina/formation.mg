@extends('layouts.admin')
@section('title')
<p class="text_header m-0 mt-1">Abonnement</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/abonnement.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js"
    integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>
<div class="container-fluid">
    {{-- <div class="col-md">
        <div class="">
            <a href="#" class="btn_creer text-center filter" role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>Afficher les filtres</a>
        </div>
    </div> --}}
    <div class="m-4" role="tabpanel">
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            <li class="nav-item active">
                <a href="#service" class="nav-link active" data-toggle="tab">Historique des services</a>
            </li>
            <li class="nav-item">
                <a href="#abonnement" class="nav-link " data-toggle="tab">Abonnements</a>
            </li>
            <li class="nav-item">
                <a href="#facture" class="nav-link" data-toggle="tab">Factures</a>
            </li>
        </ul>
        
        <div class="tab-content">
            <div class="tab-pane fade show" id="abonnement">
                @if (\Session::has('erreur'))
                    <div class="row w-50 text-center mx-auto">
                        <div class="alert alert-danger justify-content-center mt-5">
                            <ul>
                                <li>{!! \Session::get('erreur') !!}</li>
                            </ul>
                        </div>
                    </div>
                @endif
                @if (\Session::has('erreur_abonnement'))
                    <div class="row w-50 text-center mx-auto">
                        <div class="alert alert-danger justify-content-center mt-5">
                            <ul>
                                <li>{!! \Session::get('erreur_abonnement') !!}</li>
                            </ul>
                        </div>
                    </div>
                @endif

                <div>
                    <p class="h2 text-center mt-3 mb-5">Choisissez Votre Abonnement</p>
                </div>

               <div class="row mt-3">
                    <div class="col-lg-12 d-flex">
                        @foreach ($typeAbonnement as $types)
                            @foreach ($tarif as $tf)
                                @if($tf->type_abonnement_role_id == $types->types_id)
                                    <div class="col mt-5 justify-content-between">
                                        <div class="card d-flex align-items-center justify-content-center">
                                            <div class="ribon"> <span class="bx bxs-star-half"></span> </div>
                                            <p class="h-1 pt-5">{{ $types->nom_type }}</p> <span class="price"> <span class="number"> {{number_format($tf->tarif,0, ',', '.')}}</span> <sup
                                                    class="sup">AR</sup>/ mois</span>
                                            <ul class="mb-5 list-unstyled text-muted">
                                                @if( $types->nom_type == 'Gratuit')
                                                    <li><span class="bx bx-check me-2"></span>Essai gratuit pendant 60jours</li>
                                                @endif
                                                @if( $types->nom_type == 'TPE')
                                                    <li><span class="bx bx-check me-2"></span>0 - 9 employés</li>
                                                @endif
                                                @if( $types->nom_type == 'PME')
                                                    <li><span class="bx bx-check me-2"></span>10 - 49 employés</li>
                                                @endif
                                                @if( $types->nom_type == 'EI')
                                                    <li><span class="bx bx-check me-2"></span>50 - 249 employés</li>
                                                @endif
                                                @if( $types->nom_type == 'GE')
                                                    <li><span class="bx bx-check me-2"></span>250 employés</li>
                                                @endif

                                            </ul>
                                            @if($abonnement_actuel != null)
                                                @if($types->types_abonnement_id == $abonnement_actuel[0]->type_abonnement_id and $abonnement_actuel[0]->activite == 1)
                                                <div class="btn btn-primary"><a href="{{route('desactiver_offre',['id'=>$types->types_abonnement_id])}}">Désactivation immédiat de mon offre</a></div>
                                                @else
                                                    <div class="btn btn-primary"><a href="{{route('abonnement-page',['id'=>$tf->id])}}">S'abonner</a></div>
                                                @endif
                                            @else
                                            <div class="btn btn-primary"><a href="{{route('abonnement-page',['id'=>$tf->id])}}">S'abonner</a></div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    </div>

                </div><br><br>
            </div><br>
            <div class="tab-pane fade show" id="facture">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Numéro de facture</th>
                        <th scope="col">Type d'abonnement</th>
                        <th scope="col">Montant HT</th>
                        <th scope="col">TVA (20%)</th>
                        <th scope="col">Net à payer TTC</th>
                        <th scope="col">Invoice date</th>
                        <th scope="col">Due date</th>
                        <th scope="col">Statut</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @foreach ($facture as $fact )
                            <tr>
                                <td><a href="{{route('detail_facture_abonnement',$fact->facture_id)}}" style="text-decoration: underline">{{$fact->num_facture}}</a></td>


                                <td>{{$fact->nom_type}}</td>
                                <td>{{number_format($fact->montant_facture, 0, ',', '.')}} Ar</td>
                                <td>{{number_format($tva[$i], 0, ',', '.')}} Ar</td>
                                <td>{{number_format($net_ttc[$i], 0, ',', '.')}} Ar</td>
                                <td>{{$fact->invoice_date}}</td>
                                <td>{{$fact->due_date}}</td>
                                @if($fact->status_facture == "Non payé")
                                    <td><span style="background-color: red;padding:5px;color:white">{{$fact->status_facture}}</span></td>
                                @endif
                            </tr>
                            @php $i += 1; @endphp
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade show active" id="service">
                @if (\Session::has('arret_immediat'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('arret_immediat') !!}</li>
                        </ul>
                    </div>
                @endif
                @if (\Session::has('arret_fin'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('arret_fin') !!}</li>
                        </ul>
                    </div>
                @endif
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Date d'inscription</th>
                        <th scope="col">Type d'abonnement</th>
                        <th scope="col">Catégorie</th>
                        <th scope="col">Activité</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                        @foreach ($facture as $fact )
                            <tr>
                                <td>{{$fact->invoice_date}}</td>
                                <td>{{$fact->nom_type}}</td>
                                <td>{{$fact->categorie}}</td>
                                @if($fact->activite == 1)
                                    <td>En cours</td>
                                @else
                                    <td>Terminé</td>
                                @endif
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                          Arrêter le service
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            @can('isReferent')
                                                <li>
                                                    <a class="dropdown-item" href="{{route('arret_immediat_abonnement_entreprise',$fact->abonnement_id)}}"><i class="bx bx-x" style="position: relative; top:0.3rem; font-size:1.3rem; color:red"></i> &nbsp; Arrêter immédiatement</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{route('arret_fin_abonnement_entreprise',$fact->abonnement_id)}}"><i class="bx bx-x" style="position: relative; top:0.3rem; font-size:1.3rem; color:red"></i>&nbsp; Arrêter à la fin de l'abonnement</a>
                                                </li>
                                            @endcan
                                            @can('isCFP')
                                                <li>
                                                    <a class="dropdown-item" href=""><i class="bx bx-x" style="position: relative; top:0.3rem; font-size:1.3rem; color:red"></i> &nbsp; Arrêter immédiatement</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#exampleModal_"><i class="bx bx-x" style="position: relative; top:0.3rem; font-size:1.3rem; color:red"></i>&nbsp; Arrêter à la fin de l'abonnement</a>
                                                </li>
                                            @endcan
                                        </ul>
                                      </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


{{-- filter abonnement --}}
{{-- <div class="filtrer mt-3 testFilter">
    <div class="row">
        <div class="row">
            <div class="col-md-11">
                <p class="m-0" style="color: #0052D4; text-transform: uppercase">Filter vos Abonnements</p>
            </div>
            <div class="col-md-1 text-end">
                <i class="bx bx-x " role="button" onclick="afficherFiltre();"></i>
            </div>
        </div>
        <hr class="mt-2">
        <div class="col-12 pe-3">
            <div class="row mb-3 p-2 pt-0">
                      <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                              Historique des services
                            </button>
                          </h2>
                          <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <form action="/referents/filtre/query/fonction" method="post" >
                                    @csrf
                                    <input style="width: 265px" type="text" name="fonctionReferent" id="fonctionReferent" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez une fonction ...">
                                </form>
                                <hr>
                                <form action="/referents/filtre/query/name" method="post" >
                                    @csrf
                                    <input style="width: 265px" type="text" name="nameReferent" id="nameReferent" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez un nom ...">
                                </form>
                                <form action="/referents/filtre/query/matricule" method="post">
                                    @csrf
                                    <input style="width: 265px" type="text" name="matriculeReferent" id="matriculeReferent" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez une matricule ...">
                                </form>
                                <form action="/referents/filtre/query/role" method="post">
                                    @csrf
                                    <input style="width: 265px" type="text" name="roleReferent" id="roleReferent" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez un rôle ...">
                                </form>
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                              Abonnements
                            </button>
                          </h2>
                          <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <form action="/employes/filtre/query/fonction" method="post">
                                    @csrf
                                    <input style="width: 265px" type="text" name="test" id="test" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez une fonction ...">
                                </form>
                                <hr>
                                <form action="/employes/filtre/query/name" method="post" >
                                    @csrf
                                    <input style="width: 265px" type="text" name="name" id="name" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez un nom ...">
                                </form>
                                <form action="/employes/filtre/query/matricule" method="post">
                                    @csrf
                                    <input style="width: 265px" type="text" name="matricule" id="matricule" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez une matricule ...">
                                </form>
                                <form action="/employes/filtre/query/role" method="post">
                                    @csrf
                                    <input style="width: 265px" type="text" name="role_name" id="role_name" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez un rôle ...">
                                </form>
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingFour">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseThree">
                                Factures
                              </button>
                            </h2>
                            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <form action="/chefs/filtre/query" method="post">
                                        @csrf
                                        <form action="/chefs/filtre/query/fonction" method="post" >
                                            @csrf
                                            <input style="width: 265px" type="text" name="fonctionChef" id="fonctionChef" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez une fonction ...">
                                        </form>
                                    </form>
                                    <hr>
                                    <form action="/chefs/filtre/query/name" method="post" >
                                        @csrf
                                        <input style="width: 265px" type="text" name="nameChef" id="nameChef" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez un nom ...">
                                    </form>
                                    <form action="/chefs/filtre/query/matricule" method="post">
                                        @csrf
                                        <input style="width: 265px" type="text" name="matriculeChef" id="matriculeChef" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez une matricule ...">
                                    </form>
                                    <form action="/chefs/filtre/query/role" method="post">
                                        @csrf
                                        <input style="width: 265px" type="text" name="roleChef" id="roleChef" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez un rôle ...">
                                    </form>
                                </div>
                            </div>
                          </div>
                      </div>
            </div>
        </div>
    </div>
</div> --}}

<script>
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            let lien = ($(e.target).attr('href'));
            localStorage.setItem('activeTab', lien);
        });
        let activeTab = localStorage.getItem('activeTab');
        if(activeTab){
            $('#myTab a[href="' + activeTab + '"]').tab('show');
        }
</script>


@endsection