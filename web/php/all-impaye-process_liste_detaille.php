<?php
    $serverName = "WIN-16XSGUCUL9V"; 
    $database = "gesabeldev";
    $uid = 'sa';
    $pwd = 'P@ssw0rd';

    try {
       $conn = new PDO( "sqlsrv:server=$serverName;Database = $database", $uid, $pwd); 
       $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
       
       
        $unMatricule = '';
        $unNom = '';
        $unGF = '';
        
        $nombreDeClients = '';
        $nombreDImpaye = '';
        $montantDesImpayes = '';
        $clientsAyantPlusDUnImpaye = '';
        
        $nombreDImpayeParAbonne = '';
        $numgf = '';
        $listeAz = '';
        
        if (isset($_POST['nombre-impaye'])) {
            $nombreDImpayeParAbonne = "  Nbre_Imp_Echu >= '" . $_POST['nombre-impaye'] . "' and ";
        }
        
        if (isset($_POST['num-gf'])) {
            $numgf = "  numgf = '" . $_POST['num-gf'] . "' and ";
        }
        
        if (isset($_POST['matricule-az'])) {
            $listeAz = "  f.matragent in (" . $_POST['matricule-az'] . ") and ";
        }
       
       //Nombre d'agents retourné par l'exécution de la requête
        $sql = "SELECT DISTINCT f.matragent, f.nomagent, numgf
                from    liste_abo h,reltournee r,reference..agent f , abonne a, reference..dictables d, tournee t
                 where   h.identifiant = a.idabon and
                         codelemt = a.posabon and numtable = '24' and 
                         r.matrrelvr=f.MATRAGENT and
                         substring(h.refbranch, 1,3) = r.codexp and
                         substring(h.refbranch, 5,2) = r.codzone and
                         substring(h.refbranch, 7,3) = r.codtourne 
                         and
                         $nombreDImpayeParAbonne
                         $numgf
                         $listeAz
                         substring(h.refbranch, 1,3) = t.codexp and
                         substring(h.refbranch, 5,2) = t.codzone and
                         substring(h.refbranch, 7,3) = t.codtourne
                 order by f.nomagent asc ";

        $stmtAgent = $conn->query($sql);
       
        
        
        while ( $rAgent = $stmtAgent->fetch( PDO::FETCH_OBJ)  ){ 
            
            $unMatricule = "'" . $rAgent->matragent . "'";
            $unNom = $rAgent->nomagent;
            $unGF = $rAgent->numgf;
            
             // Nombre d'abonnés
            $query = "select COUNT(Identifiant)
                     from    liste_abo h,reltournee r,reference..agent f , abonne a, reference..dictables d, tournee t
                     where   f.matragent = $unMatricule 
                             and
                             h.identifiant = a.idabon and
                             codelemt = a.posabon and numtable = '24' and 
                             r.matrrelvr=f.MATRAGENT and
                             substring(h.refbranch, 1,3) = r.codexp and
                             substring(h.refbranch, 5,2) = r.codzone and
                             substring(h.refbranch, 7,3) = r.codtourne 
                             and
                             $nombreDImpayeParAbonne
                             $numgf
                             substring(h.refbranch, 1,3) = t.codexp and
                             substring(h.refbranch, 5,2) = t.codzone and
                             substring(h.refbranch, 7,3) = t.codtourne ";                                    

            $nombreDeClients = $conn->query($query, PDO::FETCH_COLUMN, 0)->fetch() ;
            
            // Nombre d'impayés
            $query = "select SUM(Nbre_Imp_Echu)
                     from    liste_abo h,reltournee r,reference..agent f , abonne a, reference..dictables d, tournee t
                     where   f.matragent = $unMatricule 
                             and
                             h.identifiant = a.idabon and
                             codelemt = a.posabon and numtable = '24' and 
                             r.matrrelvr=f.MATRAGENT and
                             substring(h.refbranch, 1,3) = r.codexp and
                             substring(h.refbranch, 5,2) = r.codzone and
                             substring(h.refbranch, 7,3) = r.codtourne 
                             and
                             $nombreDImpayeParAbonne
                             $numgf
                             substring(h.refbranch, 1,3) = t.codexp and
                             substring(h.refbranch, 5,2) = t.codzone and
                             substring(h.refbranch, 7,3) = t.codtourne ";                                    

            $nombreDImpaye = $conn->query($query, PDO::FETCH_COLUMN, 0)->fetch() ;
            
            // Montant des impayés
            $query = "select SUM(Total_Imp_Echu)
                     from    liste_abo h,reltournee r,reference..agent f , abonne a, reference..dictables d, tournee t
                     where   f.matragent = $unMatricule 
                             and
                             h.identifiant = a.idabon and
                             codelemt = a.posabon and numtable = '24' and 
                             r.matrrelvr=f.MATRAGENT and
                             substring(h.refbranch, 1,3) = r.codexp and
                             substring(h.refbranch, 5,2) = r.codzone and
                             substring(h.refbranch, 7,3) = r.codtourne 
                             and
                             $nombreDImpayeParAbonne
                             $numgf
                             substring(h.refbranch, 1,3) = t.codexp and
                             substring(h.refbranch, 5,2) = t.codzone and
                             substring(h.refbranch, 7,3) = t.codtourne";                                    

            $montantDesImpayes =  $conn->query($query, PDO::FETCH_COLUMN, 0)->fetch() ;
            
            // Nombre d'abonnés
            $query = "select COUNT(h.Identifiant)
                     from    liste_abo h,reltournee r,reference..agent f , abonne a, reference..dictables d, tournee t
                     where   h.identifiant = a.idabon and
                             codelemt = a.posabon and numtable = '24' and 
                             r.matrrelvr=f.MATRAGENT and
                             substring(h.refbranch, 1,3) = r.codexp and
                             substring(h.refbranch, 5,2) = r.codzone and
                             substring(h.refbranch, 7,3) = r.codtourne 
                             and
                             $nombreDImpayeParAbonne
                             $numgf
                             substring(h.refbranch, 1,3) = t.codexp and
                             substring(h.refbranch, 5,2) = t.codzone and
                             substring(h.refbranch, 7,3) = t.codtourne ";                                    

            $clientsAyantPlusDUnImpaye = $conn->query($query, PDO::FETCH_COLUMN, 0)->fetch() ;
    
            // LISTE
            $query = "select f.matragent matr_AZ,f.nomagent nom_AZ,numgf,t.codexp+t.codzone+t.codtourne tournee,h.refbranch,h.Identifiant,Position, h.datposa,h.genrabon, h.usageabon, 
                             Nom_abonne, Nbre_Imp_Echu,Total_Imp_Echu, Conso_Imp_Echu, solde_Total_FactEchue
                     from    liste_abo h,reltournee r,reference..agent f , abonne a, reference..dictables d, tournee t
                     where   f.matragent = $unMatricule 
                             and
                             h.identifiant = a.idabon and
                             codelemt = a.posabon and numtable = '24' and 
                             r.matrrelvr=f.MATRAGENT and
                             substring(h.refbranch, 1,3) = r.codexp and
                             substring(h.refbranch, 5,2) = r.codzone and
                             substring(h.refbranch, 7,3) = r.codtourne 
                             and 
                             $nombreDImpayeParAbonne
                             $numgf
                             substring(h.refbranch, 1,3) = t.codexp and
                             substring(h.refbranch, 5,2) = t.codzone and
                             substring(h.refbranch, 7,3) = t.codtourne 
                     order by Total_Imp_Echu desc "; 

            $stmt = $conn->query( $query );

    //        $stmt = $conn->prepare($query);
    //        $stmt->execute(array($unMatricule));
    //        var_dump($stmt);
            
            
            ?>
            <h4><?php echo $unNom ?></h4>
            <div>
                <table class="full"> 
                    <tbody> 
                        <tr> 
                            <td>Matricule :</td> 
                            <td class="ar"><a href="#"><?php echo $unMatricule ?></a></td> 
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre de clients</td> 
                            <td class="ar"><?php echo number_format($nombreDeClients, 0, ',', ' ')  ?></td> 
                        </tr> 

                        <tr> 
                            <td>Groupe de Facturation :</td> 
                            <td class="ar"><a href="#"><?php echo $unGF ?></a></td> 
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'impayés</td> 
                            <td class="ar"><?php echo number_format($nombreDImpaye, 0, ',', ' ') ?></td> 
                        </tr> 

                        <tr> 
                            <td></td> 
                            <td class="ar"></td> 
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;Montant des impayés</td> 
                            <td class="ar"><?php echo number_format($montantDesImpayes, 0, ',', ' ') ?> Francs CFA</td> 
                        </tr> 

                        <tr> 
                            <td></td> 
                            <td class="ar"></td> 
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;Clients ayant plus d'un impayé</td> 
                            <td class="ar"><?php echo number_format($clientsAyantPlusDUnImpaye, 0, ',', ' ') ?></td> 
                        </tr>

                    </tbody> 
                </table>
                <br><br> 
                <h5>Liste des abonnés</h5>
                <table class="display" id=""> 
                    <thead> 
                        <tr>
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
                            <td><?php echo $row->Identifiant ?></td>
                            <td><?php echo $row->refbranch ?></td>
                            <td><?php echo $row->tournee ?></td>
                            <td><?php echo $row->Nom_abonne ?></td>
                            <td><?php echo $row->Position ?></td>
                            <td><?php echo number_format($row->Nbre_Imp_Echu, 0, ',', ' ')  ?></td>
                            <td><?php echo number_format($row->Total_Imp_Echu, 0, ',', ' ')  ?> Francs CFA</td>
                        </tr> 
                      <?php } endwhile; ?>

                    </tbody> 
                </table>
            </div>
            <br><br><br><br><br>

        <?php }
        // Free statement and connection resources. 
//        $stmt = null;  
    }

    catch( PDOException $e ) {
      echo $e->getMessage();
    }

    
    
?>



