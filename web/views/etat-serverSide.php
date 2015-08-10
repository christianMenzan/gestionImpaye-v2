<!-- DATATABLES CSS -->
<link rel="stylesheet" media="screen" href="lib/datatables/css/vpad.css" />
<script type="text/javascript" src="lib/datatables/js/jquery.dataTables.js"></script> 
<!--<script type="text/javascript" src="lib/datatables/js/jquery.dataTables.rowGrouping.js"></script>-->


<!--<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/jquery.dataTables.js"></script>
<script type="text/javascript" src="//jquery-datatables-row-grouping.googlecode.com/svn/trunk/media/js/jquery.dataTables.rowGrouping.js"></script> 
-->


<script type="text/javascript" charset="utf-8">
    $('#example').dataTable( {
//      "bJQueryUI" : true,
    //"bProcessing" : true,
    "bServerSide" : true,
//    "sPaginationType" : "full_numbers",
    "sAjaxSource" : "../php/etat-processing.php"
 } );
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

                <h1 class="page-title">Test Server side - Exécution de l'Etat</h1>
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
                                   <div id="demo" class="clearfix"> 
                            <table class="display" id="example"> 
                                <thead> 
                                    <tr> 
                                        <th>IDAbon</th> 
                                        <th>Codexp</th> 
                                        <th>Nom</th>                                       
                                    </tr> 
                                </thead> 
                                <tbody> 
                                    
                                </tbody> 
                            </table>  
                        </div>
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
                     
                            
<!--                        <h1>Initialisation code</h1> 
<pre class="code">$(document).ready(function() {
    $('#example').dataTable( {
        "sPaginationType": "full_numbers"
    } );
} );</pre> -->
                            
                            <!--<p>Please refer to the <a href="http://www.datatables.net/"><i>DataTables</i> documentation</a> for full information about its API properties and methods.</p>--> 
                    </div>
                </div>