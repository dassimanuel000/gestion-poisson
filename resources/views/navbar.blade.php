<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            Poisson | Mr DassI
                            <span class="user-level">Administrator</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item {{  'dashboard' == request()->path() ? 'active open' : '' }} @if(Route::currentRouteName() == 'stat.index') active open @endif">
                    <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="/dashboard">
                                    <span class="sub-item">Les Statistiques</span>
                                </a>
                            </li>
                            <li class="@if(Route::currentRouteName() == 'stat.index') active open @endif">
                                <a href="/stat">
                                    <span class="sub-item">Le Bilan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item 
                {{  'add_eleve' == request()->path() ? 'active open' : '' }}
                @if(Route::currentRouteName() == 'list_eleve') active open @endif 
                @if(Route::currentRouteName() == 'specific_classe') active open @endif
                @if(Route::currentRouteName() == 'edit_eleve') active open @endif
                ">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Eleves</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li class="{{  'add_eleve' == request()->path() ? 'active open' : '' }}">
                                <a href="/add_eleve">
                                    <span class="sub-item">Ajouter un eleve</span>
                                </a>
                            </li>
                            <li class="@if(Route::currentRouteName() == 'list_eleve') active open @endif @if(Route::currentRouteName() == 'edit_eleve') active open @endif @if(Route::currentRouteName() == 'specific_classe') active open @endif">
                                <a href="/list_eleve">
                                    <span class="sub-item">Listes des Eleves</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{  'add_enseignant' == request()->path() ? 'active open' : '' }} {{  'list_enseignant' == request()->path() ? 'active open' : '' }} {{  'voir_enseignant/2' == request()->path() ? 'active open' : '' }}">
                    <a data-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-th-list"></i>
                        <p>Enseignants</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li class="{{  'list_enseignant' == request()->path() ? 'active open' : '' }}">
                                <a href="/list_enseignant">
                                    <span class="sub-item">Listes Des Enseignant</span>
                                </a>
                            </li>
                            <li class="{{  'add_enseignant' == request()->path() ? 'active open' : '' }}">
                                <a href="/add_enseignant">
                                    <span class="sub-item">Ajouter un Enseignants</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item 
                {{  'scolarite' == request()->path() ? 'active open' : '' }}
                @if(Route::currentRouteName() == 'admin.add_scolarite') active open @endif 
                @if(Route::currentRouteName() == 'admin.list_scolarite') active open @endif 
                ">
                    <a data-toggle="collapse" href="#scolarite">
                        <i class="fa fa-plane"></i>
                        <p>Scolarite</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="scolarite">
                        <ul class="nav nav-collapse">
                            <li class="@if(Route::currentRouteName() == 'admin.add_scolarite') active open @endif ">
                                <a href="@if(Route::currentRouteName() == 'admin.add_scolarite') /add_scolarite @endif ">
                                    <span class="sub-item">Ajouter un versememt</span>
                                </a>
                            </li>
                            <li class="@if(Route::currentRouteName() == 'admin.list_scolarite') active open @endif @if(Route::currentRouteName() == 'edit_eleve') active open @endif @if(Route::currentRouteName() == 'specific_classe') active open @endif">
                                <a href="/list_scolarite">
                                    <span class="sub-item">Listes des Versements</span>
                                </a>
                            </li>
                            <li class="@if(Route::currentRouteName() == 'admin.red_list') active open @endif">
                                <a href="/red_list">
                                    <span class="sub-item">Listes des Eleves Insolvables</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item
                @if(Route::currentRouteName() == 'admin.list_creche') active open @endif
                @if(Route::currentRouteName() == 'admin.add_creche') active open @endif
                @if(Route::currentRouteName() == 'admin.edit_creche') active open @endif
                @if(Route::currentRouteName() == 'admin.edit_creche_id') active open @endif">
                    <a data-toggle="collapse" href="#forms">
                        <i class="fas fa-pen-square"></i>
                        <p>Creche</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            <li class="@if(Route::currentRouteName() == 'admin.list_creche') active open @endif">
                                <a href="/list_creche">
                                    <span class="sub-item">Listes Des Enfants &agrave; la Creche</span>
                                </a>
                            </li>
                            <li class="@if(Route::currentRouteName() == 'admin.add_creche') active open @endif">
                                <a href="/add_creche">
                                    <span class="sub-item">Ajouter un Enfant &agrave; la Creche</span>
                                </a>
                            </li>
                            <li class="@if(Route::currentRouteName() == 'admin.edit_creche') active open @endif">
                                <a href="/edit_creche">
                                    <span class="sub-item">Modifier les donnees d'un Enfant &agrave; la Creche</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{  'add_classe' == request()->path() ? 'active open' : '' }} {{  'all_classe' == request()->path() ? 'active open' : '' }}  @if(Route::currentRouteName() == 'edit_classe.index') active open @endif">
                    <a data-toggle="collapse" href="#Classes">
                        <i class="fas fa-desktop"></i>
                        <p>Les Classes</p>
                        
                        @php
                            $nombr_classe = DB::select('select * from classe ');
                            $count_classe = count($nombr_classe);
                        @endphp
                    <span class="badge badge-success">{{ $count_classe }}</span>
                    </a>
                    <div class="collapse" id="Classes">
                        <ul class="nav nav-collapse">
                            <li class="{{  'all_classe' == request()->path() ? 'active open' : '' }} @if(Route::currentRouteName() == 'edit_classe.index') active open @endif">
                                <a href="/all_classe">
                                    <span class="sub-item">Les classes</span>
                                </a>
                            </li>
                            <li class="{{  'add_classe' == request()->path() ? 'active open' : '' }}">
                                <a href="/add_classe">
                                    <span class="sub-item">Ajouter une classe</span>
                                </a>
                            </li>
                            @foreach ($nombr_classe as $item)
                                <li>
                                    <a href="/list_classe/{{ $item->id }}">
                                        <span class="sub-item">{{ $item->initial_classe }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'admin.add_bus') active open @endif @if(Route::currentRouteName() == 'admin.list_bus') active open @endif ">
                    <a data-toggle="collapse" href="#tables">
                        <i class="fas fa-table"></i>
                        <p>Transport Bus</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li class="@if(Route::currentRouteName() == 'admin.add_bus') active open @endif ">
                                <a href="/add_bus">
                                    <span class="sub-item">Ajouter un eleve &agrave; transporter</span>
                                </a>
                            </li>
                            <li class="@if(Route::currentRouteName() == 'admin.list_bus') active open @endif ">
                                <a href="/list_bus">
                                    <span class="sub-item">Listes des eleves Transport&eacute;s</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mx-4 mt-2">
                    <a href="/search_eleve" class="btn btn-primary btn-block"><span class="btn-label mr-2"> <i class="fa fa-check"></i> </span>Rechercher un eleve</a> 
                </li>
            </ul>
        </div>
    </div>
</div>