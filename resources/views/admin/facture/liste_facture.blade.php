@extends('./layouts/admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/payementCSS.css') }}">
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">


            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('liste_facture',2) || Route::currentRouteNamed('liste_facture',2) ? 'active' : '' }}" href="{{route('liste_facture',2)}}">
                                    <i class="fa fa-list">Liste des Factures</i></a>
                            </li>
                            @canany(['isSuperAdmin','isCFP'])
                            <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('facture') ? 'active' : '' }}" href="{{route('facture')}}">
                                    <i class="fa fa-plus">Nouveau Facture</i></a>
                            </li>
                            @endcanany



                        </ul>


                    </div>
                </div>
            </nav>



            <div class="col-lg-12">
                <br>
                <h3> <strong>Liste Facture</strong></h3>
            </div>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item mx-2">
                                <h6>
                                    <a class="nav-link {{ Route::currentRouteNamed('liste_facture',0) || Route::currentRouteNamed('liste_facture',0) ? 'active' : '' }}" href="{{route('liste_facture',0)}}">Payée<strong style="color: red;">
                                            @if ($compte_facture_payer == null)
                                            (0)
                                            @else
                                            ({{$compte_facture_payer->totale}})
                                            @endif

                                        </strong></a></h6>
                            </li>
                            <li class="nav-item mx-2">
                                <h6>
                                    <a class="nav-link {{ Route::currentRouteNamed('liste_facture',1) || Route::currentRouteNamed('liste_facture',1) ? 'active' : '' }}" href="{{route('liste_facture',1)}}">En cours<strong style="color: red;">
                                            @if ($compte_facture_en_cour == null)
                                            (0)
                                            @else
                                            ({{$compte_facture_en_cour->totale}})
                                            @endif
                                        </strong></a></h6>
                            </li>
                            <li class="nav-item mx-2">
                                <h6>
                                    <a class="nav-link {{ Route::currentRouteNamed('liste_facture',2) || Route::currentRouteNamed('liste_facture',2) ? 'active' : '' }}" href="{{route('liste_facture',2)}}">Validée <strong style="color: red;">
                                            @if ($compte_facture_actif == null)
                                            (0)
                                            @else
                                            ({{$compte_facture_actif->totale}})
                                            @endif
                                        </strong> </a></h6>
                            </li>
                            <li class="nav-item mx-2">
                                <h6>
                                    <a class="nav-link {{ Route::currentRouteNamed('liste_facture',3) || Route::currentRouteNamed('liste_facture',3) ? 'active' : '' }}" href="{{route('liste_facture',3)}}">Brouillons<strong style="color: red;">
                                            @if ($compte_facture_inactif == null)
                                            (0)
                                            @else
                                            ({{$compte_facture_inactif->totale}})
                                            @endif
                                        </strong></a></h6>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <form class="form-inline my-2 my-lg-0">
                                @csrf
                                <li class="nav-item dropdown mx-2">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">numéro facture<strong class="text-red">*</strong></label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="numéro facture" list="num_facture" name="sts" />
                                        <datalist id="num_facture">
                                            @foreach ($facture_actif as $tab)
                                            <option>{{$tab->num_facture}}</option>
                                            @endforeach
                                        </datalist>
                                    </div>
                                </li>

                                <li class="nav-item dropdown mx-2">
                                    <div class="mb-3">
                                        <input type="submit" class="form-control btn btn-success" id="exampleFormControlInput1" placeholder="Invoice Date" value="recherche" />
                                    </div>
                                </li>

                            </form>

                        </ul>

                    </div>

                </div>
            </nav>

        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="table-responsive">


                            <div class="container-fluid my-2">


                                <div class="row">

                                    <table class="table table-striped ">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Numéro de facture</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Invoice Date</th>
                                                <th scope="col">Due Date</th>
                                                <th scope="col">Date Totale</th>
                                                <th scope="col"> Status </th>
                                                @canany(['isCFP'])
                                                <th scope="col" colspan="2">Action</th>
                                                @endcanany
                                                <th></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($facture_actif) > 0)
                                            @if($entreprise!=null)
                                            @foreach ($projet as $pj)
                                            @foreach ($facture_actif as $actif)
                                            @if($pj->id == $actif->projet_id)
                                            <tr>
                                                <td class="text-center" style="color:green;">O</td>
                                                <th>
                                                    <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                        <strong> <i class="fa fa-barcode"></i> {{$actif->num_facture}} </strong>
                                                    </a>
                                                </th>
                                                <td>{{$actif->other_message}}</td>
                                                <td>{{$actif->invoice_date}}</td>
                                                <td>{{$actif->due_date}}</td>
                                                <td>{{$actif->totale_jour.' jour(s))'}}</td>

                                                @if ($actif->jour_restant<0) <td style="color:red;">temps de payement a éxpirer!</td>

                                                    @else

                                                    <td style="color:rgb(221, 23, 178);">{{$actif->jour_restant.' jour(s))'}}</td>

                                                    @endif

                                                    @if ($actif->facture_encour == "valider")
                                                    {{-- @canany(['isCFP','isReferent']) --}}
                                                    <td style="color:red;"><i class="fa fa-bolt"></i>{{$actif->facture_encour}}</td>
                                                    {{-- @endcanany --}}
                                                    @canany(['isCFP'])
                                                    <td>

                                                        <div class="btn-group dropleft">
                                                            <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <button class="dropdown-item btn btn-success btn-block mb-2 payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-toggle="modal" data-target="#modal"><i class="fa fa-money"></i>Faire un encaissement</button>
                                                                <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="submit" class="btn btn-info"><i class="fa fa-eye"></i>Liste des encaissements</button></a>
                                                                <hr class="dropdown-divider">
                                                                <a class="dropdown-item" href="{{route('facture')}} ">creer nouveau facture</a>
                                                                {{-- <a class="dropdown-item" href="{{route('profile_entreprise',$etp->entreprise_id)}}"><i class="fa fa-eye"></i> &nbsp; Afficher</a>
                                                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#exampleModal_{{$etp->entreprise_id}}"><i class="fa fa-trash"></i> <strong style="color: red">Mettre fin à la collaboration</strong></a> --}}
                                                            </div>
                                                        </div>


                                                        {{-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            ...
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                            <li>
                                                                <button class="btn btn-success btn-block mb-2 payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-toggle="modal" data-target="#modal"><i class="fa fa-money"></i>Faire un encaissement</button>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="submit" class="btn btn-info"><i class="fa fa-eye"></i>Liste des encaissements</button></a>
                                                        </li>
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>
                                                        <li><a class="dropdown-item" href="{{route('facture')}} ">creer nouveau facture</a></li>
                                                        </ul> --}}


                                                    </td>
                                                    @endcanany

                                                    @elseif ($actif->facture_encour == "en_cour")

                                                    <td style="color:rgb(198, 201, 25);"><i class="fa fa-shopping-bag"></i> {{$actif->facture_encour}}</td>
                                                    @canany(['isCFP'])
                                                    <td>

                                                        <div class="btn-group dropleft">
                                                            <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <button class="btn btn-success btn-block mb-2 payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-toggle="modal" data-target="#modal"><i class="fa fa-money"></i>Faire un encaissement</button>
                                                                <a href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="submit" class="btn btn-info"><i class="fa fa-eye"></i>Liste des encaissements</button></a>
                                                                <hr class="dropdown-divider">
                                                                <a class="dropdown-item" href="{{route('facture')}} ">creer nouveau facture</a>
                                                                {{-- <a class="dropdown-item" href="{{route('profile_entreprise',$etp->entreprise_id)}}"><i class="fa fa-eye"></i> &nbsp; Afficher</a>
                                                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#exampleModal_{{$etp->entreprise_id}}"><i class="fa fa-trash"></i> <strong style="color: red">Mettre fin à la collaboration</strong></a> --}}
                                                            </div>
                                                        </div>

                                                        {{-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            ...
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                            <li>
                                                                <button class="btn btn-success btn-block mb-2 payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-toggle="modal" data-target="#modal"><i class="fa fa-money"></i>Faire un encaissement</button>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="submit" class="btn btn-info"><i class="fa fa-eye"></i>Liste des encaissements</button></a>
                                                        </li>
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>
                                                        <li><a class="dropdown-item" href="{{route('facture')}} ">creer nouveau facture</a></li>
                                                        </ul> --}}
                                                    </td>
                                                    @endcanany

                                                    @else
                                                    <td style="color:rgb(15, 221, 67);"><i class="fa fa-check-circle"></i><i class="fa fa-check-circle"></i> {{$actif->facture_encour}}</td>
                                                    @canany(['isCFP'])
                                                    <td>

                                                        <div class="btn-group dropleft">
                                                            <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{route('imprime_feuille_facture',$actif->num_facture)}}">PDF</a>
                                                                <a href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="submit" class="btn btn-info"><i class="fa fa-eye"></i>Liste des encaissements</button></a>
                                                                <hr class="dropdown-divider">
                                                                <a class="dropdown-item" href="{{route('facture')}} ">creer nouveau facture</a>
                                                            </div>
                                                        </div>

                                                        {{-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            ...
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                            <li><a class="dropdown-item" href="{{route('imprime_feuille_facture',$actif->num_facture)}}">PDF</a></li>
                                                        <li>
                                                            <a href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="submit" class="btn btn-info"><i class="fa fa-eye"></i>Liste des encaissements</button></a>
                                                        </li>
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>
                                                        <li><a class="dropdown-item" href="{{route('facture')}} ">creer nouveau facture</a></li>
                                                        </ul> --}}
                                                    </td>
                                                    @endcanany
                                                    @endif
                                            </tr>
                                            @endif
                                            @endforeach
                                            @endforeach
                                            @else
                                            @foreach ($facture_actif as $actif)

                                            <tr>
                                                <td class="text-center" style="color:green;">O</td>
                                                <th>
                                                    <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                        <strong> <i class="fa fa-barcode"></i> {{$actif->num_facture}} </strong>
                                                    </a>
                                                </th>
                                                <td>{{$actif->other_message}}</td>
                                                <td>{{$actif->invoice_date}}</td>
                                                <td>{{$actif->due_date}}</td>
                                                <td>{{$actif->totale_jour.' jour(s))'}}</td>

                                                @if ($actif->jour_restant<0) <td style="color:red;">temps de payement a éxpirer!</td>

                                                    @else

                                                    <td style="color:rgb(221, 23, 178);">{{$actif->jour_restant.' jour(s))'}}</td>

                                                    @endif

                                                    <td>

                                                        @if ($actif->facture_encour == "valider")

                                                    <td style="color:red;"><i class="fa fa-bolt"></i>{{$actif->facture_encour}}</td>
                                                    <td>


                                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                            <li>
                                                                <button class="btn btn-success btn-block mb-2 payement" data-id="{{ $actif->num_facture }}" data-cfp="{{ $actif->cfp_id }}" id="{{ $actif->num_facture }}" data-toggle="modal" data-target="#modal"><i class="fa fa-money"></i>Faire un encaissement</button>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="submit" class="btn btn-info"><i class="fa fa-eye"></i>Liste des encaissements</button></a>
                                                            </li>
                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            <li><a class="dropdown-item" href="{{route('facture')}} ">creer nouveau facture</a></li>
                                                        </ul>
                                                    </td>

                                                    @elseif ($actif->facture_encour == "en_cour")

                                                    <td style="color:rgb(198, 201, 25);"><i class="fa fa-shopping-bag"></i> {{$actif->facture_encour}}</td>
                                                    <td>
                                                        <div class="btn-group dropleft">
                                                            <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <button class="dropdown-item btn btn-success btn-block mb-2 payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-toggle="modal" data-target="#modal"><i class="fa fa-money"></i>Faire un encaissement</button> <a href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="submit" class="btn btn-info"><i class="fa fa-eye"></i>Liste des encaissements</button></a>
                                                                <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="submit" class="btn btn-info"><i class="fa fa-eye"></i>Liste des encaissements</button></a>

                                                                <hr class="dropdown-divider">
                                                                <a class="dropdown-item" href="{{route('facture')}} ">creer nouveau facture</a>
                                                            </div>
                                                        </div>

                                                        {{-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            ...
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                            <li>
                                                                <button class="btn btn-success btn-block mb-2 payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-toggle="modal" data-target="#modal"><i class="fa fa-money"></i>Faire un encaissement</button>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="submit" class="btn btn-info"><i class="fa fa-eye"></i>Liste des encaissements</button></a>
                                                            </li>
                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            <li><a class="dropdown-item" href="{{route('facture')}} ">creer nouveau facture</a></li>
                                                        </ul> --}}
                                                    </td>

                                                    @else
                                                    <td style="color:rgb(15, 221, 67);"><i class="fa fa-check-circle"></i><i class="fa fa-check-circle"></i> {{$actif->facture_encour}}</td>

                                                    <td>
                                                        <div class="btn-group dropleft">
                                                            <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{route('imprime_feuille_facture',$actif->num_facture)}}">PDF</a>
                                                                <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="submit" class="btn btn-info"><i class="fa fa-eye"></i>Liste des encaissements</button></a>
                                                                <hr class="dropdown-divider">
                                                                <a class="dropdown-item" href="{{route('facture')}} ">creer nouveau facture</a>
                                                            </div>
                                                        </div>

                                                        {{-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            ...
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                            <li><a class="dropdown-item" href="{{route('imprime_feuille_facture',$actif->num_facture)}}">PDF</a></li>
                                                            <li>
                                                                <a href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="submit" class="btn btn-info"><i class="fa fa-eye"></i>Liste des encaissements</button></a>
                                                            </li>
                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            <li><a class="dropdown-item" href="{{route('facture')}} ">creer nouveau facture</a></li>
                                                        </ul> --}}
                                                    </td>
                                                    @endif
                                                    </td>
                                            </tr>
                                            @endforeach
                                            @endif

                                            @else
                                            <tr>
                                                <td colspan="8" class="text-center" style="color:red;">Aucun Résultat</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>

                                </div>


                                {{-- debut modal encaissement --}}
                                <div id="modal" class="modal fade" data-backdrop="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="modal-title text-md">
                                                    <h5>Reste à payer : <label id="montant"></label> Ar</h5>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card p-3 cardPayement">
                                                    <form action="{{ route('encaisser') }}" id="formPayement" method="POST">
                                                        @csrf
                                                        <h6 class="text-uppercase">Payment details</h6>
                                                        <div class="inputbox inputboxP mt-3"> <input autocomplete="off" type="text" name="libelle" class="form-control formPayement" required="required"> <span>Description</span> </div>
                                                        <div class="inputbox inputboxP mt-3"> <input autocomplete="off" type="number" min="1" pattern="[0-9]" name="montant" class="form-control formPayement" required="required"> <span>Montant à facturer</span> </div>
                                                        <select class="form-select selectP" name="mode_payement" aria-label="Default select example">
                                                            @foreach ($mode_payement as $mp)
                                                            <option value="{{ $mp->id }}">{{ $mp->description }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="inputbox inputboxP mt-3"> <input type="date" name="date_encaissement" class="form-control formPayement" required="required" value="{{ date('d/m/Y') }}"></div>
                                                        <div class="inputbox inputboxP mt-3" id="numero_facture"></div>
                                                    </form>
                                                    <div class="mt-4 mb-4">
                                                        <div class="mt-4 mb-4 d-flex justify-content-between"> <span><button type="button" class="btn btn-danger annuler" data-dismiss="modal">Annuler</button></span> <button type="submit" form="formPayement" class="btn btn-success btnP px-3">Validé</button> </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                {{-- fin --}}





                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- modal reussi --}}
        @if (Session::has('encaissement_ok'))
        <div id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <fieldset>
                            <div class="form-card">
                                <h2 class="fs-title text-center">{{ Session::get('encaissement_ok') }}</h2> <br><br>
                                <div class="row justify-content-center">
                                    <div class="col-3"> <img src="{{ asset('img/images/ok.png') }}" class="fit-image"> </div>
                                </div> <br>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
        @endif
        {{-- fin --}}

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script type="text/javascript">
        $(".payement").on('click', function(e) {
            $('#montant').html('');
            $("#numero_facture").html('')
            var id = $(this).data("id");
            var cfp_id = $(this).data("cfp");

            $.ajax({
                method: "GET"
                , url: "{{route('montant_restant')}}"
                , data: {
                    num_facture: id
                    , cfp_id: cfp_id
                }
                , dataType: "html"
                , success: function(response) {
                    var userData = JSON.parse(response);
                    $("#montant").append(userData[0]);
                    var html = '<input type="hidden" name="num_facture" value="' + userData[1] + '" required>';
                    $('#numero_facture').append(html);
                }
                , error: function(error) {
                    console.log(error)
                }
            });
        });

    </script>
    <script>
        $(document).ready(function() {
            $("#myModal").modal('show');
        });

    </script>

    @endsection
