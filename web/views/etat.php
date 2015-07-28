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
        bExpandSingleGroup: false,
        iExpandGroupOffset: -1,
        asExpandedGroups: [""],
        sGroupingColumnSortDirection: "asc",
        iGroupingOrderByColumnIndex: 0
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
                                <h2>Affichage de tous les agents de zone</h2>
                            </header>
                            
                            <div class="grid_4 alpha">
                              <div class="message info">
                                Statistiques globales
                            </div>
  <?php
//                                    $serverName = "CGSRV044"; 
                                    $serverName = "WIN-16XSGUCUL9V"; 
                                    $database = "gesabeldev";

                                    // Get UID and PWD from application-specific files. 
//                                    $uid = file_get_contents("C:\AppData\uid.txt");
//                                    $pwd = file_get_contents("C:\AppData\pwd.txt");
                                    
                                    $uid = 'sa';
                                    $pwd = 'P@ssw0rd';
//                                    
//                                     $uid = 'GESADB';
//                                    $pwd = 'GESA';

                                    try {
                                       $conn = new PDO( "sqlsrv:server=$serverName;Database = $database", $uid, $pwd); 
                                       $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
                                    }

                                    catch( PDOException $e ) {
                                       die( "Error connecting to SQL Server" ); 
                                    }
                                    
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
                                    $query = "select f.matragent matr_AZ,f.nomagent nom_AZ,numgf,t.codexp+t.codzone+t.codtourne tournee,h.refbranch,h.Identifiant,Position, h.datposa,h.genrabon, h.usageabon, 
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
                                     
                                    
                                    //Nombre d'agents retourné par l'exécution de la requête
                                    $sql = "SELECT COUNT(DISTINCT f.matragent) 
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
                                                     substring(h.refbranch, 7,3) = t.codtourne";
                                    
                                    $nombreDAZ = $conn->query($sql, PDO::FETCH_COLUMN, 0)->fetch() ;
//                                    var_dump($nombreDAZStmt);
//                                    $nombreDAZ = $nombreDAZStmt[0];
                                    
                                ?>
                                   <div id="demo" class="clearfix"> 
                                       <h4>Liste des agents de zone - Traitement exécuté sur <a href="#example" title="Voir la liste des agents"><strong>  <?php echo $nombreDAZ; ?></strong> agents </a></h4>
                            <table class="display" id="example"> 
                                <thead> 
                                    <tr> 
                                        <!--<th>Matricule</th>--> 
                                        <th>Nom et Matricule de l'agent</th> 
                                        <th>Identifiant</th> 
                                        <th>Référence</th> 
                                        <th>Tournée</th> 
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
                                        <td><?php echo $row->nom_AZ . "( " . $row->matr_AZ . " )" ?></td>
                                        <td><?php echo $row->Identifiant ?></td>
                                        <td><?php echo $row->refbranch ?></td>
                                        <td><?php echo $row->tournee ?></td>
                                        <td><?php echo $row->Nom_abonne ?></td>
                                        <td><?php echo $row->Position ?></td>
                                        <td><?php echo $row->Nbre_Imp_Echu ?></td>
                                        <td><?php echo $row->Total_Imp_Echu ?></td>
                                    </tr> 
                                  <?php } endwhile;  
                                          // Free statement and connection resources. 
                                          $stmt = null; 
                                          $conn = null; ?>
                                    
                                </tbody> 
                            </table>  
                        </div>
                        </div>
                            
                            <div class="grid_4 omega">
                                <!--Sed lacus nunc, gravida sed auctor vitae, faucibus ultrices erat. Vestibulum orci dui, eleifend vel sodales eu, bibendum id ipsum.-->
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
                     
                            
<!--                        <h1>Initialisation code</h1> 
<pre class="code">$(document).ready(function() {
    $('#example').dataTable( {
        "sPaginationType": "full_numbers"
    } );
} );</pre> -->
                            
                            <!--<p>Please refer to the <a href="http://www.datatables.net/"><i>DataTables</i> documentation</a> for full information about its API properties and methods.</p>--> 
                    </div>
                </div>