<?php

 require_once('home.php');  
 include "connection.php";
 $conn=mysqli_connect('localhost','root','','eirish_payroll');
 $result=mysqli_query($conn,"select * from employee");
 

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Datatable</title>
  <link rel="stylesheet" href="css/footer.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
 
</head>
<body>
 <div class="container" style="margin-top:50px;">    
    <center><h3>Field Employee</h3></center>
             <div class="border-bottom my-3"></div>
             <button type="button" class="btn btn-outline-primary" onclick="location.href='export.php'">Deploy</button>
                <button type="button" class="btn btn-outline-success" onclick="location.href='export.php'">Export to CSV</button>
       <div class="border-bottom my-3"></div>
          <table class="table table-hover">
                  <thead>
                      <tr>
                        <th>EMP ID</th>
                        <th>Name</th>
                        <th>Job</th>
                      
                      </tr>

                </thead>
                    <tbody>
                          <?php while($row=mysqli_fetch_assoc($result)){?>
                      <tr>
                          <td><?php echo $row['emp_id']?></td>
                          <td><?php echo $row['name']?></td>
                          <td><?php echo $row['position']?></td>
                          
                      </tr>
                          

                          <?php } ?>
                    
                </thead>
              
              </table>
              <div class="modal fade" id="viewmodal" role="dialog">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4 class="modal-title">Employee Informations</h4>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-view">
                                              </div>
                                              <div class="modal-footer">
                                              <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                              </div>
                                          </div>
                                      </div>
                              </div>

                          </div>
              
              <?php require_once('addemployee.php'); ?>
              
   </div>
   <br>
   <br>
   <br>
   <br>
   <?php require_once('footer.php'); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
  <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script>
  $(document).ready( function () {
		$('.table').DataTable();
  });
  </script>
  <script type='text/javascript'>
            $(document).ready(function(){
                $('.userinfo').click(function(){
                    var userid = $(this).data('id');
                    $.ajax({
                        url: 'views.php',
                        type: 'post',
                        data: {userid: userid},
                        success: function(response){ 
                            $('.modal-view').html(response); 
                            $('#viewmodal').modal('show'); 
                        }
                    });
                });
            });
            </script>
</body>
</html>