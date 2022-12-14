@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Profil participant</h3>
@endsection
@section('content')
    <style>
        .image-ronde {
            width: 30px;
            height: 30px;
            border: none;
            -moz-border-radius: 75px;
            -webkit-border-radius: 75px;
            border-radius: 75px;
        }

        /* .hover:hover {
            background-color: rgb(233, 220, 220);
            cursor: pointer;
        } */

    </style>
    <div class="row">
        {{-- <div class="col-lg-4 col-md-6">
                <div class="formation-service"> --}}

        {{-- @foreach ($stagiaires as $stagiaire)

                                    <center> --}}


        {{-- <div class="m-b-25"> <img src="{{asset('images/stagiaires/'.$stagiaire->photos)}}"  class="image-ronde">
                                    </div>
                                    @can('isStagiaire')
                                    <a href="{{route('edit_participant',$stagiaire->id)}} " ><i class=" fa fa-edit"></i> &nbsp;Modifier mon profil</a>
                                @endcan
                                    </center>
                                   <div class="row">

                                       <div class="col-lg-8">
                                        <h6 class="p-2  ">{{$stagiaire->titre}} {{$stagiaire->nom_stagiaire}} {{$stagiaire->prenom_stagiaire}}</h6>
                                        <p class="m-b-10  "><i class="bx bx-calendar-alt"></i>&nbsp;<span style="color:gray">Date de naissance</span>&nbsp;{{$stagiaire->date_naissance}}</p>

                                       </div>
                                       <div class="col-lg-4">
                                        <h6 class="p-2 f-w-900 ">{{$stagiaire->fonction_stagiaire}}</h6>
                                        <p class="m-b-10  "><i class="bx bx-id-card"></i>&nbsp;<span style="color:gray">CIN</span>{{$stagiaire->cin}}</p>

                                       </div>
                                   </div>
                                    <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>

                                </div>
                            </div>


                    <div class="col-lg-4 col-md-6">
                        <div class="formation-service">
                            <h6 class="m-b-20  ">Informations personnelles</h6>


                            <p class="m-b-10 "><i class="bx bx-building-house"></i>&nbsp;<span style="color:gray">Adresse</span></p>
                            <h6 class="text-muted f-w-400">{{$stagiaire->lot}} &nbsp;{{$stagiaire->quartier}} &nbsp;{{$stagiaire->ville}} &nbsp;{{$stagiaire->code_postal}}&nbsp;{{$stagiaire->region}}</h6>
                            <p class="m-b-10  "><i class="bx bx-phone"></i>&nbsp;<strong style="color:gray">T??l??phone</strong></p>
                            <h6 class="text-muted f-w-400 text-white">{{$stagiaire->telephone_stagiaire}}</h6>
                                <p class="m-b-10 "><i class="bx bx-envelope"></i>&nbsp;<strong style="color:gray">E-mail</strong></p>
                                <h6 class="text-muted f-w-400 text-white">{{$stagiaire->mail_stagiaire}}</h6>
                            </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="formation-service">
                            <h6 class="m-b-20  ">Informations professionnelles</h6>

                            <p class="m-b-10 "><i  class="fa fa-id-card-o"></i>&nbsp;<strong style="color:gray">Matricule</strong></p>
                                <h6 class="text-muted f-w-400">{{$stagiaire->matricule}}</h6>
                                <p class="m-b-10 "><i class="bx bx-building-house"></i>&nbsp;<strong style="color:gray">Entreprise</strong></p>
                                <h6 class="text-muted f-w-400">{{optional(optional($stagiaire)->entreprise)->nom_etp}}</h6>
                                  <p class="m-b-10 "><i  class="bx bxs-graduation"></i>&nbsp;<strong style="color:gray">Niveau d'??tude</strong></p>
                                <h6 class="text-muted f-w-400">{{$stagiaire->niveau_etude}}</h6>
                                <p class="m-b-10 "><i class="bx bx-home"></i>&nbsp;<strong style="color:gray">D??partement</strong></p>
                                <h6 class="text-muted f-w-400">{{optional(optional($stagiaire)->departement)->nom_departement}}</h6>
                                <p class="m-b-10 "><i  class="bx bx bx-home"></i>&nbsp;<strong style="color:gray">Branche</strong></p>
                                <h6 class="text-muted f-w-400">{{$stagiaire->lieu_travail}}</h6>
                         </div>
                        </div>

                    <ul class="social-link list-unstyled m-t-40 m-b-10">
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                    </ul>

                                </div>
                            </div>
                            @endforeach

                        </div> --}}
        <div class="row mt-2">

            <div class="col-lg-4">

                <div class="form-control">
                    <p class="text-center">Informations g??n??rales</p>

                    <div class="d-flex align-items-center justify-content-between hover"
                        style="border-bottom: solid 1px  #e8dfe5;">
                        <p class="p-1 m-0" style="font-size: 12px">PHOTO

                        </p>
                        <a href="{{ route('edit_photos', $stagiaire->id) }} ">
                            @if($stagiaire->photos==null)
                            <span>
                                <div style="display: grid; place-content: center">
                                    <div class='randomColor photo_users' style="color:white; font-size: 12px border: none; border-radius: 100%; height:30px; width:30px ; display: grid; place-content: center">
                                    </div>
                                </div>
                            </span>
                            @else
                                <img src="{{asset('images/stagiaires/'.$stagiaire->photos)}}" class="image-ronde">
                            @endif
                        </a>
                    </div>
                    <div class="hover" style="border-bottom: solid 1px  #e8dfe5;">
                        <a href="{{ route('edit_nom', $stagiaire->id) }} ">
                            <p class="p-1 m-0" style="font-size: 12px">NOM<span
                                    style="float: right;">{{ $stagiaire->nom_stagiaire }}
                                    {{ $stagiaire->prenom_stagiaire }}&nbsp;<i class="fas fa-angle-right"></i></span>

                            </p>
                        </a>

                    </div>
                    <div class="hover" style="border-bottom: solid 1px  #e8dfe5;">
                        <a href="{{ route('edit_naissance', $stagiaire->id) }} ">
                            <p class="p-1 m-0" style="font-size: 12px">ANNIVERSAIRE<span
                                    style="float: right;">{{ date('j \\ F Y', strtotime($stagiaire->date_naissance)) }}&nbsp;<i
                                        class="fas fa-angle-right"></i></span>

                            </p>
                        </a>

                    </div>
                    <div class="hover" style="border-bottom: solid 1px  #e8dfe5;">
                        <a href="{{ route('edit_genre', $stagiaire->id) }} ">
                            <p class="p-1 m-0" style="font-size: 12px">GENRE<span
                                    style="float: right;">{{ $genre }}&nbsp;<i
                                        class="fas fa-angle-right"></i></span>
                            </p>
                        </a>
                    </div>
                    <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
                </div>
            </div>


            <div class="col-lg-4">

                <div class="form-control">
                    <p class="text-center">Coordonn??es</p>

                    <div style="border-bottom: solid 1px  #e8dfe5;" class="hover">
                        <a href="{{ route('edit_mail', $stagiaire->id) }} ">
                            <p class="p-1 m-0" style="font-size: 12px">ADRESSE E-MAIL<span
                                    style="float: right;">{{ $stagiaire->mail_stagiaire }}&nbsp;<i
                                        class="fas fa-angle-right"></i></span>

                            </p>
                        </a>
                    </div>
                    <div style="border-bottom: solid 1px  #e8dfe5;" class="hover">
                        <a href="{{ route('edit_phone', $stagiaire->id) }} ">
                            <p class="p-1 m-0" style="font-size: 12px">TELEPHONE<span
                                    style="float: right;">{{ $stagiaire->telephone_stagiaire }}&nbsp;<i
                                        class="fas fa-angle-right"></i> </span>

                            </p>
                        </a>
                    </div>

                    <div style="border-bottom: solid 1px  #e8dfe5;" class="hover">
                        <a href="{{ route('edit_cin', $stagiaire->id) }} ">
                            <p class="p-1 m-0" style="font-size: 12px">CIN<span
                                    style="float: right;">{{ $stagiaire->cin }}&nbsp;<i
                                        class="fas fa-angle-right"></i></span>
                            </p>
                        </a>
                    </div>
                    <div style="border-bottom: solid 1px  #e8dfe5;" class="hover">
                        {{-- <a href="{{route('edit_adresse',$stagiaire->id)}} " >
                                        <p class="p-1 m-0" style="font-size: 12px">ADRESSE<span style="float: right;">{{$stagiaire->lot}} &nbsp;{{$stagiaire->quartier}} &nbsp;{{$stagiaire->ville}} &nbsp;{{$stagiaire->code_postal}}&nbsp;{{$stagiaire->region}}&nbsp;<i class="fas fa-angle-right"></i></span>

                                        </p>
                                     </a> --}}
                    </div>
                    <div style="border-bottom: solid 1px  #e8dfe5;" class="hover">
                        <a href="{{ route('edit_fonction', $stagiaire->id) }} ">
                            <p class="p-1 m-0" style="font-size: 12px">FONCTION<span
                                    style="float: right;">{{ $stagiaire->fonction_stagiaire }}&nbsp;<i
                                        class="fas fa-angle-right"></i></span>
                            </p>
                        </a>
                    </div>
                    <div style="border-bottom: solid 1px  #e8dfe5;" class="hover">
                        <a href="{{ route('edit_niveau', $stagiaire->id) }} ">
                            <p class="p-1 m-0" style="font-size: 12px">NIVEAU D'ETUDE<span
                                    style="float: right;">{{ $stagiaire->niveau_etude }}&nbsp;<i
                                        class="fas fa-angle-right"></i></span>
                            </p>
                        </a>
                    </div>

                    <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
                </div>
            </div>
            <div class="col-lg-4">

                <div class="form-control">
                    <p class="text-center">Informations professionnelles</p>

                    <div style="border-bottom: solid 1px  #e8dfe5;" class="hover">
                        @can('isStagiaire')
                                <p class="p-1 m-0" style="font-size: 12px">MATRICULE<span
                                        style="float: right;">{{ $stagiaire->matricule }}&nbsp;<i
                                            class="fas fa-angle-right"></i></span>

                                </p>
                        @endcan
                        @can('isReferent')
                            <a href="{{ route('edit_matricule', $stagiaire->id) }} ">
                                <p class="p-1 m-0" style="font-size: 12px">MATRICULE<span
                                        style="float: right;">{{ $stagiaire->matricule }}&nbsp;<i
                                            class="fas fa-angle-right"></i></span>

                                </p>
                            </a>
                        @endcan
                    </div>

                    <div style="border-bottom: solid 1px  #e8dfe5;" class="hover">
                        {{-- <a href="{{route('edit_entreprise',$stagiaire->id)}} " > --}}
                        <p class="p-1 m-0" style="font-size: 12px">ENTREPRISE<span
                                style="float: right;">{{ $entreprise->nom_etp }} &nbsp;<i
                                    class="fas fa-angle-right"></i></span>

                        </p>
                        {{-- </a> --}}

                    </div>

                    <div style="border-bottom: solid 1px  #e8dfe5;" class="hover">

                        <p class="p-1 m-0" style="font-size: 12px">DEPARTEMENT<span style="float: right;">
                                @if ($departement == null)
                                    <strong style="color: red">incompl??te</strong>&nbsp;
                                @else
                                    {{ $departement->nom_departement }}&nbsp;
                                @endif
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </p>
                        </a>
                    </div>
                    <div style="border-bottom: solid 1px  #e8dfe5;" class="hover">
                        @can('isStagiaire')
                            <p class="p-1 m-0" style="font-size: 12px">SERVICE<span style="float: right;">
                                @if ($service == null)
                                    <strong style="color: red">incompl??te</strong>&nbsp;
                                @else
                                    {{ $service->nom_service }}&nbsp;
                                @endif
                                <i class="fas fa-angle-right"></i>
                                </span>
                            </p>
                        @endcan
                        @canany(['isReferent'])
                            <a href="{{ route('edit_departement', $stagiaire->id) }} ">
                                <p class="p-1 m-0" style="font-size: 12px">SERVICE<span style="float: right;">
                                        @if ($service == null)
                                            <strong style="color: red">incompl??te</strong>&nbsp;
                                        @else
                                            {{ $service->nom_service }}&nbsp;
                                        @endif
                                        <i class="fas fa-angle-right"></i>
                                    </span>
                                </p>
                            </a>
                        @endcanany

                    </div>
                    <div style="border-bottom: solid 1px  #e8dfe5;" class="hover">
                        @can('isStagiaire')
                            <p class="p-1 m-0" style="font-size: 12px">BRANCHE<span style="float: right;">
                                    @if ($branche == null)
                                        <strong style="color: red">incompl??te</strong>&nbsp;
                                    @else
                                        {{ $branche->nom_branche }}&nbsp;
                                    @endif
                                    <i class="fas fa-angle-right"></i>
                                </span>
                            </p>
                        @endcan
                        @canany(['isReferent'])
                            <a href="{{ route('edit_branche', $stagiaire->id) }} ">
                                <p class="p-1 m-0" style="font-size: 12px">BRANCHE<span style="float: right;">
                                        @if ($branche == null)
                                            <strong style="color: red">incompl??te</strong>&nbsp;
                                        @else
                                            {{ $branche->nom_branche }}&nbsp;
                                        @endif
                                        <i class="fas fa-angle-right"></i>
                                    </span>
                                </p>
                            </a>
                        @endcanany
                    </div>


                    <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
                </div>
            </div>

        </div>
    @endsection
