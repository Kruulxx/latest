<?php     
require_once "home.php";
$con = mysqli_connect('localhost', 'root', '', 'eirish_payroll');
$result = mysqli_query($con, "SELECT * FROM archive");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payroll</title>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
<style>
  .btn {
  font-size: 18px;
  padding: 12px 24px;
  border-radius: 4px;
  border-width: 2px;
  border-style: solid;
  text-transform: uppercase;
  transition: all 0.3s ease;

}

.btn-outline-danger {
  color: #dc3545;
  background-color: transparent;
  border-color: #dc3545;
}

.btn-outline-danger:hover {
  color: #fff;
  background-color: #dc3545;
  border-color: #dc3545;
}

</style>
  </head>
<body>
<div>
<div class="container" style="margin-top:50px;">    

<div class="container my-5">
<h3 class="text-center font-weight-bold" style="font-size:25px;">Archive Employees</h3>
</div>
<div class="border-bottom my-3"></div>

<button class="btn btn-outline-danger" onclick="delete_all()">delete</button>
<div class="border-bottom my-3"></div>
<form method="post" id="frm">
  <table id="example" class="table table-hover">
    <thead class="thead-light">
      <tr>
        <th width="15%"><input type="checkbox" onclick="select_all()" id="delete"/></th>
        <th>EmpID</th>
        <th>Name</th>
        <th>Address</th>
        <th>Job</th>
        <th>Rate</th>
        <th>Phone No.</th>
        <th>Gender</th>
        <th>Civil Status</th>
        <th>Guardian</th>
        <th>Phone No.</th>
        
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><input type="checkbox" id="<?php echo $row['id']?>" name="checkbox[]" value="<?php echo $row['id']?>"/></td>
        <td><?php echo $row['emp_id']?></td>
        <td><?php echo $row['name']?></td>
        <td><?php echo $row['address']?></td>
        <td><?php echo $row['position']?></td>
        <td><?php echo $row['rate']?></td>
        <td><?php echo $row['phonenumber']?></td>
        <td><?php echo $row['sex']?></td>
        <td><?php echo $row['civil_status']?></td>
        <td><?php echo $row['emergency_name']?></td>
        <td><?php echo $row['emergency_contact']?></td>
        <td  class="border-start border-end" style="margin-top:10px;">
                          <a href="undo.php?id=<?php echo $row['id'] ?>" class="btn btn-outline-success">Restore</a>
                      
                          </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</form>
</div>
      </div>
<?php require_once "scripts.php"; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        url: 'view.php',
        type: 'post',
        data: {userid: userid},
        success: function(response){ 
          $('.modal-body').html(response); 
          $('.table').modal('show'); 
        }
      });
    });
  });
</script>
               
<?php require_once('footer.php')?>

<script>
function count_selected() {
  var checkboxes = jQuery('input[type=checkbox]');
  var checked_checkboxes = checkboxes.filter(':checked');
  return checked_checkboxes.length;
}

function select_all(){
  if(jQuery('#delete').prop("checked")){
    jQuery('input[type=checkbox]').each(function(){
      jQuery(this).prop('checked',true);
    });
  }else{
    jQuery('input[type=checkbox]').each(function(){
      jQuery(this).prop('checked',false);
    });
  }
}

function delete_all() {
  var checkboxes = jQuery('input[type=checkbox]');
  var checked_checkboxes = checkboxes.filter(':checked');
  var count = count_selected();

  if (count === 0) {
    alert('Please select at least one item to delete.');
    return;
  }

  var check = confirm("Are you sure you want to Archive " + count + " items?");
  if (check) {
    jQuery.ajax({
      url: 'delete.php',
      type: 'post',
      data: jQuery('#frm').serialize(),
      success: function(result) {
        checked_checkboxes.each(function() {
          jQuery('#box' + this.id).remove();
        });
      }
    });
  }
}

// Add event listener to the "select all" checkbox
jQuery('#delete').on('change', function() {
  select_all();
});

</script>