<!-- DATATABLES CSS -->
<link rel="stylesheet" media="screen" href="lib/datatables/css/vpad.css" />
<script type="text/javascript" src="lib/datatables/js/jquery.dataTables.js"></script> 
<script type="text/javascript" src="lib/datatables/js/jquery.dataTables.rowGrouping.js"></script>


<!--<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/jquery.dataTables.js"></script>
<script type="text/javascript" src="//jquery-datatables-row-grouping.googlecode.com/svn/trunk/media/js/jquery.dataTables.rowGrouping.js"></script> 
-->


<script type="text/javascript" charset="utf-8">
   $('#example').dataTable({
        "bLengthChange": false,
        "bPaginate": false,
        "bJQueryUI": true,
        "oLanguage": {
            "sProcessing":     "Traitement en cours...",
            "sSearch":         "Rechercher&nbsp;:",
            "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
            "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
            "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            "sInfoPostFix":    "",
            "sLoadingRecords": "Chargement en cours...",
            "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
            "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
            "oPaginate": {
                "sFirst":      "Premier",
                "sPrevious":   "Pr&eacute;c&eacute;dent",
                "sNext":       "Suivant",
                "sLast":       "Dernier"
          },
          "oAria": {
            "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
            "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
          }
      }
    }).rowGrouping({
        bExpandableGrouping: true,
//        EXPEND BY DEFAULT
//        bExpandSingleGroup: false,
//        iExpandGroupOffset: -1,
//        asExpandedGroups: [""]
    });
		</script>
                
<style type="text/css">
        .expanded-group{
                background: url("lib/datatables/images/minus.jpg") no-repeat scroll left center transparent;
                padding-left: 15px !important
        }

        .collapsed-group{
                background: url("lib/datatables/images/plus.jpg") no-repeat scroll left center transparent;
                padding-left: 15px !important
        }

</style>
<!-- DATATABLES CSS END -->

                <h1 class="page-title">Exécution de l'Etat</h1>
                <section class="tabs grid_12 leading">
                    <ul class="clearfix">
                        <li><a href="#">Exécuter sur tous les AZ</a></li>
                        <li><a href="#">Exécuter sur une sélection d'AZ</a></li>
                        <li><a href="#">Exécuter sur un GF</a></li>
                    </ul>
                    <section>
                        <section class="clearfix">
                            <header class="grid_12 alpha omega">
                                <h2>Tabbed Content</h2>
                            </header>
                            <div class="grid_4 alpha">
                                <?php
                                    $serverName = "cgsrv043"; 
                                    $database = "gesabeldev";

                                    // Get UID and PWD from application-specific files. 
//                                    $uid = file_get_contents("C:\AppData\uid.txt");
//                                    $pwd = file_get_contents("C:\AppData\pwd.txt");
                                    
                                    $uid = 'GESADB';
                                    $pwd = 'GESA';

                                    try {
                                       $conn = new PDO( "sqlsrv:server=$serverName;Database = $database", $uid, $pwd); 
                                       $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
                                    }

                                    catch( PDOException $e ) {
                                       die( "Error connecting to SQL Server" ); 
                                    }

                                    echo "Connected to SQL Server\n";
                                    
//                                    // Initialisaton de la base
//                                    $query = 'Use gesabeldev';                                    
//                                    $stmt = $conn->query( $query ); 
                                    
                                     // Suppression des tables temporaires
//                                    $query = "if exists (select * from sysobjects where name ='solde_cpt' and xtype = 'U')drop table solde_cpt";                                    
//                                    $stmt = $conn->query( $query ); 
//                                    
//                                     $query = "if exists (select * from sysobjects where name ='liste_abo' and xtype = 'U') drop table liste_abo";                                    
//                                    $stmt = $conn->query( $query ); 
//                                    
//                                     // Determination du solde (débiteur) 
//                                    $query = "select codexp, idabon, 
//                                                     sum(isnull(0*datediff(day,datregl,getdate()),1)*
//                                                            (montfact - isnull(montpaye,0)) + montfraisp + montfraisc + montfraisb + montfraisd) as solde_Total_FactEchue
//                                              into  solde_cpt
//                                              from  cptclient
//                                              where 
//                                                    ((isnull(datregl, '') = '') or 
//                                                     ((topfraisp = '1')  or 
//                                                      (topfraisc = '1')  or 
//                                                      (topfraisb = '1')  or 
//                                                      (topfraisd = '1'))
//                                                    ) and
//                                                    datediff(dd, datlimit,getdate()) > 0 
//                                             group by codexp,idabon
//                                             having sum(isnull(0*datediff(day,datregl,getdate()),1)* (montfact - isnull(montpaye,0)) + montfraisp + montfraisc + montfraisb + montfraisd ) > 0
//                                    
//
//                                            select c.idabon Identifiant, a.refbranch,a.posabon + '-' + left(d.libelemt,15) Position,convert(char(10),datposa,103)datposa,
//                                                   isnull(a.nomabon,'') + ' ' + isnull(a.prenabon,'') Nom_abonne, 
//                                                   COUNT(*) Nbre_Imp_Echu,  
//                                                   sum(isnull(c.montfact,0) - isnull(c.montpaye,0)) Total_Imp_Echu, 
//                                                   sum(c.cons1t+c.cons2t+c.cons3t) Conso_Imp_Echu,solde_Total_FactEchue,
//                                                   CONVERT(varchar(80), '')  as genrabon, 
//                                                   CONVERT(varchar(80), '') as usageabon 
//                                            into   liste_abo
//                                            from   cptclient c,
//                                                   abonne a, solde_cpt s, reference..dictables d
//                                            where
//                                                   c.idabon = a.idabon and
//                                                   c.idabon = s.idabon and
//                                                   a.posabon = d.codelemt and d.numtable = '24' and 
//                                                   (isnull(c.datregl, '') = '') and 
//                                            datediff(dd, datlimit,getdate()) > 0  and a.posabon<>'4'
//                                            group by c.IDABON, a.refbranch,a.POSABON, left(d.libelemt,15), convert(char(10),datposa,103),
//                                                     isnull(a.nomabon,'') + ' ' + isnull(a.prenabon,''),solde_Total_FactEchue";                                    
//                                    $stmt = $conn->query( $query ); 
                                    
                                    // LISTE
                                    $query = "select top 20 f.matragent matr_AZ,f.nomagent nom_AZ,numgf,t.codexp+t.codzone+t.codtourne tournee,h.refbranch,h.Identifiant,Position, h.datposa,h.genrabon, h.usageabon, 
                                                     Nom_abonne, Nbre_Imp_Echu,Total_Imp_Echu, Conso_Imp_Echu, solde_Total_FactEchue
                                             from    liste_abo h,reltournee r,reference..agent f , abonne a, reference..dictables d, tournee t
                                             where   h.identifiant = a.idabon and
                                                     codelemt = a.posabon and numtable = '24' and 
                                                     r.matrrelvr=f.MATRAGENT and
                                                     substring(h.refbranch, 1,3) = r.codexp and
                                                     substring(h.refbranch, 5,2) = r.codzone and
                                                     substring(h.refbranch, 7,3) = r.codtourne 
                                                     and
                                                     substring(h.refbranch, 1,3) = t.codexp and
                                                     substring(h.refbranch, 5,2) = t.codzone and
                                                     substring(h.refbranch, 7,3) = t.codtourne 
                                             order by Identifiant,Position, h.genrabon, h.usageabon ";                                    
                                    $stmt = $conn->query( $query );
                                    
//                                    while ( $row = $stmt->fetch( PDO::FETCH_OBJ ) ){ 
//                                        var_dump( $row ); 
//                                    }
                                   
                                ?>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed turpis diam, facilisis nec egestas quis, pharetra eget diam.
                            </div>
                            <div class="grid_4">
                                Morbi lacus nibh, ornare in euismod id, vulputate at sem. Duis semper rhoncus enim, nec condimentum elit sagittis et.
                            </div>
                            <div class="grid_4 omega">
                                Sed lacus nunc, gravida sed auctor vitae, faucibus ultrices erat. Vestibulum orci dui, eleifend vel sodales eu, bibendum id ipsum.
                            </div>
                        </section>
                        <section class="clearfix">
                            <header class="grid_12 alpha omega">
                                <h2>Tab 2</h2>
                            </header>
                        </section>
                        <section class="clearfix">
                            <header class="grid_12 alpha omega">
                                <h2>Tab 3</h2>
                            </header>
                            <div class="grid_4 alpha">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed turpis diam, facilisis nec egestas quis, pharetra eget diam.
                            </div>
                            <div class="grid_4">
                                Morbi lacus nibh, ornare in euismod id, vulputate at sem. Duis semper rhoncus enim, nec condimentum elit sagittis et.
                            </div>
                            <div class="grid_4 omega">
                                Sed lacus nunc, gravida sed auctor vitae, faucibus ultrices erat. Vestibulum orci dui, eleifend vel sodales eu, bibendum id ipsum.
                            </div>
                        </section>
                    </section>
                </section>

                <div class="clear"></div>
                    
                <div class="container_12 clearfix leading">
                    <div class="grid_12">
                        <div id="demo" class="clearfix"> 
                            <table class="display" id="example"> 
                                <thead> 
                                    <tr> 
                                        <!--<th>Matricule</th>--> 
                                        <th>Nom de l'AZ</th> 
                                        <th>Identifiant</th> 
                                        <!--<th>Référence</th>--> 
                                        <!--<th>Tournée</th>--> 
                                        <th>Nom et prénoms</th>
                                        <th>Position</th>                                        
                                        <th>Nombre d'impayés</th>                                        
                                        <th>Montant des impayés</th>                                        
                                        <!--<th>Solde total facturé</th>-->                                        
                                    </tr> 
                                </thead> 
                                <tbody> 
                                    <?php while ( $row = $stmt->fetch( PDO::FETCH_OBJ) ):{ ?>
                                    <tr class="gradeA"> 
                                        <td><?php echo $row->nom_AZ ?></td>
                                        <td><?php echo $row->Identifiant ?></td>
                                        <td><?php echo $row->Nom_abonne ?></td>
                                        <td><?php echo $row->Position ?></td>
                                        <td><?php echo $row->Nbre_Imp_Echu ?></td>
                                        <td><?php echo $row->Total_Imp_Echu ?></td>
                                    </tr> 
                                  <?php } endwhile;  
                                          // Free statement and connection resources. 
                                          $stmt = null; 
                                          $conn = null; ?>
<!--                                    <tr class="gradeA"> 
                                        <td>Trident</td> 
                                        <td>Internet
                                             Explorer 5.0</td> 
                                        <td>Win 95+</td> 
                                        <td class="center">5</td> 
                                        <td class="center">C</td> 
                                    </tr> -->
                                    
                                    
<!--                                    <tr class="gradeX"> 
                                        <td>Trident</td> 
                                        <td> 
                                            Internet
                                             Explorer 
                                            4.0
                                            </td> 
                                        <td>Win 95+</td> 
                                        <td class="center">4</td> 
                                        <td class="center">X</td> 
                                    </tr> 
                                    <tr class="gradeC"> 
                                        <td>Trident</td> 
                                        <td>Internet
                                             Explorer 5.0</td> 
                                        <td>Win 95+</td> 
                                        <td class="center">5</td> 
                                        <td class="center">C</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Trident</td> 
                                        <td>Internet
                                             Explorer 5.5</td> 
                                        <td>Win 95+</td> 
                                        <td class="center">5.5</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Trident</td> 
                                        <td>Internet
                                             Explorer 6</td> 
                                        <td>Win 98+</td> 
                                        <td class="center">6</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Trident</td> 
                                        <td>Internet Explorer 7</td> 
                                        <td>Win XP SP2+</td> 
                                        <td class="center">7</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Trident</td> 
                                        <td>AOL browser (AOL desktop)</td> 
                                        <td>Win XP</td> 
                                        <td class="center">6</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Gecko</td> 
                                        <td>Firefox 1.0</td> 
                                        <td>Win 98+ / OSX.2+</td> 
                                        <td class="center">1.7</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Gecko</td> 
                                        <td>Firefox 1.5</td> 
                                        <td>Win 98+ / OSX.2+</td> 
                                        <td class="center">1.8</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Gecko</td> 
                                        <td>Firefox 2.0</td> 
                                        <td>Win 98+ / OSX.2+</td> 
                                        <td class="center">1.8</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Gecko</td> 
                                        <td>Firefox 3.0</td> 
                                        <td>Win 2k+ / OSX.3+</td> 
                                        <td class="center">1.9</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Gecko</td> 
                                        <td>Camino 1.0</td> 
                                        <td>OSX.2+</td> 
                                        <td class="center">1.8</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Gecko</td> 
                                        <td>Camino 1.5</td> 
                                        <td>OSX.3+</td> 
                                        <td class="center">1.8</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Gecko</td> 
                                        <td>Netscape 7.2</td> 
                                        <td>Win 95+ / Mac OS 8.6-9.2</td> 
                                        <td class="center">1.7</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Gecko</td> 
                                        <td>Netscape Browser 8</td> 
                                        <td>Win 98SE+</td> 
                                        <td class="center">1.7</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Gecko</td> 
                                        <td>Netscape Navigator 9</td> 
                                        <td>Win 98+ / OSX.2+</td> 
                                        <td class="center">1.8</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Gecko</td> 
                                        <td>Mozilla 1.0</td> 
                                        <td>Win 95+ / OSX.1+</td> 
                                        <td class="center">1</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Gecko</td> 
                                        <td>Mozilla 1.1</td> 
                                        <td>Win 95+ / OSX.1+</td> 
                                        <td class="center">1.1</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Gecko</td> 
                                        <td>Mozilla 1.2</td> 
                                        <td>Win 95+ / OSX.1+</td> 
                                        <td class="center">1.2</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Gecko</td> 
                                        <td>Mozilla 1.3</td> 
                                        <td>Win 95+ / OSX.1+</td> 
                                        <td class="center">1.3</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Gecko</td> 
                                        <td>Mozilla 1.4</td> 
                                        <td>Win 95+ / OSX.1+</td> 
                                        <td class="center">1.4</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Gecko</td> 
                                        <td>Mozilla 1.5</td> 
                                        <td>Win 95+ / OSX.1+</td> 
                                        <td class="center">1.5</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Gecko</td> 
                                        <td>Mozilla 1.6</td> 
                                        <td>Win 95+ / OSX.1+</td> 
                                        <td class="center">1.6</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Gecko</td> 
                                        <td>Mozilla 1.7</td> 
                                        <td>Win 98+ / OSX.1+</td> 
                                        <td class="center">1.7</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Gecko</td> 
                                        <td>Mozilla 1.8</td> 
                                        <td>Win 98+ / OSX.1+</td> 
                                        <td class="center">1.8</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Gecko</td> 
                                        <td>Seamonkey 1.1</td> 
                                        <td>Win 98+ / OSX.2+</td> 
                                        <td class="center">1.8</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Gecko</td> 
                                        <td>Epiphany 2.20</td> 
                                        <td>Gnome</td> 
                                        <td class="center">1.8</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Webkit</td> 
                                        <td>Safari 1.2</td> 
                                        <td>OSX.3</td> 
                                        <td class="center">125.5</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Webkit</td> 
                                        <td>Safari 1.3</td> 
                                        <td>OSX.3</td> 
                                        <td class="center">312.8</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Webkit</td> 
                                        <td>Safari 2.0</td> 
                                        <td>OSX.4+</td> 
                                        <td class="center">419.3</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Webkit</td> 
                                        <td>Safari 3.0</td> 
                                        <td>OSX.4+</td> 
                                        <td class="center">522.1</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Webkit</td> 
                                        <td>OmniWeb 5.5</td> 
                                        <td>OSX.4+</td> 
                                        <td class="center">420</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Webkit</td> 
                                        <td>iPod Touch / iPhone</td> 
                                        <td>iPod</td> 
                                        <td class="center">420.1</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Webkit</td> 
                                        <td>S60</td> 
                                        <td>S60</td> 
                                        <td class="center">413</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Presto</td> 
                                        <td>Opera 7.0</td> 
                                        <td>Win 95+ / OSX.1+</td> 
                                        <td class="center">-</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Presto</td> 
                                        <td>Opera 7.5</td> 
                                        <td>Win 95+ / OSX.2+</td> 
                                        <td class="center">-</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Presto</td> 
                                        <td>Opera 8.0</td> 
                                        <td>Win 95+ / OSX.2+</td> 
                                        <td class="center">-</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Presto</td> 
                                        <td>Opera 8.5</td> 
                                        <td>Win 95+ / OSX.2+</td> 
                                        <td class="center">-</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Presto</td> 
                                        <td>Opera 9.0</td> 
                                        <td>Win 95+ / OSX.3+</td> 
                                        <td class="center">-</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Presto</td> 
                                        <td>Opera 9.2</td> 
                                        <td>Win 88+ / OSX.3+</td> 
                                        <td class="center">-</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Presto</td> 
                                        <td>Opera 9.5</td> 
                                        <td>Win 88+ / OSX.3+</td> 
                                        <td class="center">-</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Presto</td> 
                                        <td>Opera for Wii</td> 
                                        <td>Wii</td> 
                                        <td class="center">-</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Presto</td> 
                                        <td>Nokia N800</td> 
                                        <td>N800</td> 
                                        <td class="center">-</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Presto</td> 
                                        <td>Nintendo DS browser</td> 
                                        <td>Nintendo DS</td> 
                                        <td class="center">8.5</td> 
                                        <td class="center">C/A<sup>1</sup></td> 
                                    </tr> 
                                    <tr class="gradeC"> 
                                        <td>KHTML</td> 
                                        <td>Konqureror 3.1</td> 
                                        <td>KDE 3.1</td> 
                                        <td class="center">3.1</td> 
                                        <td class="center">C</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>KHTML</td> 
                                        <td>Konqureror 3.3</td> 
                                        <td>KDE 3.3</td> 
                                        <td class="center">3.3</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>KHTML</td> 
                                        <td>Konqureror 3.5</td> 
                                        <td>KDE 3.5</td> 
                                        <td class="center">3.5</td> 
                                        <td class="center">A</td> 
                                    </tr> 
                                    <tr class="gradeX"> 
                                        <td>Tasman</td> 
                                        <td>Internet Explorer 4.5</td> 
                                        <td>Mac OS 8-9</td> 
                                        <td class="center">-</td> 
                                        <td class="center">X</td> 
                                    </tr> 
                                    <tr class="gradeC"> 
                                        <td>Tasman</td> 
                                        <td>Internet Explorer 5.1</td> 
                                        <td>Mac OS 7.6-9</td> 
                                        <td class="center">1</td> 
                                        <td class="center">C</td> 
                                    </tr> 
                                    <tr class="gradeC"> 
                                        <td>Tasman</td> 
                                        <td>Internet Explorer 5.2</td> 
                                        <td>Mac OS 8-X</td> 
                                        <td class="center">1</td> 
                                        <td class="center">C</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Misc</td> 
                                        <td>NetFront 3.1</td> 
                                        <td>Embedded devices</td> 
                                        <td class="center">-</td> 
                                        <td class="center">C</td> 
                                    </tr> 
                                    <tr class="gradeA"> 
                                        <td>Misc</td> 
                                        <td>NetFront 3.4</td> 
                                        <td>Embedded devices</td> 
                                        <td class="center">-</td> 
                                        <td class="center">A</td> 
                                    </tr> -->
                                </tbody> 
                            </table>  
                        </div>
                            
                        <h1>Initialisation code</h1> 
<pre class="code">$(document).ready(function() {
    $('#example').dataTable( {
        "sPaginationType": "full_numbers"
    } );
} );</pre> 
                            
                            <p>Please refer to the <a href="http://www.datatables.net/"><i>DataTables</i> documentation</a> for full information about its API properties and methods.</p> 
                    </div>
                </div>