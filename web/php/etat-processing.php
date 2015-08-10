<?php
    /* Indexed column (used for fast and accurate table cardinality) */
    $sIndexColumn = "f.matragent";
       
    /* DB table to use */
    $sTable = "liste_abo h,reltournee r,reference..agent f , abonne a, reference..dictables d, tournee t";
     
    /* Database connection information */
    $gaSql['user']       = "GESADB";
    $gaSql['password']   = "GESA";
    $gaSql['db']         = "GESABELDEV";
    $gaSql['server']     = "CGSRV043";
     
    /*
    * Columns
    * If you don't want all of the columns displayed you need to hardcode $aColumns array with your elements.
    * If not this will grab all the columns associated with $sTable
    */
    $aColumns = array('f.matragent','f.nomagent');
 
 
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * If you just want to use the basic configuration for DataTables with PHP server-side, there is
     * no need to edit below this line
     */
     
    /* 
     * ODBC connection
     */
    $connectionInfo = array("UID" => $gaSql['user'], "PWD" => $gaSql['password'], "Database"=>$gaSql['db'],"ReturnDatesAsStrings"=>true);
    $gaSql['link'] = sqlsrv_connect( $gaSql['server'], $connectionInfo);
    
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
           
       
    /* Ordering */
    $sOrder = "";
    if ( isset( $_GET['iSortCol_0'] ) ) {
        $sOrder = "ORDER BY  ";
        for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ ) {
            if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" ) {
                $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
                    ".addslashes( $_GET['sSortDir_'.$i] ) .", ";
            }
        }
        $sOrder = substr_replace( $sOrder, "", -2 );
        if ( $sOrder == "ORDER BY" ) {
            $sOrder = "";
        }
    }
       
    /* Filtering */
    $sWhere = "";
    if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) {
        $sWhere = "WHERE (";
        for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
            $sWhere .= $aColumns[$i]." LIKE '%".addslashes( $_GET['sSearch'] )."%' OR ";
        }
        $sWhere = substr_replace( $sWhere, "", -3 );
        $sWhere .= ')';
    }
    /* Individual column filtering */
    for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
        if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )  {
            if ( $sWhere == "" ) {
                $sWhere = "WHERE ";
            } else {
                $sWhere .= " AND ";
            }
            $sWhere .= $aColumns[$i]." LIKE '%".addslashes($_GET['sSearch_'.$i])."%' ";
        }
    }
       
    /* Paging */
    $top = (isset($_GET['iDisplayStart']))?((int)$_GET['iDisplayStart']):0 ;
    $limit = (isset($_GET['iDisplayLength']))?((int)$_GET['iDisplayLength'] ):10;
    $sQuery = "SELECT TOP $limit ".implode(",",$aColumns)."
        FROM $sTable
        $sWhere "
            . "".(($sWhere=="")?" WHERE ":" AND ")." $sIndexColumn NOT IN
        (
            SELECT $sIndexColumn FROM
            (
                SELECT TOP $top ".implode(",",$aColumns)."
                FROM $sTable
                $sWhere
                $sOrder
            )
            as [virtTable]
        )
        $sOrder";
    
//    $sQuery = "SELECT TOP 10 h.Identifiant,Nom_abonne,Nbre_Imp_Echu,Total_Imp_Echu
//        FROM liste_abo, h.reltournee r,reference..agent f , abonne a, reference..dictables d, tournee t
//          WHERE    h.identifiant = a.idabon and
//                                                     codelemt = a.posabon and numtable = '24' and 
//                                                     r.matrrelvr=f.MATRAGENT and
//                                                     substring(h.refbranch, 1,3) = r.codexp and
//                                                     substring(h.refbranch, 5,2) = r.codzone and
//                                                     substring(h.refbranch, 7,3) = r.codtourne 
//                                                     and
//                                                     substring(h.refbranch, 1,3) = t.codexp and
//                                                     substring(h.refbranch, 5,2) = t.codzone and
//                                                     substring(h.refbranch, 7,3) = t.codtourne
//          
//
//        ORDER BY  h.Identifiant";
//    $rResult = sqlsrv_query($gaSql['link'],"SELECT TOP $limit ".implode(",",$aColumns)." FROM $sTable") 
//            or die("$sQuery: " . sqlsrv_errors());
    $rResult = sqlsrv_query($gaSql['link'],$sQuery) or die("$sQuery: " . sqlsrv_errors());
  
    $sQueryCnt = "SELECT * FROM $sTable $sWhere";
    $rResultCnt = sqlsrv_query( $gaSql['link'], $sQueryCnt ,$params, $options) or die (" $sQueryCnt: " . sqlsrv_errors());
    $iFilteredTotal = sqlsrv_num_rows( $rResultCnt );
  
    $sQuery = " SELECT * FROM $sTable ";
    $rResultTotal = sqlsrv_query( $gaSql['link'], $sQuery ,$params, $options) or die(sqlsrv_errors());
    $iTotal = sqlsrv_num_rows( $rResultTotal );
       
    $output = array(
//        "sEcho" => intval($_GET['sEcho']),
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iFilteredTotal,
        "aaData" => array()
    );
       
    while ( $aRow = sqlsrv_fetch_array( $rResult ) ) {
        $row = array();
        for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
            if ( $aColumns[$i] != ' ' ) {
                $v = $aRow[ $aColumns[$i] ];
                $v = mb_check_encoding($v, 'UTF-8') ? $v : utf8_encode($v);
                $row[]=$v;
            }
        }
        If (!empty($row)) { $output['aaData'][] = $row; }
    }    
    echo json_encode( $output );
?>