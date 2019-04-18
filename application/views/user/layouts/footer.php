

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url('assets/user/jquery.datetimepicker.full.js') ?>"> </script>
  <script src="<?php echo base_url('assets/jquery.bootstrap-growl.min.js') ?>"> </script>

  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
  <!-- Responsive extension -->
  <script src="https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.min.js"></script>
  <!-- Buttons extension -->
  <script src="//cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
  <script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>
  
  <script src="<?= base_url('assets/datatabl/script.js') ?>"></script>
  
  <script type="text/javascript">
  	$("datetime").datetimepicker();
  </script>

  <script>
    $(function() {
        $.bootstrapGrowl("This is a test.");
        
        setTimeout(function() {
            $.bootstrapGrowl("This is another test.", { type: 'success' });
        }, 1000);
        
        setTimeout(function() {
            $.bootstrapGrowl("Danger, Danger!", {
                type: 'danger',
                align: 'center',
                width: 'auto',
                allow_dismiss: false
            });
        }, 2000);
        
        setTimeout(function() {
            $.bootstrapGrowl("Danger, Danger!", {
                type: 'info',
                align: 'left',
                stackup_spacing: 30
            });
        }, 3000);
    });

  </script>

</body>
</html>