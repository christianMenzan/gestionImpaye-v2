<?php
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
           die( $e->getMessage() ); 
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
        $query = "select DISTINCT f.matragent matr_AZ,f.nomagent nom_AZ,numgf
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
                 order by nom_AZ ";                                    
        $stmt = $conn->query( $query );
?>


    <table class="display" id="example"> 
        <thead> 
            <tr> 
                <th></th> 
                <th>Matricule de l'agent</th> 
                <th>Nom & Prénoms</th> 
                <th>Numéro GF</th>                               
            </tr> 
        </thead> 
        <tbody> 
            <?php while ( $row = $stmt->fetch( PDO::FETCH_OBJ) ):{ ?>
            <tr class="gradeA checkboxId"> 
                <td><input type="checkbox"></td>
                <td id="matr_az" ><?php echo $row->matr_AZ  ?></td>
                <td id="nom_az" ><?php echo $row->nom_AZ ?></td>
                <td id="gf_az" ><?php echo $row->numgf  ?></td>
            </tr> 
          <?php } endwhile;  
                  // Free statement and connection resources. 
                  $stmt = null;  
          ?>

        </tbody> 
    </table>  