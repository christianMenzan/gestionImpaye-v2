<!-- DATATABLES CSS -->
<link rel="stylesheet" media="screen" href="lib/datatables/css/vpad.css" />
<script type="text/javascript" src="lib/datatables/js/jquery.dataTables.js"></script> 
<script type="text/javascript" src="lib/datatables/js/jquery.dataTables.rowGrouping.js"></script>


<!--<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/jquery.dataTables.js"></script>
<script type="text/javascript" src="//jquery-datatables-row-grouping.googlecode.com/svn/trunk/media/js/jquery.dataTables.rowGrouping.js"></script> 
-->


<script type="text/javascript" charset="utf-8">
   
    
    $(document).ready(function(){
        
        
         $.ajax('../php/all-impaye-process_total_abonne.php', {
                dataType: "text",
                cache: false,
                success: function(data, textStatus) {
                     $("#all-impaye-process_total_abonne").html(data) ;
                },
                complete: function(jqXHR, textStatus) {
                }
            });
            
       $.ajax('../php/all-impaye-process_total_client_plusDunImpaye.php', {
                dataType: "text",
                cache: false,
                success: function(data, textStatus) {
                     $("#all-impaye-process_total_client_plusDunImpaye").text(data) ;
                },
                complete: function(jqXHR, textStatus) {
                }
            });
            
      $.ajax('../php/all-impaye-process_total_impaye.php', {
                dataType: "text",
                cache: false,
                success: function(data, textStatus) {
                     $("#all-impaye-process_total_impaye").text(data) ;
                },
                complete: function(jqXHR, textStatus) {
                }
            });
            
       $.ajax('../php/all-impaye-process_total_montant_impaye.php', {
                dataType: "text",
                cache: false,
                success: function(data, textStatus) {
                     $("#all-impaye-process_total_montant_impaye").text(data) ;
                },
                complete: function(jqXHR, textStatus) {
                }
            });
            
            
       $.ajax('../php/all-impaye-process_nbreAgent.php', {
                dataType: "text",
                cache: false,
                success: function(data, textStatus) {
                     $("#all-impaye-process_nbreAgent").text(data) ;
                },
                complete: function(jqXHR, textStatus) {
                }
            });
      
        
        $.ajax('../php/all-impaye-process.php', {
                dataType: "html",
                cache: false,
                success: function(data, textStatus) {
                     $('#demo').html(data);
                     return getResult(data, 'demo');
                },
                complete: function(jqXHR, textStatus) {
                     
                }
            });
            
        $.ajax('../php/all-impaye-process_liste_detaille.php', {
                dataType: "html",
                cache: false,
                success: function(data, textStatus) {
                     return getResult(data, 'liste-detaille-impaye-az');
                },
                complete: function(jqXHR, textStatus) {
                }
            });
            
            
        $("#valider-nombre-impaye-par-client").click(function(){            

        });
        
        $('#nombre-impaye-form').on('submit', function(e) {
            e.preventDefault();
           $.ajax('../php/all-impaye-process_liste_detaille.php', {
                dataType: "html",
                cache: false,
                type: 'POST',
                data: 'nombre-impaye=' + $("#nombre-impaye").val(),
                 beforeSend: function() {
                    $('#liste-detaille-impaye-az').html("<img id='loading-graphic' width='16' height='16' src='images/ajax-loader-eeeeee.gif' />");
                  },
                success: function(data, textStatus) {
                     return getResult(data, 'liste-detaille-impaye-az');
                },
                complete: function(jqXHR, textStatus) {
                }
            });
//            this.submit(); //now submit the form
        });
        
        $('#num-gf-form').on('submit', function(e) {
            e.preventDefault();
           $.ajax('../php/all-impaye-process_liste_detaille.php', {
                dataType: "html",
                cache: false,
                type: 'POST',
                data: 'num-gf=' + $("#num-gf").val(),
                 beforeSend: function() {
                    $('#liste-detaille-impaye-az-numGF').html("<img id='loading-graphic' width='16' height='16' src='images/ajax-loader-eeeeee.gif' />");
                  },
                success: function(data, textStatus) {
                     return getResult(data, 'liste-detaille-impaye-az-numGF');
                },
                complete: function(jqXHR, textStatus) {
                }
            });
        });
        
        
        $('#executer-afficher-sur-selection-az').click( function() {
            $.ajax('../php/all-impaye-process_par-az.php', {
                dataType: "html",
                cache: false,
                type: 'POST',
                 beforeSend: function() {
                    $('#liste-impaye-az-par-az').html("<img id='loading-graphic' width='16' height='16' src='images/ajax-loader-eeeeee.gif' />");
                  },
                success: function(data, textStatus) {
                      $('#liste-impaye-az-par-az').html(data);
                },
                complete: function(jqXHR, textStatus) {
                }
            });
        } );
            
//        function getResult(data, id){
//                $('#'+id).html(data);
//                $('table.display').dataTable({
//                "bLengthChange": false,
//                "bPaginate": false,
//                "bJQueryUI": true,
//                "oLanguage": {
//                    "sProcessing":     "Traitement en cours...",
//                    "sSearch":         "Rechercher&nbsp;:",
//                    "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
//                    "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
//                    "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
//                    "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
//                    "sInfoPostFix":    "",
//                    "sLoadingRecords": "Chargement en cours...",
//                    "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
//                    "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
//                    "oPaginate": {
//                        "sFirst":      "Premier",
//                        "sPrevious":   "Pr&eacute;c&eacute;dent",
//                        "sNext":       "Suivant",
//                        "sLast":       "Dernier"
//                  },
//                  "oAria": {
//                    "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
//                    "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
//                  }
//              }
//            }).rowGrouping({
//                bExpandableGrouping: true,
//        //        EXPEND BY DEFAULT
//                bExpandSingleGroup: false,
//                iExpandGroupOffset: -1,
//                asExpandedGroups: [""],
//                sGroupingColumnSortDirection: "asc",
//                iGroupingOrderByColumnIndex: 0
//            });
//        }
        function test(data){
            $('#demo').html(data);
        }
        
        
        function getResult(data, id){
                $('#'+id).html(data);
                $('table.display').dataTable({
                "bLengthChange": false,
                "bPaginate": false,
                "bJQueryUI": true,
                "bRetrieve": true,
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
//                        "sFirst":      "Premier",
                        "sPrevious":   "",
                        "sNext":       "",
//                        "sLast":       "Dernier"
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
//                sGroupingColumnSortDirection: "desc",
//                iGroupingOrderByColumnIndex: 6
            });
         }
         
//         $('#bouton-test').click( function() {
//                 var table = $('#example').dataTable();
////                 var data = table.$('input, select').serialize();
//        //        alert(
//        //            "The following data would have been submitted to the server: \n\n"+
//        //            data.substr( 0, 120 )+'...'
//        //        );
//        //        return false;
//                $("input:checked", table.fnGetNodes()).each(function(){
//                    alert($(this).val());
//                });
//    } );
    
    $('#generer-liste-detaille-impaye-az-par-az').click(function () {
        var matr_az = '';
        $('#example tr').filter(':has(:checkbox:checked)').each(function() {
              if (matr_az != '') {
                  matr_az = matr_az + ',' + "'" + $(this).closest('tr').children('td#matr_az').text() + "'";
              }
              else{
                  matr_az = "'" + $(this).closest('tr').children('td#matr_az').text() + "'";
              }
        });
        
        $.ajax('../php/all-impaye-process_liste_detaille.php', {
            dataType: "html",
            cache: false,
            type: 'POST',
            data: 'matricule-az=' + matr_az,
             beforeSend: function() {
                $('#liste-detaille-impaye-az-par-az').html("<img id='loading-graphic' width='16' height='16' src='images/ajax-loader-eeeeee.gif' />");
              },
            success: function(data, textStatus) {
//                  $('#liste-detaille-impaye-az-par-az').html(data);
                  return getResult(data, 'liste-detaille-impaye-az-par-az');
            },
            complete: function(jqXHR, textStatus) {
            }
        });
        
        
    });

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
                        <li><a id="executer-afficher-sur-selection-az" href="#">Exécuter sur une sélection d'AZ</a></li>
                        <li><a href="#">Exécuter sur un GF</a></li>
                    </ul>
                    <section>
                        <section class="clearfix">
<!--                            <header class="grid_12 alpha omega">
                                <h2>Affichage de tous les agents de zone</h2>
                            </header>-->
                       
                            <div class="grid_12 alpha">
                                 <h2>Affichage de tous les agents de zone</h2>
                                <div class="message info">

                                 <h5>Statistiques globales</h5> 

                                  <table class="full clearfix"> 
                                      <tbody> 
                                          <tr> 
                                              <td>Nombre total d'abonnés</td> 
                                              <td class="ar"><a id="all-impaye-process_total_abonne" href="#"><img id='loading-graphic' width='16' height='16' src='images/ajax-loader-eeeeee.gif' /></a></td> 
                                              <!--<td class="ar">1,498.50 $</td>--> 
                                          </tr> 

                                          <tr> 
                                              <td>Nombre total d'impayés</td> 
                                              <td class="ar"><a id="all-impaye-process_total_impaye" href="#"><img id='loading-graphic' width='16' height='16' src='images/ajax-loader-eeeeee.gif' /></a></td> 
                                              <!--<td class="ar">1,248.75 $</td>--> 
                                          </tr> 

                                          <tr> 
                                              <td>Montant total d'impayés</td> 
                                              <td class="ar"><a id="all-impaye-process_total_montant_impaye" href="#"><img id='loading-graphic' width='16' height='16' src='images/ajax-loader-eeeeee.gif' /></a></td> 
                                              <!--<td class="ar">249.75 $</td>--> 
                                          </tr> 

                                          <tr> 
                                              <td>Clients ayant plus d'un impayé</td> 
                                              <td class="ar"><a id="all-impaye-process_total_client_plusDunImpaye" href="#"><img id='loading-graphic' width='16' height='16' src='images/ajax-loader-eeeeee.gif' /></a></td> 
                                              <!--<td class="ar">0.00 $</td>--> 
                                          </tr> 
                                      </tbody> 
                                  </table>
                              </div>
                                 
                                 <h4>Liste des agents de zone - Traitement exécuté sur <a id="all-impaye-process_nbreAgent" href="#example" title="Voir la liste des agents"></a>agents</h4>
                                 
                              <div id="demo" class="clearfix">    
                                  <img id='loading-graphic' width='16' height='16' src='images/ajax-loader-eeeeee.gif' /><span>Chargement...</span>
                                  <table class="display" id="example"> 
                                        <thead> 
                                            <tr> 
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
                                        </tbody> 
                                    </table>  
                              </div>
                              <br><br><br>
                          </div>
                           <h2>Liste détaillée des abonnés par agent de zone</h2>
                           <form id="nombre-impaye-form" class="form has-validation">
                                    <div class="clearfix">
                                        <label for="form-name" class="form-label">Nombre minimum d'impayé par abonné</label>
                                        <div class="form-input"><input type="text" id="nombre-impaye" name=nombre-impaye" placeholder="Tout renvoyer" /></div>
                                    </div>
                                    <div class="form-action clearfix">
                                        <button id="valider-nombre-impaye-par-client" class="button" type="submit">Valider</button>
                                        <!--<button class="button" type="reset">Reset</button>-->
                                    </div>
                                 </form>
                           <div id="liste-detaille-impaye-az" class="portlet grid_12 leading"> <img id='loading-graphic' width='16' height='16' src='images/ajax-loader-eeeeee.gif' /></div>
                            
                        </section>
                        <section class="clearfix">
                           <div class="grid_12 alpha">
                                 <h2>Affichage des agents de zone</h2>
                                 <div id="liste-impaye-az-par-az" class="portlet grid_12 leading"></div>
                                 <button id="generer-liste-detaille-impaye-az-par-az" class="button">Exécuter</button>
                                 <div id="liste-detaille-impaye-az-par-az" class="portlet grid_12 leading"></div>
                           </div> 
                        </section>
                        
                        <section class="clearfix">
                             <div class="grid_12 alpha">
                                 <h2>Affichage des agents de zone par groupe de facturation</h2>
                                 
                                 <form id="num-gf-form" class="form has-validation">
                                    <div class="clearfix">
                                        <label for="form-name" class="form-label">Numéro du groupe de facturation</label>
                                        <div class="form-input"><input type="text" id="num-gf" name="num-gf" placeholder="Tout renvoyer" /></div>
                                    </div>
                                    <div class="form-action clearfix">
                                        <button id="valider-num-gf" class="button" type="submit">Valider</button>
                                    </div>
                                 </form>
                                 
                                 <div id="liste-detaille-impaye-az-numGF" class="portlet grid_12 leading"></div>
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