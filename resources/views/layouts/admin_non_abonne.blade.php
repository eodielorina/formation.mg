<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Formation.mg</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/fontawesome.min.css"
        integrity="sha512-8Vtie9oRR62i7vkmVUISvuwOeipGv8Jd+Sur/ORKDD5JiLgTGeBSkI3ISOhc730VGvA5VVQPwKIKlmi+zMZ71w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('assets/css/styleGeneral.css')}}">
    <link rel="shortcut icon" href="{{  asset('maquette/logo_fmg7635dc.png') }}" type="image/x-icon">
</head>

<body>
    <div class="sidebar active">
        {{-- <div class="logo_content">
            <div class="logo">
                <span><img src="{{asset('img/images/logo_fmg54Ko.png')}}" alt="" class="img-fluid"></span>
                <div class="logo_name"><a href="{{ route('home') }}">Formation.mg</a></div>
            </div>

        </div> --}}
        <ul class="nav_list mb-5" onclick="activer(event);" id="menu">

            <li>
                <a href="{{ route('home') }}" class="d-flex active nav_linke">
                    <i class="bx bxs-dashboard"></i>
                    <span class="links_name">Tableau de bord</span>
                </a>

            </li>



                @canany(['isReferent'])
                {{-- <li>
                    <a href="{{ route('afficher_iframe_entreprise') }}" class="d-flex nav_linke">
                        <i class='bx bxs-pie-chart-alt-2'></i>
                        <span class="links_name">BI</span>
                    </a>
                </li> --}}

                @endcanany
                @canany(['isCFP'])
                {{-- <li>
                    <a href="{{ route('afficher_iframe_cfp') }}" class="d-flex nav_linke">
                        <i class='bx bxs-pie-chart-alt-2'></i>
                        <span class="links_name">BI</span>
                    </a>
                </li> --}}
                @endcanany
                @canany(['isSuperAdmin'])
                <li>
                    <a href="{{ route('creer_iframe') }}" class="d-flex  nav_linke">
                        <i class='bx bxs-pie-chart-alt-2'></i>
                        <span class="links_name"> BI </span>
                    </a>
                </li>
                @endcanany




            @canany(['isCFP'])
            {{-- <li>
                <a href="{{route('liste_module')}}" class="d-flex nav_linke">
                    <i class="bx bx-customize"></i>
                    <span class="links_name">Modules</span>
                </a>

            </li> --}}
            @endcanany
            {{-- entreprise --}}
            @canany(['isSuperAdmin','isAdmin'])
            {{-- <li>
                <a href="{{route('liste_entreprise')}}" class="d-flex nav_linke">
                    <i class='bx bx-building-house'></i>
                    <span class="links_name">Entreprises</span>
                </a>

            </li> --}}
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouvelle_entreprise')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouvelle Entreprise</span>
                </a>

            <li class="my-1 sousMenu">
                <a href="{{route('departement.index')}}">D??partement</a>
            </li>
            </li> --}}
            @endcanany
            @canany(['isReferent'])
            <li>
                <a href="{{route('liste_departement')}}" class="d-flex nav_linke">
                    <i class='bx bx-home-alt'></i>
                    <span class="links_name">Departements</span>
                </a>

            </li>
            @endcanany
            @can('isCFP')
            {{-- <li>
                <a href="{{route('liste_entreprise')}}" class="d-flex nav_linke">
                    <i class='bx bx-building-house'></i>
                    <span class="links_name">Entreprises</span>
                </a>

            </li> --}}
            @endcan
            @can('isReferent')
            <li>
                <a href="{{route('list_cfp')}}" class="d-flex nav_linke">
                    <i class='bx bxs-business'></i>
                    <span class="links_name">Organisme (OF)</span>
                </a>

            </li>
            @endcan
            {{-- projet de formation --}}

            @canany(['isCFP','isFormateur'])
            {{-- <li>
                <a href="{{route('liste_projet')}}" class="d-flex nav_linke">
                    <i class='bx bx-library'></i>
                    <span class="links_name">Projets</span>
                </a>

            </li> --}}
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_projet')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Projet</span>
                </a>
                <span class="tooltip">Nouveau Projet</span>
            <li class="sousMenu me-2 d-flex justify-content-between">
                <a href="{{url('detail_session')}}">Sessions</a>
                <p class="my-1" id="projets_etp" style="background-color: white; border-radius: 2rem; padding: 0 8px;">
                </p>
            </li>
            </li> --}}
            @endcanany
            @canany(['isReferent'])
            {{-- <li>
                <a href="{{route('liste_projet')}}" class="d-flex nav_linke">
                    <i class='bx bx-library'></i>
                    <span class="links_name">Projets</span>
                </a>

            </li> --}}
            @endcanany
            @canany(['isReferent'])
            <li>
                <a href="{{route('projet_interne')}}" class="d-flex nav_linke">
                    <i class='bx bxl-netlify'></i>
                    <span class="links_name">Formation Interne</span>
                </a>

            </li>
            @endcanany
            @canany(['isStagiaire'])
            <li>
                <a href="{{route('liste_projet',['id'=>1])}}" class="d-flex nav_linke">
                    <i class='bx bx-library'></i>
                    <span class="links_name">Projets</span>
                </a>

            </li>
            @endcanany
            @canany(['isCFP','isReferent','isManager'])
            {{-- <li>
                <a href="{{route('appel_offre.index')}}" class="d-flex nav_linke">
                    <i class='bx bx-mail-send'></i>
                    <span class="links_name">Appel d'Offre</span>
                </a>

            </li> --}}
            @endcanany
            {{-- utilisateurs --}}
            @canany(['isSuperAdmin','isAdmin'])
            <li>
                <a href="{{route('liste_utilisateur')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Referent</span>
                </a>

            </li>
            <li>
                <a href="{{route('utilisateur_stagiaire')}}" class="d-flex nav_linke">
                    <i class='bx bx-user-circle'></i>
                    <span class="links_name">Stagiaires</span>
                </a>

            </li>
            <li>
                <a href="{{route('utilisateur_formateur')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Formateurs</span>
                </a>

            </li>
            @endcanany
            {{-- formateurs --}}

            @canany(['isCFP'])
            {{-- <li>
                <a href="{{route('liste_formateur')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Formateurs</span>
                </a>

            </li> --}}
            {{-- <li>
                <a href="{{route('nouveau_formateur')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Formateur</span>
                </a>

            </li> --}}
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_formateur')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Formateur</span>
                </a>

            </li> --}}
            @endcanany
            {{-- manager --}}
            @canany(['isSuperAdmin','isAdmin'])
            <li>
                <a href="{{route('employes')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Manager</span>
                </a>

            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_manager')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Manager</span>
                </a>

            </li> --}}
            @endcanany
            @canany(['isReferent'])
            <li>
                <a href="{{route('employes')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Equipe admnistrative</span>
                </a>

            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_manager')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Manager</span>
                </a>

            </li> --}}
            @endcanany
            {{-- Referent --}}
            @canany(['isAdmin','isSuperAdmin'])
            <li>
                <a href="{{route('liste_responsable')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">R??ferents</span>
                </a>

            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_responsable')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau R??ferents</span>
                </a>

            </li> --}}
            @endcanany
            {{-- stagiares --}}

            {{-- @canany(['isReferent'])
            <li>
                <a href="{{route('liste_participant')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Stagiaires</span>
                </a>

            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_participant')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Stagiaire</span>
                </a>

            </li> --}}
            {{-- @endcanany --}}
            {{-- action de formations --}}

            {{-- @canany(['isFormateur'])
            <li>
                <a href="{{route('presence.index')}}" class="d-flex nav_linke">
                    <i class='bx bx-list-check'></i>
                    <span class="links_name">Emargement</span>
                </a>

            </li>
            @endcanany --}}

            {{-- calendrire de formations --}}
            <li>
                @canany(['isReferent','isStagiaire','isManager'])
                    {{-- <a href="{{route('calendrier_formation')}}" class="d-flex nav_linke">
                        <i class='bx bxs-calendar'></i>
                        <span class="links_name">Calendrier</span>
                    </a> --}}
                @endcan
                @canany(['isCFP', 'isFormateur'])
                {{-- <a href="{{route('calendrier')}}" class="d-flex nav_linke">
                    <i class='bx bxs-calendar'></i>
                    <span class="links_name">Calendrier</span>
                </a> --}}
                @endcanany


            </li>

            {{-- commercial --}}
            {{-- @canany(['isSuperAdmin','isCFP','isReferent'])
            <li>
                <a href="{{route('collaboration')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-account'></i>
                    <span class="links_name">Coop??ration</span>
                </a>

            </li>
            @endcanany --}}
            @canany(['isCFP','isReferent'])
            {{-- <li>
                <a href="{{route('liste_facture')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Factures</span>
                </a>

            </li> --}}
            {{-- integrer dans la page
            <li>
                <a href="{{route('liste_facture')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Total facture</span>
                </a>
            </li> --}}

            @endcanany
            {{-- competence --}}
            @canany(['isSuperAdmin','isReferent','isManager'])
            @canany(['isReferent'])
            <li>
                <a href="{{route('demande_test_niveau')}}" class="d-flex nav_linke">
                    <i class='bx bx-network-chart'></i>
                    <span class="links_name">Aptitudes</span>
                </a>
            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('liste_facture')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Total facture</span>
                </a>
            </li> --}}
            @endcanany
            <li>
                <a href="{{route('liste_projet')}}" class="d-flex nav_linke">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="links_name">Comp??tence</span>
                </a>
            </li>
            @endcanany

            {{-- plan de formation --}}
            @canany(['isSuperAdmin','isStagiaire','isManager','isReferent'])
            <li>
                <a @canany(['isStagiaire']) href="{{route('planFormation.index')}}" @endcanany
                    href="{{route('liste_demande_stagiaire')}}" class="d-flex nav_linke">
                    <i class='bx bx-scatter-chart'></i>
                    <span class="links_name">Plan</span>
                </a>
            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('listePlanFormation')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Liste Plan</span>
                </a>
            </li> --}}
            @endcanany
            {{-- abonemment --}}
            @canany(['isSuperAdmin','isAdmin'])
            <li>
                <a href="{{route('listeAbonne')}}" class="d-flex nav_linke">
                    <i class='bx bxl-sketch'></i>
                    <span class="links_name">Abonn??es</span>
                </a>

            </li>

            {{-- integrer dans la page
            <li>
                <a href="{{route('abonnement.index')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Abonnement</span>
                </a>
            </li> --}}
            @endcanany
            @can('isSuperAdmin')
            <li>
                <a href="{{route('categorie')}}" class="d-flex nav_linke">
                    <i class='bx bx-book'></i>
                    <span class="links_name">Cat??gories</span>
                </a>
            </li>
            {{-- <li>
                <a href="{{route('module')}}" class="d-flex nav_linke">
                    <i class='bx bx-book'></i>
                    <span class="links_name">Modules</span>
                </a>
            </li> --}}
            @endcan
            @canany(['isReferent','isCFP'])
            <li>
                <a href="{{route('ListeAbonnement')}}" class="d-flex nav_linke">
                    <i class='bx bxl-sketch'></i>
                    <span class="links_name">Abonnement</span>
                </a>
            </li>

            @endcan
            @can('isFormateur')
            <li>
                <a href="{{route('profilProf',Auth::user()->id)}}" class="d-flex nav_linke">
                    <i class='bx bxs-notepad'></i>
                    <span class="links_name">Mon CV</span>
                </a>
            </li>

            @endcan

            {{-- <li>
                <i class='bx bxs-notepad'></i>
                <span class="links_name">Reporting</span>
                </a>
            </li> --}}
            @can('isCFP')
            {{-- <li>
                <a href="{{route('gestion_documentaire')}}" class="d-flex nav_linke">
                    <i class='bx bx-book-add'></i>
                    <span class="links_name">Librairies</span>
                </a>
            </li> --}}
            {{-- <li>
                <a href="{{route('gestion_documentaire')}}" class="d-flex nav_linke">
                    <i class='bx bx-book-add'></i>
                    <span class="links_name">Librairies</span>
                </a>
            </li> --}}
            @endcan
        </ul>
        {{-- <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <div class='photo_users'> </div>
                    <div class="name_job">
                        <div class="name">D??connexion</div>
                    </div>
                </div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="bx bx-log-out" id="log_out"></i></a>
            </div>
        </div> --}}

    </div>

    <div class="home_content">
        <div class="container-fluid p-0 height-100 bg-light" id="content">
            <header class="header row align-items-center g-0" id="header">
                {{-- <div class="col-1 menu_hamburger">
                    <i class="bx bx-menu" id="btn_menu" role="button" onclick="clickSidebar();"></i>
                </div> --}}
                <div class="col-3 d-flex flex-row padding_logo">
                    <span><img src="{{asset('img/logo_formation/logo_fmg7635dc.png')}}" alt="" class="img-fluid menu_logo me-3"></span>@yield('title')
                </div>
                <div class="col-5 align-items-center justify-content-start d-flex flex-row">

                    @canany('isReferent','isStagiaire','isManager')
                    <div class="row">
                        <form method="GET" action="{{route('result_formation')}}">
                            @csrf
                            <div class="form-row">
                                <div class="searchBoxMod d-flex flex-row mt-4">
                                    {{-- <input class="searchInputMod recherche_formation" type="text"
                                        name="nom_formation" placeholder="Rechercher par formations...">
                                    <button class="searchButtonMod recherche_formation" href="#">
                                        <i class="bx bx-search"></i>
                                    </button> --}}
                                    <a href="{{route('liste_formation')}}" class="btn_racourcis me-4" role="button"
                                        onclick="afficher_catalogue()"><span class="d-flex flex-column"><i class='bx bxs-category-alt'></i><span class="text_racourcis">Catalogue</span></span></a>
                                    <a href="{{route('annuaire')}}" class="btn_racourcis me-4" role="button"
                                        onclick="afficher_annuaire()"><span class="d-flex flex-column"><i class='bx bx-analyse'></i><span class="text_racourcis">Annuaire</span></span></a>
                                    @canany(['isReferent','isStagiaire','isManager'])
                                        <a href="{{route('calendrier_formation')}}" class="btn_racourcis me-4" role="button"><span class="d-flex flex-column"><i class='bx bxs-calendar-edit'></i><span class="text_racourcis">Agenda</span></span></a>
                                    @endcan
                                    @canany(['isCFP','isFormateur'])
                                    <a href="{{route('calendrier')}}" class="btn_racourcis me-4" role="button"><span class="d-flex flex-column"><i class='bx bxs-calendar-edit'></i><span class="text_racourcis">Agenda</span></span></a>
                                    @endcanany

                                </div>
                            </div>
                        </form>
                    </div>
                    @endcanany
                    @canany('isCFP')
                    {{-- <div class="d-flex flex-row">
                        <a href="{{route('liste_module')}}" class="btn_racourcis me-4" role="button"><span
                                class="d-flex flex-column"><i class='bx bxs-customize'></i><span
                                    class="text_racourcis">Modules</span></span></a>
                        <a href="{{route('liste_projet')}}" class="btn_racourcis me-4" role="button"><span
                                class="d-flex flex-column"><i class='bx bx-library'></i><span
                                    class="text_racourcis">Projets</span></span></a>
                        <a href="{{route('calendrier')}}" class="btn_racourcis me-4" role="button"><span
                                class="d-flex flex-column"><i class='bx bxs-calendar-week'></i><span
                                    class="text_racourcis">Agenda</span></span></a>
                    </div> --}}
                    @endcanany
                    @canany('isStagiaire')
                    <div class="d-flex flex-row">
                        <a href="{{route('liste_projet')}}" class="btn_racourcis me-4" role="button"><span
                                class="d-flex flex-column"><i class='bx bx-library'></i><span
                                    class="text_racourcis">Projets</span></span></a>
                        <a href="{{route('calendrier_formation')}}" class="btn_racourcis me-4" role="button"><span
                                class="d-flex flex-column"><i class='bx bxs-calendar-week'></i><span
                                    class="text_racourcis">Agenda</span></span></a>
                    </div>
                    @endcanany
                    @canany('isFormateur')
                    <div class="d-flex flex-row">
                        <a href="{{route('liste_projet')}}" class="btn_racourcis me-4" role="button"><span
                                class="d-flex flex-column"><i class='bx bx-library'></i><span
                                    class="text_racourcis">Projets</span></span></a>
                        <a href="{{route('calendrier')}}" class="btn_racourcis me-4" role="button"><span
                                class="d-flex flex-column"><i class='bx bxs-calendar-week'></i><span
                                    class="text_racourcis">Agenda</span></span></a>
                    </div>
                    @endcanany
                </div>

                <div class="col-4 header-right align-items-center d-flex flex-row">
                    <div class="col-10 d-flex flex-row justify-content-center apprendCreer">
                        <div class="btn_creer me-3">
                            <span class="text_apprendre" role="button" onclick="afficherTuto();">Apprendre</span>
                        </div>
                        <div class="">
                            @can('isManager')
                            <div class="btn_creer dropdown">

                                {{-- <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none" aria-haspopup="true">
                                    <i class='bx bx-plus-medical icon_creer'></i>Cr??er
                                </a> --}}

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                    <li><a class="dropdown-item" href="{{route('planFormation.index')}}"> <i
                                                class='bx bxs-doughnut-chart icon_plus'></i>&nbsp;Nouvelle demande
                                            stagiaire</a></li>
                                    <li><a class="dropdown-item" href="{{route('ajout_plan')}}"> <i
                                                class='bx bx-scatter-chart icon_plus'></i>&nbsp;Nouvelle plan de
                                            formation</a></li>
                                    <li><a class="dropdown-item" href="{{route('budget')}}"><i
                                                class="fas fa-money-check icon_plus"></i>&nbsp;Budgetisation</a></li>

                                </ul>
                            </div>
                            @endcan
                            @can('isReferent')
                            {{-- <div class="btn_creer dropdown">

                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true" style="text-decoration: none">
                                    <i class='bx bx-plus-medical icon_creer'></i>Cr??er

                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="{{route('departement.create')}}"><i
                                                class="fas fa-user icon_plus  "></i>&nbsp; Nouveau Employ??s</a></li>
                                    <li><a class="dropdown-item" href="{{route('nouveau+appel+offre')}}"> <i
                                                class="fas fa-envelope-open-text icon_plus"></i>&nbsp; Appel d'offre</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{route('planFormation.index')}}"> <i
                                                class='bx bxs-doughnut-chart icon_plus'></i>&nbsp;Nouvelle demande
                                            stagiaire</a></li>
                                    <li><a class="dropdown-item" href="{{route('ajout_plan')}}"> <i
                                                class='bx bx-scatter-chart icon_plus'></i>&nbsp;Nouvelle plan de
                                            formation</a></li>
                                    <li><a class="dropdown-item" href="{{route('budget')}}"><i
                                                class="fas fa-money-check icon_plus"></i>&nbsp;Budgetisation</a></li>
                                    <li>
                                        <a class="dropdown-item" href="{{route('formations')}}">
                                            <i class="bx bx-customize icon_plus"></i>&nbsp; Nouveau Module Interne
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{route('formateurs')}}">
                                            <i class="bx bxs-user-rectangle icon_plus "></i>&nbsp; Nouveau Formateur Interne
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{route('projets')}}">
                                            <i class="bx bx-library icon_plus"></i>&nbsp; Projet Interne
                                        </a>
                                    </li>

                                </ul>
                            </div> --}}
                            @endcan
                            @can('isCFP')
                            {{-- <div class="btn_creer dropdown">

                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true" style="text-decoration: none">
                                    <i class='bx bx-plus-medical icon_creer'></i>Cr??er

                                </a>
                                <ul class="dropdown-menu" aria-labelledby="ya">
                                    <li>
                                        <a class="dropdown-item" href="{{route('nouveau_module')}}">
                                            <i class="bx bx-customize icon_plus"></i>&nbsp; Nouveau Module
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{route('nouveau_formateur')}}">
                                            <i class="bx bxs-user-rectangle icon_plus "></i>&nbsp; Nouveau Formateur
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{route('nouveau_groupe',['type_formation'=>1])}}">
                                            <i class="bx bx-library icon_plus"></i>&nbsp; Projet Intra
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{route('nouveau_groupe_inter',['type_formation'=>2])}}">
                                            <i class='bx bx-library icon_plus'></i>&nbsp;Projet Inter
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{route('facture')}}">
                                            <i class='bx bxs-bank icon_plus'></i>&nbsp;Nouveau Facture
                                        </a>
                                    </li>
                                </ul>
                            </div> --}}
                            @endcan

                        </div>
                    </div>
                    <div class="col-2">
                        <div class="header_img">
                            <p class="m-0 mt-3">
                            <i class='bx bxs-user-circle user_icon'></i>
                            </p>
                        </div>
                        <div class="pdp_profil" id="box_profil">
                            <div class="container pdp_profil_card ">
                                <div class="card">
                                    <div class="card-title">
                                        <div class="row">
                                            <div class="col-12 pt-3">
                                                <span>
                                                    <div style="display: grid; place-content: center">
                                                        <div class='randomColor photo_users'
                                                            style="color:white; font-size: 20px; border: none; border-radius: 100%; height:65px; width:65px ; display: grid; place-content: center">
                                                        </div>
                                                    </div>
                                                </span>
                                                <p id="nom_etp"></p>
                                                <h6 class="mb-0 text-center">{{Auth::user()->name}}</h6>
                                                <h6 class="mb-0 text-center text-muted">{{Auth::user()->email}}</h6>
                                                <div class="text-center">
                                                    @can('isManagerPrincipale')
                                                    <a href="{{route('affProfilChefDepartement')}}"><button
                                                            class="btn profil_btn mt-4 mb-2">G??rer votre
                                                            compte</button></a><br>
                                                    @endcan
                                                    @can('isFormateurPrincipale')
                                                    <a href="{{route('profile_formateur')}}"><button
                                                            class="btn profil_btn mt-4 mb-2">G??rer votre
                                                            compte</button></a><br>
                                                    @endcan
                                                    @can('isStagiairePrincipale')
                                                    <a href="{{route('profile_stagiaire')}}"><button
                                                            class="btn profil_btn mt-4 mb-2">G??rer votre
                                                            compte</button></a><br>
                                                    @endcan
                                                    @can('isReferentPrincipale')
                                                    <a href="{{route('profil_referent')}}"><button
                                                            class="btn profil_btn mt-4 mb-2">G??rer votre
                                                            compte</button></a><br>
                                                    @endcan
                                                    @can('isCFPPrincipale')
                                                    <a href="{{route('profil_du_responsable')}}"><button
                                                            class="btn profil_btn mt-4 mb-2">G??rer votre
                                                            compte</button></a><br>
                                                    @endcan
                                                </div>
                                                <hr>
                                                <div class="text-center">
                                                    <input type="text" value="{{Auth::user()->id}}" id="id_user" hidden>
                                                    <p id="liste_role" class="text-muted">Conn??ct?? en tant que : </p>
                                                </div>
                                                <hr>
                                                <div class="text-center">
                                                    <div>
                                                        <p><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                            </a></p>
                                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();"
                                                            class="deconnexion_text btn text-center">Se D??connecter</a>
                                                        <form action="{{ route('logout') }}" id="logout-form"
                                                            method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </div>
                                                <hr>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-body py-0">
                                        <div class="d-flex flex-row py-0 card_body_text">
                                            <a href="{{url('politique_confidentialite')}}" target="_blank">
                                                <p class="m-0">Politique de confidentialit??</p>
                                            </a>
                                            &nbsp;-&nbsp;
                                            <a href="{{route('condition_generale_de_vente')}}" target="_blank">
                                                <p class="m-0">Conditions d'utilisation</p>
                                            </a>
                                        </div>
                                        <div class="d-flex flex-row py-0 card_body_text">
                                            <a href="{{url('contacts')}}" target="_blank">
                                                <p class="m-0">Contactez-nous</p>
                                            </a>
                                            &nbsp;-&nbsp;
                                            <a href="#" target="_blank">
                                                <p class="m-0">Informations l??gales</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </header>
            {{-- header --}}
            {{-- content --}}
            <div class="container-fluid content_body px-0" style="padding-bottom: 1rem; padding-top: 4.5rem;">
                @yield('content')

            </div>
            {{-- content --}}
            {{-- footer --}}
            {{-- <div class="footer mt-5">
                <div class="container-fluid footer_all">
                    <div class="row w-100">
                        <div class="col-12">
                            <div class="container">
                                <div class="d-flex w-auto footer_one justify-content-center">
                                    <div class="footer_list me-2">
                                        <a href="#" class="mx-auto">
                                            <p>&copy;&nbsp;Copyright 2022 : Formation.mg</p>
                                        </a>
                                    </div>
                                    <div class="footer_list ms-2 me-2">
                                        <a href="#">
                                            <p>Informations l??gales</p>
                                        </a>
                                    </div>
                                    <div class="footer_list ms-2 me-2">
                                        <a href="{{url('contacts')}}" style="color: #801D62;text-decoration:none">
                                            <p>Contactez-nous</p>
                                        </a>
                                    </div>
                                    <div class="footer_list ms-2 me-2">
                                        <a href="{{url('politique_confidentialite')}}" target="_blank">
                                            <p>Politique de confidentialit??</p>
                                        </a>
                                    </div>
                                    <div class="footer_list ms-2 me-2">
                                        <a href="{{route('condition_generale_de_vente')}}"
                                            style="color:#801D68 !important" target="_blank">
                                            <p>Conditions d'utilisation</p>
                                        </a>
                                    </div>
                                    <div class="footer_list ms-2 me-2">
                                        <a href="#">
                                            <p>Tarifs</p>
                                        </a>
                                    </div>
                                    <div class="footer_list ms-2 me-2">
                                        <a href="#">
                                            <p>Cr??dits</p>
                                        </a>
                                    </div>
                                    <div class="footer_list_end ms-2 me-2 text-muted">
                                        <p>1.01</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="apprendre mt-3">
                <div class="row">
                    <div class="col">
                        <p class="m-0">Apprendre</p>
                    </div>
                    <div class="col text-end">
                        <i class="bx bx-x " role="button" onclick="afficherTuto();"></i>
                    </div>
                    <hr class="mt-2">
                    apprendre
                </div>
        </div>

    </div>
        {{-- footer --}}
    </div>

    <script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.2/umd/popper.min.js"
        integrity="sha512-aDciVjp+txtxTJWsp8aRwttA0vR2sJMk/73ZT7ExuEHv7I5E6iyyobpFOlEFkq59mWW8ToYGuVZFnwhwIUisKA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>
{{--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"
        integrity="sha512-a6ctI6w1kg3J4dSjknHj3aWLEbjitAXAjLDRUxo2wyYmDFRcz2RJuQr5M3Kt8O/TtUSp8n2rAyaXYy1sjoKmrQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{asset('js/admin.js')}}"></script>
    <script type="text/javascript">
        //Pour chaque div de classe randomColor
        $(".randomColor").each(function() {
        //On change la couleur de fond au hasard
        $(this).css("background-color", '#'+(Math.random()*0xFFFFFF<<0).toString(16).slice(-6));
        })

        $(document).ready(function() {
            var pdp = "";
            $.ajax({
                url: '{{ route("profile_resp") }}'
                , type: 'get'
                , success: function(response) {
                    var userData = response;

                    if(userData['photo'] == 'oui'){
                        var html = '<img src="{{asset(":?")}}" class="img-fluid" alt="user_profile" style="width : 65px; height : 65px;border-radius : 100%; margin-top:6px; cursor: pointer; position:relative; bottom:3px;">';
                        html = html.replace(":?", userData['user']);
                        // alert(JSON.stringify(userData));
                        $('.photo_users').append(html);
                    }
                    if(userData['photo'] == 'non'){
                        var html = userData['user'][0]['nm']+''+userData['user'][0]['pr'];
                        $('.photo_users').append(html);
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        });

        $(document).ready(function() {
            var pdp = "";
            $.ajax({
                url: '{{ route("logos") }}'
                , type: 'get'
                , success: function(response) {
                    var userData = response;
                    var html = '<img src="{{asset("images/:?")}}" class="img-fluid" alt="logo" style="height : 45px; margin-top:4px; cursor: pointer;">';
                    html = html.replace(":?", userData);

                    $('.logo_etp_user').append(html);
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        });


    </script>
</body>

</html>