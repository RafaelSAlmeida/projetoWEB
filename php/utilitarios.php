<div id="dialog-message" style="display:none">
  <p>
    <span class="ui-icon" id="icon"style="float: left; margin: 0 7px 50px 0;"></span>
    <span id="msgn"></span>
  </p>
  
</div>

<script>
    function aviso(titulo,mensagem,icone){
        $("#icon").addClass(icone);
        $("#msgn").text(mensagem);
        $( "#dialog-message" ).dialog({
        modal: true,
        title:titulo,
        resizable: false,
        buttons: {
            Ok: function() {
              $( this ).dialog( "close" );
            }
        }
        });
        
    }
    
    
</script>